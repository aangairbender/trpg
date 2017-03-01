<?php
session_start();
ini_set('display_errors', 1);

function __autoload($class_name) {
    $class_name = strtolower($class_name);
    if(file_exists('application/controllers/' . $class_name . '.php'))
        require_once 'application/controllers/' . $class_name . '.php';

    if(file_exists('application/core/' . $class_name . '.php'))
        require_once 'application/core/' . $class_name . '.php';


    if(file_exists('application/models/' . $class_name . '.php'))
        require_once 'application/models/' . $class_name . '.php';


    if(file_exists('application/widgets/' . $class_name . '.php'))
        require_once 'application/widgets/' . $class_name . '.php';

   // die(('/application/widgets/' . $class_name . '.php'));

}

require_once 'application/db.php';
require_once 'application/boot.php';