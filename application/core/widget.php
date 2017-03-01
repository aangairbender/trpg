<?php

class Widget extends Controller {

    public $model;
    public $view;

    function __construct()
    {
        $this->view = new View();
    }

    function execute()
    {

    }
}