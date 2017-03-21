<?php

class Controller_Game extends Controller
{

    private $playerModel;
    private $itemModel;
    private $authModel;
    private $mobModel;

    function __construct()
    {
        $this->view = new View("template_view.php");
        $this->model = new Model_Game();
        $this->playerModel = new Model_Player();
        $this->itemModel = new Model_Item();
        $this->authModel = new Model_Auth();
        $this->mobModel = new Model_Mob();
    }

    function action_index()
    {
        $data = array();
        $data['content_view'] = 'location_view.php';


        $data += $this->model->getLocationInfo($_SESSION['location_id']);
        $data['transitions'] =  $this->model->getLocationTransitions($_SESSION['location_id']);
        $data['characters'] =  $this->model->getPlayersAtLocation($_SESSION['location_id']);
        $data['mobs'] = $this->model->getMobsAtLocation($_SESSION['location_id']);

        $this->view->render($data);
    }

    function action_mob($params)
    {
        $mobId = $params[0];
        $data = array();
        $data['content_view'] = 'mob_view.php';

        $data += $this->mobModel->getMobInfo($mobId);

        $this->view->render($data);
    }



    function action_goto($params)
    {
        $location_id = $params[0];
        $this->playerModel->movePlayer($_SESSION['id'], $location_id);
        Route::redirect('/game/');
    }

    function action_profile($params)
    {
        $data = array();
        $data['content_view'] = 'profile_view.php';
        $userId = $params[0];
        $data += $this->playerModel->getPlayerInfo($userId);
        $data['equipment_bag'] = $this->playerModel->getPlayerEquipmentBag($userId);
        $q = $this->playerModel->getPlayerSlots($userId);
        unset($q['user_id']);


        foreach ($q as $key => &$value)
        {
            $newValue = array();
            $newValue['real_id'] = $value;
            $itemId = $this->itemModel->getItemId($value);
            if($value > 0)
                $newValue += $this->itemModel->getItemInfo($itemId);
            $value = $newValue;
        }

        $data['slots'] = $q;

        $data += $this->authModel->getUserInfo($userId);




        $this->view->render($data);
    }

    function action_user()
    {
        $data = array();
        $data['content_view'] = 'user_view.php';
        $data['username'] = $_SESSION['username'];
        $data['id'] = $_SESSION['id'];

        $this->view->render($data);
    }

    function action_item($params)
    {
        $realItemId = $params[0];
        $data = array();
        $data['content_view'] = 'item_view.php';

        $itemId = $this->itemModel->getItemId($realItemId);

        $data += $this->itemModel->getItemInfo($itemId);
        $data['real_id'] = $realItemId;

        $qOwner = $this->playerModel->getItemOwner($realItemId);

        if(($qOwner['exists']==1 && $qOwner['user_id'] == $_SESSION['id']) || ($qOwner['exists']==0)) {
            $data['show_actions'] = 1;
            $data['actions'] = $this->itemModel->getItemActions($itemId, $realItemId, $_SESSION['id']);
        }
        else
            $data['show_actions'] = 0;

        $this->view->render($data);
    }

    function action_itemdrop($params)
    {
        $realItemId = $params[0];
        $amount = $params[1];
        $userId = $_SESSION['id'];

        $this->playerModel->dropItem($realItemId, $amount);

        Route::redirect('/game/bag/');
    }

    function action_itemaction($params)
    {
        $actionId = $params[0];
        $realItemId = $params[1];
        $q = $this->itemModel->getActionInfo($actionId);
        $itemId = $q['item_id'];
        $effectId = $q['effect_id'];

        $q2 = $this->itemModel->getEffectInfo($effectId);

        $this->playerModel->dropItem($realItemId, 1);
        $this->playerModel->applyAction($_SESSION['id'],$itemId, $realItemId, $q['use_action'], $q2['use_effect']);

        Route::redirect('/game/bag/');

    }


    function action_bag()
    {
        $data = array();
        $data['content_view'] = 'bag_view.php';



        $data += $this->playerModel->getPlayerBag($_SESSION['id']);


        $this->view->render($data);
    }
}