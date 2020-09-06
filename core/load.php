<?php

include 'database/connection.php';
include 'classes/users5.php';
include 'classes/post5.php';

global $pdo;

$loadFromUser = new Users($pdo);
$loadFromPost = new Post($pdo);

define("BASE_URL", "http://localhost/mychat/");


?>
