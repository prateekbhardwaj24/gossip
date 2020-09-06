<?php
include 'connection.php';
session_start();
    $userid = $_SESSION['user_id'];

mysqli_query($con, "update react set status=1 where reciever='$userid' ");

?>
