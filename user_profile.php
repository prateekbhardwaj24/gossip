<?php
require 'includes/init.php';
if(isset($_SESSION['user_id']) && isset($_SESSION['user_email'])){
    if(isset($_GET['id'])){
        $user_data = $user_obj->find_user_by_id($_GET['id']);
        if($user_data ===  false){
            header('Location: friendpage.php');
            exit;
        }
        else{
            if($user_data->user_id == $_SESSION['user_id']){
                header('Location: friendpage.php');
                exit;
            }
        }
    }
}
else{
    header('Location: logout.php');
    exit;
}
// CHECK FRIENDS
$is_already_friends = $frnd_obj->is_already_friends($_SESSION['user_id'], $user_data->user_id);
//  IF I AM THE REQUEST SENDER
$check_req_sender = $frnd_obj->am_i_the_req_sender($_SESSION['user_id'], $user_data->user_id);
// IF I AM THE REQUEST RECEIVER
$check_req_receiver = $frnd_obj->am_i_the_req_receiver($_SESSION['user_id'], $user_data->user_id);

// TOTAL REQUESTS
$get_req_num = $frnd_obj->request_notification($_SESSION['user_id'], false);
// TOTAL FRIENDS
$get_frnd_num = $frnd_obj->get_all_friends($_SESSION['user_id'], false);
?>
