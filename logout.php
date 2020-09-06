<?php
session_start();

if(isset($_SESSION['user_name'])){
    unset($_SESSION['user_name']);
     $_SESSION['msg'] = "you are logeed out.";

    header("location:index.php");
}
else{
     $_SESSION['msg'] = "you are logeed out.";
    header("location:index.php");
}
?>
