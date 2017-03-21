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
        $result = $this->db->query("SELECT l.id, l.title FROM locations l INNER JOIN transitions t ON (t.to_id = l.id) WHERE t.from_id='$location_id' ORDER BY priority,title");
        while($row = mysqli_fetch_assoc($result))
        {
            $info[] = $row;
        }
        return $info;
    }

    public function getPlayersAtLocation($locationId)
    {
        $info = array();
        $result = $this->db->query("SELECT u.id, u.username FROM users u INNER JOIN player_info p ON(u.id = p.user_id) WHERE p.location_id='$locationId'");
        while($row = mysqli_fetch_assoc($result))
        {
            $info[] = $row;
        }
        return $info;
    }

    public function getMobsAtLocation($locationId)
    {
        $info = array();
        $result = $this->db->query("SELECT id, title FROM mobs WHERE location_id='$locationId'");
        while($row = mysqli_fetch_assoc($result))
        {
            $info[] = $row;
        }
        return $info;
    }

}