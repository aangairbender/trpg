<?php

class Controller_Main extends Controller
{
    function action_index()
    {
        $this->view->generate('404_view.php', 'template_view.php');
    }
}