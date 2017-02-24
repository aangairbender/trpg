<?php

$db = mysqli_connect('localhost', 'root', '', 'trpg', '3306');
$GLOBALS['db'] = &$db;