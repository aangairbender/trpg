<?php

class Model_Game extends Model
{

    public function getLocationInfo($location_id)
    {
        $info = array();
        $result = $this->db->query("SELECT * FROM locations WHERE id='$location_id'");
        $row = mysqli_fetch_assoc($result);
        $info += $row;
        return $info;
    }

    public function getLocationTransitions($location_id)
    {
        $info = array();
        $result = $this->db->query("SELECT l.id, l.title FROM locations l INNER JOIN transitions t ON (t.to_id = l.id) WHERE t.from_id='$location_id'");
        while($row = mysqli_fetch_assoc($result))
        {
            $info['transitions'][] = $row;
        }
        return $info;
    }

    public function movePlayer($userId, $locationId)
    {
        $info = array();
        $result = $this->db->query("UPDATE users SET location_id='$locationId' WHERE id='$userId'");
        if($result === TRUE)
        {
            $info['result'] = 1;
            $_SESSION['location_id'] = $locationId;
        }
        else
            $info['result'] = 0;
        return $info;
    }

}