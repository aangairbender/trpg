<?php

class Model_Mob extends Model
{

    public function getMobInfo($mobId)
    {
        $result = $this->db->query("SELECT * FROM mobs WHERE id='$mobId'");
        return mysqli_fetch_assoc($result);
    }







}