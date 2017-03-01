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

    public function getItemActions($itemId)
    {
        $info = array();
        $result = $this->db->query("SELECT a.* FROM item_actions a INNER JOIN items i ON(a.item_id=i.id) WHERE i.id='$itemId'");
        while($row = mysqli_fetch_assoc($result))
            $info[] = $row;
        return $info;
    }

    public function getActionInfo($actionId)
    {
        $info = array();
        $result = $this->db->query("SELECT * FROM item_actions WHERE id='$actionId'");
        $info += mysqli_fetch_assoc($result);
        return $info;
    }

    public function applyAction($userId, $actionString)
    {
        $info = array();
        $result = $this->db->query("UPDATE player_info s SET " . $actionString . " WHERE user_id='$userId'") or die(mysqli_error($this->db));
        if($result === TRUE)
            $info['result'] = 1;
        else
            $info['result'] = 0;
        return $info;

    }




}