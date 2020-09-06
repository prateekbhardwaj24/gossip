<?php
           include 'connection.php';
           session_start();
           $user1 = $_SESSION['user_email'];
           $get_user1 = "select * from profile where user_email='$user1'";
           $run_user1 = mysqli_query($con, $get_user1);
    
           $row3 = mysqli_fetch_array($run_user1);
           
           $user_id = $row3['user_id'];
        
        
        if(isset($_POST['update'])){
            $image = $_FILES['image']['name'];
            $target = "image/".basename($image);
            
            $insert ="INSERT INTO profile (profiles) VALUES('$image') WHERE user_email='$user1' AND user_id=$user_id ";
             $run = mysqli_query($con, $insert);
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  				echo"<script>alert('Your Profile Updated')</script>";
                echo "<script>window.open('profile1.php', '_self')</script>";
              exit(); 
  			}else{
  				echo"<script>alert('Your Profile doesn't Updated')</script>";
               echo "<script>window.open('profile1.php', '_self')</script>";
              exit();
			  }


        } 
        
        ?>
