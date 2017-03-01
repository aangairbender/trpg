<?php

class Widget_Userinfo extends Widget
{
    protected $authModel;

    public function __construct()
    {
        $this->view = new View("info_view.php");
        $this->model = new Model_Player();
        $this->authModel = new Model_Auth();
    }

    public function execute()
    {
        $q = $this->authModel->isSignedIn();

        if($q['result'] == 0 && Route::$routes[1] == 'game')
        {
            $this->authModel->signout();
            Route::redirect('/');
        }
        if($q['result'] == 1 && (count(Route::$routes)<1 || Route::$routes[1] != 'game'))
        {
            Route::redirect('/game/');
        }

        $data = array();
        $data['visible'] = $q['result'];
        if($data['visible'] == 1)
        {
            $q = $this->model->getPlayerInfo($_SESSION['id']);
            $data['username'] = $_SESSION['username'];
            $data['level'] = $q['level'];
            $_SESSION['location_id'] = $q['location_id'];
        }
        $this->view->render($data);
    }

}