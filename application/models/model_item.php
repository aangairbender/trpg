<?php

class Model_Item extends Model
{

    public function getItemInfo($itemId)
    {
        $info = array();
        $result = $this->db->query("SELECT * FROM items WHERE id='$itemId'");
        $info += mysqli_fetch_assoc($result);
        return $info;
    }

    public function getItemActions($itemId, $realItemId, $userId)
    {
        $info = array();
        $result = $this->db->query("SELECT a.* FROM item_actions a INNER JOIN actions_to_items i ON(a.id=i.action_id) WHERE i.item_id='$itemId'");
        while($row = mysqli_fetch_assoc($result))
        {
            $condition = $row['use_condition'];
            if($condition=="")
                $condition = "1=1";
            $condition = str_replace('{real_item_id}', $realItemId, $condition);
            $condition = str_replace('{item_id}', $itemId, $condition);
            $q = "SELECT COUNT(*) as total FROM player_info s INNER JOIN slots sl ON (s.user_id=sl.user_id) WHERE s.user_id='$userId' AND ( " .$condition . ")";

            $result2 = $this->db->query($q) or die(mysqli_error($this->db));
            if(mysqli_fetch_assoc($result2)['total']>0)
                $info[] = $row;
        }
        return $info;
    }

    public function getItemId($realItemId)
    {
        $result = $this->db->query("SELECT item_id FROM real_items WHERE id='$realItemId'");
        return mysqli_fetch_assoc($result)['item_id'];
    }

    public function getActionInfo($actionId)
    {
        $info = array();
        $result = $this->db->query("SELECT s.*,a.item_id,a.effect_id FROM item_actions s INNER JOIN actions_to_items a ON(s.id=a.action_id) WHERE s.id='$actionId'");
        $info += mysqli_fetch_assoc($result);
        return $info;
    }

    public function getEffectInfo($effectId)
    {
        $result = $this->db->query("SELECT * FROM effects WHERE id='$effectId'");
        return mysqli_fetch_assoc($result);
    }







}