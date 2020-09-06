<?php
require 'init.php';

function redirect_to_profile(){
    header('Location: findpage.php');
    exit();
}

if(isset($_GET['action']) && isset($_GET['id'])){
    if(isset($_SESSION['user_id']) && isset($_SESSION['user_email'])){
        if($_GET['id'] == $_SESSION['user_id']){
            redirect_to_profile();
        }
        else{
            $user_id = $_GET['id'];
            $my_id = $_SESSION['user_id'];
            
            if($_GET['action'] == 'send_req'){
                
                if($frnd_obj->is_reqst_already_sent($my_id, $user_id)){
                    redirect_to_profile();
                }
                else if($frnd_obj->is_already_friends($my_id, $user_id)){
                     redirect_to_profile();
                }
                else{
                    $frnd_obj->send_friend_rqst($my_id, $user_id);
                }
            }
            else if($_GET['action'] == 'cancel_req' || $_GET['action'] == 'ignore_req'){
                $frnd_obj->cancel_reqst($my_id, $user_id)
            }
                
            else if($_GET['action'] == 'accept_req'){
                if($frnd_obj->is_already_friends($my_id, $user_id)){
                    redirect_to_profile();
                }
                else{
                    $frnd_obj-> make_frnd($my_id, $user_id);
                }
            }
            else if($_GET['action'] == 'unfriend_req'){
                $frnd_obj->delete_frnd($my_id, $user_id);
            }
            else{
               redirect_to_profile(); 
            }    
            
        }
        
    }
    else{
        header('Location: logout.php');
        exit();
    }
}
else{
    redirect_to_profile(); 
}
?>
