<?php

class Controller_Game extends Controller
{

    private $playerModel;
    private $itemModel;
    private $authModel;

    function __construct()
    {
        $this->view = new View("template_view.php");
        $this->model = new Model_Game();
        $this->playerModel = new Model_Player();
        $this->itemModel = new Model_Item();
        $this->authModel = new Model_Auth();
    }

    function action_index()
    {
        $data = array();
        $data['content_view'] = 'location_view.php';


        $data += $this->model->getLocationInfo($_SESSION['location_id']);
        $data['transitions'] =  $this->model->getLocationTransitions($_SESSION['location_id']);
        $data['characters'] =  $this->model->getPlayersAtLocation($_SESSION['location_id']);

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
        $q = $this->authModel->getUserInfo($userId);
        $data += $q;

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
        $itemId = $params[0];
        $data = array();
        $data['content_view'] = 'item_view.php';


        $data += $this->itemModel->getItemInfo($itemId);

        $data['actions'] = $this->itemModel->getItemActions($itemId);

        $this->view->render($data);
    }

    function action_itemdrop($params)
    {
        $itemId = $params[0];
        $amount = $params[1];
        $userId = $_SESSION['id'];

        $this->playerModel->dropItem($itemId, $amount, $userId);

        Route::redirect('/game/bag/');
    }

    function action_itemaction($params)
    {
        $actionId = $params[0];
        $q = $this->itemModel->getActionInfo($actionId);
        $itemId = $q['item_id'];

        $this->itemModel->applyAction($_SESSION['id'],$q['use_effect']);
        $this->playerModel->dropItem($itemId, 1, $_SESSION['id']);

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