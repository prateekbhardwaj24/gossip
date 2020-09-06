<?php
include "connection.php";
//session_start();




                     if(isset($_GET['user_id'])){
                         global $con;
                         

                         $get_user_id = $_GET['user_id'];
                         $get_user = "select * from my_users1 where user_id= $get_user_id";
                         
                         $run_user = mysqli_query($con, $get_user);
                         $row_user = mysqli_fetch_array($run_user);
                         
//                         $username = $row_user['user_name'];
//                         $user_profile_image = $row_user['user_profile'];
                         $receiver_id = $row_user['user_id'];
//                         $profilePic = $row_user['user_profile'];
                         
                      
                      
                     }
                   
                   
                     

                 

if(isset($_POST["submit"])) {
//        $userid = $_SESSION['user_id'];
        // Set image placement folder
        $target_dir = "Picsend/";
        // Get file path
        $target_file = $target_dir . basename($_FILES["fileUpload"]["name"]);
        $_SESSION['target_file'] = $target_file;
        // Get file extension
        $imageExt = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Allowed file types
        $allowd_file_ext = array("jpg", "jpeg", "png", "mp4", "webM", "ogg", "pdf", "doc", "mp3");
        

        if (!file_exists($_FILES["fileUpload"]["tmp_name"])) {
           $resMessage = array(
               "status" => "alert-danger",
               "message" => "Select image to upload."
           );
        } else if (!in_array($imageExt, $allowd_file_ext)) {
            $resMessage = array(
                "status" => "alert-danger",
                "message" => "Allowed file formats .jpg, .jpeg , .png, .pdf, .mp4, .mp3, .ogg and .webM"
            );            
        } else if ($_FILES["fileUpload"]["size"] > 20971520) {
            $resMessage = array(
                "status" => "alert-danger",
                "message" => "File is too large. File size should be less than 2 megabytes."
            );
        } else {
            if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
                $sql = "insert into user_chating1(sender, receiver, content, status, date) values('$user_id', '$receiver_id', '$target_file', 0 , NOW())";
                $run_insert_query = mysqli_query($con, $sql);
                
                if($run_insert_query){
                    $sql1 = "insert into user_chating2(sender, receiver, content, status, date) values('$user_id', '$receiver_id', '$target_file', 0 , NOW())";
                    $run_insert_query2 = mysqli_query($con, $sql1);
                
                
                $_SESSION['files'] = $imageExt;
                header("refresh: 0.01");
                }

            } else {
                $resMessage = array(
                    "status" => "alert-danger",
                    "message" => "Image coudn't be uploaded."
                );
            }
        }

    }

?>
    