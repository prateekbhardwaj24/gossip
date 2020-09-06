<?php
require 'init.php';

if(isset($_SESSION['user_id']) && isset($_SESSION['user_email'])){
  $user_data = $user_obj->find_user_by_id($_SESSION['user_id']);
    if($user_data === false){
        header('Location: logout.php');
        exit();
    }
}
    else{
        header('Location: logout.php');
        exit();
    }
    $get_reqst_num  =$frnd_obj->reqst_notification($_SESSION['user_id'], false);
    $get_frnd_num = $frnd_obj->get_all_frnd($_SESSION['user_id'], false);
    $get_all_frnd = $frnd_obj->get_all_frnd($_SESSION['user_id'], true);
?>
