<?php
session_start();
require_once "func.php";
$ae = $_SESSION['user'];

updatelastseen($ae);

?>