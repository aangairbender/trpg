<?php

class Model
{
    protected $db;

    function __construct()
    {
        $this->db = &$GLOBALS['db'];
    }
}