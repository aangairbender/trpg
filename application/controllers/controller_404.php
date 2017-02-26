<?php

class Controller_404 extends Controller
{
    function action_index()
    {

        $data = array();
        $data['content_view'] = '404_view.php';

        $this->view->render($data);
    }
}