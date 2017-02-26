<?php

$db = mysqli_connect('localhost', 'root', '', 'trpg', '3306');
$db->set_charset('utf8');
$GLOBALS['db'] = &$db;