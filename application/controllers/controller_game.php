<?php

class Controller_Game extends Controller
{

    function __construct()
    {
        $this->view = new View("game_template_view.php");
        $this->model = new Model_Game();
    }

    function action_index()
    {
        $data = array();
        $data['content_view'] = 'location_view.php';

        $data += $this->model->getLocationInfo($_SESSION['location_id']);
        $data += $this->model->getLocationTransitions($_SESSION['location_id']);

        $this->view->render($data);
    }

    function action_goto($params)
    {
        $location_id = $params[0];
        $this->model->movePlayer($_SESSION['id'], $location_id);
        Route::redirect('/game/');
    }
}