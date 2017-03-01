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

    public function getPlayerBag($userId)
    {
        $info = array();

        $result1 = $this->db->query("SELECT b.id, b.used, b.capacity FROM bags b INNER JOIN player_info p ON (b.id = p.bag_id) WHERE p.user_id='$userId'");
        $row1 = mysqli_fetch_assoc($result1);
        $bagId = $row1['id'];
        $result2 = $this->db->query("SELECT t.*, r.amount FROM items t INNER JOIN real_items r ON (t.id = r.item_id) WHERE r.bag_id='$bagId'");
        $info += $row1;
        $info['items'] = array();
        while($row2 = mysqli_fetch_assoc($result2))
            $info['items'][] = $row2;
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

    public function dropItem($itemId, $amount, $userId)
    {
        $bagId = $this->getPlayerBag($userId)['id'];

        $result = $this->db->query("SELECT amount FROM real_items WHERE item_id='$itemId' AND bag_id='$bagId'");
        if(mysqli_num_rows($result) == 1)
        {
            $row = mysqli_fetch_assoc($result);
            $curAmount = $row['amount'];
            $newAmount = $curAmount - $amount;
            if($newAmount > 0)
            {
                $this->db->query("UPDATE real_items SET amount='$newAmount' WHERE item_id='$itemId' AND bag_id='$bagId'");
            }
            else
            {
                $this->db->query("DELETE FROM real_items WHERE item_id='$itemId' AND bag_id='$bagId'");
            }
        }
    }

}