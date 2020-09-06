<?php
session_start();
include '../load.php';
include '../../connect/login.php';
if(login::isLoggedIn()){
    $userid = login::isLoggedIn();


//$user_name=    $_SESSION['user_name'];
	

if(isset($_POST['onlyStatusText'])){
    $statusText = htmlspecialchars_decode($_POST['onlyStatusText']);
  $user_name = $_SESSION['user_name'];
	
	
	
	
    $loadFromUser->create('post', array('userId'=>$userid, 'post'=>$statusText, 'postBy'=>$userid, 'user_name'=>$user_name, 'postedOn'=>date('Y-m-d H:i:s')));
	
}
if(isset($_POST['stIm'])){
    $stIm = $_POST['stIm'];
    $statusText = $_POST['statusText'];
  $user_name = $_SESSION['user_name'];
    $loadFromUser->create('post', array('userId'=>$userid, 'post'=>$statusText, 'postBy'=>$userid, 'postImage'=>$stIm,  'user_name'=>$user_name, 'postedOn'=>date('Y-m-d H:i:s')));
   
}
}
else{
header('location: index.php');
}
?>
