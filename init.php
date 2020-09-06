<?php
session_start();
session_regenerate_id(true);

require 'classes/database.php';
require 'classes/user.php';
require 'classes/friend.php';

$db_obj = new Database();
$db_connection = $db_obj->dbconnection();

$user_obj = new User($db_conection);

$frnd_obj = new Friend($db_connection);
?>