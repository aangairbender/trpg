<?php

class Model_Npc extends Model
{

    private $itemModel;

    public function __construct()
    {
      parent::__construct();
      $this->itemModel = new Model_Item();
    }

    public function getNpcInfo($npcId)
    {
        $result = $this->db->query("SELECT * FROM npcs WHERE id='$npcId'");
        return mysqli_fetch_assoc($result);
    }

    public function getNpcData($npcId)
    {
      $method = "getId" . $npcId . "Data";
      return $this->$method();
    }

    private function getId2Data()
    {
      $items = array();
      $items[] = $this->itemModel->getItemInfo(3);
      $items[0]['cost'] = 10;
      $items[] = $this->itemModel->getItemInfo(5);
      $items[1]['cost'] = 3;
      return array("items" => $items);
    }







}
