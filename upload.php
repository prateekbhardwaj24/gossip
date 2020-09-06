

<?php 

    // Database connection
//    include("config/database.php");
    include 'connection.php';
    if(isset($_POST["submit"])) {
        $userid = $_SESSION['user_id'];
        // Set image placement folder
        $target_dir = "profilephotos/";
        // Get file path
        $target_file = $target_dir . basename($_FILES["fileUpload"]["name"]);
        // Get file extension
        $imageExt = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Allowed file types
        $allowd_file_ext = array("jpg", "jpeg", "png");
        

        if (!file_exists($_FILES["fileUpload"]["tmp_name"])) {
           $resMessage = array(
               "status" => "alert-danger",
               "message" => "Select image to upload."
           );
        } else if (!in_array($imageExt, $allowd_file_ext)) {
            $resMessage = array(
                "status" => "alert-danger",
                "message" => "Allowed file formats .jpg, .jpeg and .png."
            );            
        } else if ($_FILES["fileUpload"]["size"] > 20971520) {
            $resMessage = array(
                "status" => "alert-danger",
                "message" => "File is too large. File size should be less than 2 megabytes."
            );
        } else {
            if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
                $sql = "UPDATE profile SET profilePic = '$target_file' WHERE userId = $userid";
                $query = mysqli_query($con, $sql);
                
                 if($query){
                     
                       $insert = "UPDATE my_users1 SET user_profile = '$target_file' WHERE user_id = $userid";
                       $inswr_query = mysqli_query($con, $insert);
                     
                    $resMessage = array(
                        "status" => "alert-success",
                        "message" => "Image uploaded successfully."
                    ); 
                     
              
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