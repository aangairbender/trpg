<?php

class Controller_Auth extends Controller
{

    function __construct()
    {
        parent::__construct();
        $this->model = new Model_Auth();
    }

    function action_index()
    {
        $data = array();
        $data['content_view'] = 'welcome_view.php';

        $this->view->render($data);
    }

    function action_signin()
    {

        $data = array();
        $data['content_view'] = 'signin_view.php';

        if(isset($_POST['username']) && isset($_POST['password']))
        {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $q = $this->model->isUserRegistered($username, $password);
            if($q['result'] == 1)
            {
                $res = $this->model->authentificate($q['id']);
                if($res['result'] == 1)
                    Route::redirect('/game/');
                else
                    $data['error'] = 'Неизвестная ошибка, обратитесь в поддержку';
            }
            else if($q['result'] == 2)
            {
                $data['error'] = "Неправильный пароль";
                $data['user_id'] = $q['id'];
            } else
                $data['error'] = "Данный логин не зарегистрирован в игре";

        }

        $this->view->render($data);
    }

    function action_signup()
    {

        $data = array();
        $data['content_view'] = 'signup_view.php';

        if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm_password']) && $_POST['password'] == $_POST['confirm_password'])
        {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $q = $this->model->isUserRegistered($username);
            if($q['result'] == 0)
            {
                $res = $this->model->registerUser($username, $password);
                if($res['result'] == 1)
                {
                    $this->model->authentificate($q['id']);
                    Route::redirect('/game/');
                }
                else
                    $data['error'] = 'Неизвестная ошибка, обратитесь в поддержку';
            }
            else
                $data['error'] = "Данный логин уже зарегистрирован в игре";

        }

        $this->view->render($data);
    }
}