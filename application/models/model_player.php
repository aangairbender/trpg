<?php

class Model_Player extends Model
{

    const INITIAL_LOCATION_ID = 1; //TODO use prepare
    const INITIAL_BAG_CAPACITY = 100;
    const INITIAL_STR = 1;
    const INITIAL_VIT = 1;
    const INITIAL_DEX = 1;

    public function createBag() // returns id
    {
        $this->db->query("INSERT INTO bags(`capacity`) VALUES (".Model_Player::INITIAL_BAG_CAPACITY.")");
        return $this->db->insert_id;
    }

    public function createPlayerInfo($userId)
    {
        $bagId = $this->createBag();
        $this->db->query("INSERT INTO player_info(`location_id`, `bag_id`, `str`, `vit`, `dex`, `user_id`) VALUES (".
            Model_Player::INITIAL_LOCATION_ID.",".$bagId.",".Model_Player::INITIAL_STR.",".
            Model_Player::INITIAL_VIT.",".Model_Player::INITIAL_DEX.",".$userId.")");


    }

    public function getPlayerInfo($userId)
    {
        $info = array();
        $result = $this->db->query("SELECT * FROM player_info WHERE user_id='$userId'");
        $info += mysqli_fetch_assoc($result);
        return $info;
    }

    public function getPlayerSlots($userId)
    {
        $info = array();
        $result = $this->db->query("SELECT * FROM slots WHERE user_id='$userId'");
        $info += mysqli_fetch_assoc($result);
        return $info;
    }

    public function getPlayerBag($userId)
    {
        $info = array();

        $result1 = $this->db->query("SELECT b.id, b.used, b.capacity FROM bags b INNER JOIN player_info p ON (b.id = p.bag_id) WHERE p.user_id='$userId'");
        $row1 = mysqli_fetch_assoc($result1);
        $bagId = $row1['id'];
        $result2 = $this->db->query("SELECT t.*, r.amount, r.id as real_id FROM items t INNER JOIN real_items r ON (t.id = r.item_id) WHERE r.bag_id='$bagId'");
        $info += $row1;
        $info['items'] = array();
        while($row2 = mysqli_fetch_assoc($result2))
            $info['items'][] = $row2;
        return $info;
    }

    public function getPlayerEquipmentBag($userId)
    {
        $info = array();

        $result1 = $this->db->query("SELECT b.id, b.used, b.capacity FROM bags b INNER JOIN player_info p ON (b.id = p.equipment_bag_id) WHERE p.user_id='$userId'");
        $row1 = mysqli_fetch_assoc($result1);
        $info += $row1;
        return $info;
    }

    public function getItemOwner($realItemId)
    {
        $info = array();
        $result = $this->db->query("SELECT p.user_id FROM player_info p INNER JOIN real_items r ON (r.id='$realItemId') WHERE  p.bag_id=r.bag_id OR p.equipment_bag_id=r.bag_id");
        if(mysqli_num_rows($result)==1)
        {
            $info['exists'] = 1;
            $info['user_id'] = mysqli_fetch_assoc($result)['user_id'];
        }
        else
            $info['exists'] = 0;
        return $info;
    }

    public function movePlayer($userId, $locationId)
    {
        $info = array();
        $result = $this->db->query("UPDATE player_info SET location_id='$locationId' WHERE user_id='$userId'");
        if($result === TRUE)
        {
            $info['result'] = 1;
            $_SESSION['location_id'] = $locationId;
        }
        else
            $info['result'] = 0;
        return $info;
    }

    public function dropItem($realItemId, $amount)
    {
        //$bagId = $this->getPlayerBag($userId)['id'];


        $result = $this->db->query("SELECT amount,item_id,bag_id FROM real_items WHERE id='$realItemId'");



        if(mysqli_num_rows($result) == 1)
        {
            $row = mysqli_fetch_assoc($result);
            $bagId = $row['bag_id'];
            $itemId = $row['item_id'];

            $result0 = $this->db->query("UPDATE bags b INNER JOIN items i ON (i.id='$itemId') SET used=used-'$amount'*i.size WHERE b.id='$bagId'");


            $curAmount = $row['amount'];
            $newAmount = $curAmount - $amount;
            if($newAmount > 0)
            {
                $this->db->query("UPDATE real_items SET amount='$newAmount' WHERE id='$realItemId'");
            }
            else
            {
                $this->db->query("DELETE FROM real_items WHERE id='$realItemId'");

                $x = $this->isBagEquipmentBag($row['bag_id']);
                if($x !== false)
                    $this->fixBrokenSlots($x);
            }
        }
    }

    public function isBagEquipmentBag($bagId)
    {
        $result2 = $this->db->query("SELECT user_id FROM player_info WHERE equipment_bag_id=".$bagId);
        if(mysqli_num_rows($result2)>0)
            return mysqli_fetch_assoc($result2)['user_id'];
        else
            return false;
    }


    public function giveItem($itemId, $amount, $bagId)
    {
        //$bagId = $this->getPlayerBag($userId)['id'];

        $isEquipmentBag = $this->isBagEquipmentBag($bagId);

        $result0 = $this->db->query("UPDATE bags b INNER JOIN items i ON (i.id='$itemId') SET used=used+'$amount'*i.size WHERE b.id='$bagId'");


        $result = $this->db->query("SELECT id, amount FROM real_items WHERE item_id='$itemId' AND bag_id='$bagId'");
        if(mysqli_num_rows($result) == 1 && ($isEquipmentBag === false))
        {
            $row = mysqli_fetch_assoc($result);
            $curAmount = $row['amount'];
            $newAmount = $curAmount + $amount;
            $this->db->query("UPDATE real_items SET amount='$newAmount' WHERE item_id='$itemId' AND bag_id='$bagId'");
            return $row['id'];
        }
        else
        {
            $this->db->query("INSERT INTO real_items(`item_id`,`bag_id`,`amount`) VALUES('$itemId','$bagId','$amount')");
            return $this->db->insert_id;
        }
    }


    private function fixBrokenSlots($userId)
    {
        $result = $this->db->query("SELECT * FROM slots WHERE user_id='$userId'");
        $row = mysqli_fetch_assoc($result);
        unset($row['user_id']);
        $q = array();
        foreach ($row as $key => $value)
        {
            if($value == 0)
                continue;
            $result2 = $this->db->query("SELECT COUNT(*) as total FROM real_items WHERE id='$value'");
            if(mysqli_fetch_assoc($result2)['total'] == 0)
            {
                $q[] = $key . "=0";
            }
        }
        if(count($q) > 0)
        {
            $q = "UPDATE slots SET " . join(',', $q) . " WHERE user_id='$userId'";
            $this->db->query($q);
        }

    }

    public function applyAction($userId, $itemId, $realItemId, $actionString, $effectString)
    {
        $equipmantBagId = $this->getPlayerEquipmentBag($userId)['id'];
        $bagId = $this->getPlayerBag($userId)['id'];

        $actionString = $actionString . ',' . $effectString;

        $actionString = str_replace("{item_id}",$itemId,$actionString);
        $actionString = str_replace("{real_item_id}",$realItemId,$actionString);

        $parts = preg_split('/,/',$actionString,-1, PREG_SPLIT_NO_EMPTY);
        foreach ($parts as &$val)
        {
            if($val[0] != '@')
                continue;
            $a = preg_split('/[@#]/',$val,-1,PREG_SPLIT_NO_EMPTY);
            $newVal = "";
            if($a[0] == 'equip')
            {
                $target = $a[1];
                $newRealItemId = $this->giveItem($itemId,1,$equipmantBagId);
                $newVal = sprintf("sl.%s=%d",$target,$newRealItemId);
            }
            else if($a[0] == 'unequip')
            {
                $target = $a[1];
                $newRealItemId = $this->giveItem($itemId,1,$bagId);
                $newVal = sprintf("sl.%s=0",$target);
            }

            $val = $newVal;
        }

        $actionString = join(',',array_filter($parts));

        $info = array();
        $result = $this->db->query("UPDATE player_info s INNER JOIN slots sl ON (s.user_id=sl.user_id) SET " . $actionString . " WHERE s.user_id='$userId'");
        if($result === TRUE)
            $info['result'] = 1;
        else
            $info['result'] = 0;
        return $info;
    }


    public function fixUsedBag($bagId)
    {
        $result = $this->db->query("SELECT r.amount,i.size FROM real_items r INNER JOIN items i ON(r.item_id=i.id) WHERE r.bag_id='$bagId'");
        $used = 0;
        while($row=mysqli_fetch_assoc($result))
            $used += $row['amount'] * $row['size'];
        $this->db->query("UPDATE bags SET used='$used' WHERE id='$bagId'");

    }

}