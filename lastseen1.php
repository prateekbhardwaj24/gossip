<?php
include 'connection.php';
session_start();

$select = "SELECT * FROM my_users1";
$connection = mysqli_query($con, $select);
$row = mysqli_fetch_array($connection);

$last_seen = $row['last_seen'];
$lastseen = date('h:i a', strtotime($last_seen));




$user_id = $_SESSION['user_id'];

$update_lastseen = "update my_users1 set last_seen = $lastseen where user_id= $user_id";

$query = mysqli_query($con, $update_lastseen);


?>