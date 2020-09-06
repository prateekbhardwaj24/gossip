<?php

//session_start();
require 'includes/init.php';
include 'upload.php';
include "connection.php";

include "friends.php";
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>

<!--    <link rel="stylesheet" href="swiper.min.css">-->
    <link rel="stylesheet" href="profile.css">




</head>

<body>

    <?php 

         $con = mysqli_connect("localhost", "root", "", "mychat");

          $user = $_SESSION['user_email'];
          $get_user = "select * from my_users1 where user_email='$user'";
          $run_user = mysqli_query($con, $get_user);
          $row2 = mysqli_fetch_array($run_user);
       
          $user_name = $row2['user_name'];
//          $user_profile = $row2['user_profile'];
          $user_country = $row2['user_country'];
          $user_gender = $row2['user_gender'];
          $user_email = $row2['user_email'];
          $user_id = $row2['user_id'];
    
//          $_SESSION['email'] = $user_email;
//          $_SESSION['user_id'] = $user_id;
//    
//    profile fetch-------------------------------------------------------
    $userid1 = $_SESSION['user_id'];
    $getprofile = "select * from profile where userId='$userid1'";
           $profilequery = mysqli_query($con, $getprofile);
          $profile = mysqli_fetch_array($profilequery);
    $profilePic = $profile['profilePic'];
    
    

?>
    <!--    slide-->
    <div class="container-fluid">
        <div class="profile-name">
            <div class="header_detail mr-auto ml-4">
                <a href="#" type="button" onclick="goBack()" data-toggle="tooltip" title="Back"> <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>
            </div>
            <div class="mr-auto">
                <h2 class='profilename'><?php echo "$user_name"; ?></h2>
            </div>
        </div>


        <!--       image uplaod start -->

        <div class="profilediv container-fluid mt-3">
            <form action="" method="post" enctype="multipart/form-data">

                <div class='imgbx d-flex' style="justify-content: center; align-items: center; flex-direction: column; position: relative;">

                    <div class="image_show">
                       <input type="file" name="fileUpload" class="custom-file-input" id="chooseFile" onclick="myFunction()">

                        <div class="pro_image">
                            <img style="height:210px; width:210px;" src="<?php echo $profilePic ?>" id='myimg' alt="paaras">
                        </div>


                        <!--                    middle section-->
                        <div class="middle">

                            <label for="chooseFile" class="text-dark mb-0" style="font-weight: bold; font-family: serif;"><i class="fa fa-edit text-dark"></i>Change Profile</label>
                          <form action="" method="post">
                              <button name="delete_profile" class="text-dark mt-0 delete_profile" type="submit" value="Delete Profile" style="font-weight: bold; font-family: serif; background: none; border: none;"><i class="fa fa-trash text-dark"></i>Delete Profile</button>
                           </form>
                           <?php
                            
                                //session_start();
                              

                                if(isset($_POST['delete_profile'])){
                                    
                                $con = mysqli_connect("localhost", "root", "", "mychat");

                                $userid = $_SESSION['user_id'];
                                $default_profile = "defaultProfile.png";      

                                $delete = "update profile set profilePic='$default_profile' where userId='$userid'";
//                                $query1 = mysqli_query($con, $delete);

                                    if(mysqli_query($con, $delete)){
                                        echo'<script>alert("delete data")</script>';
//                                        header("location: myprofile.php");
                                    }
                                    else{
                                        echo'<script>alert("data not delete")</script>';
//                                        header("location: myprofile.php");
                                    }
                                }

                                ?>

                       
                        </div>
                    </div>

                    <!--                    ....... end-->

                    <div class="user-image text-center" style="display:none;" id="imagehide">
                        <div style="width: 40px;  height: 40px; border-radius:50%; overflow: hidden; background: #cccccc;">
                            <img src="..." class="figure-img img-fluid rounded" id="imgPlaceholder" alt="">
                        </div>
                        <button type="submit" name="submit" id="myDIV" class="btn btn-primary" style="display:none;">
                            Upload
                        </button>
                    </div>
                    <!--
                    <button type="submit" name="submit" id="myDIV" class="btn btn-primary" style="display:none;">
                        Upload
                    </button>
-->
                    <!--                    </div>-->

                </div>


                <!--
                        <button type="submit" name="submit" id="myDIV" class="btn btn-primary" style="display:none;">
                            Upload File
                        </button>
-->

<!--                <input type="file" name="fileUpload" class="custom-file-input" id="chooseFile" onclick="myFunction()">-->
            </form>

        </div>

        <!--image uplaod end-->

        <!-- Display response messages -->
        <?php if(!empty($resMessage)) {?>
        <div class="alert <?php echo $resMessage['status']?>">
            <?php echo $resMessage['message']?>
        </div>
        <?php }?>
        <!--cards-->
        <!--        <div class="container">-->
        <div class="row">




            <div class="col-4">

                <div class="buddies">
                    <h5>Buddies</h5>
                    <span style="color: #DC143C;"><i class="fa fa-user"> <?php echo $get_frnd_num ?></i></span>
                </div>


            </div>

            <div class="col-4">
                <div class=" yellow">
                   
                   <?php
                    $userid2 = $_SESSION['user_id'];
                    
                    $select_like = "select * from react where reciever=$userid2";
                    $query_like  = mysqli_query($con, $select_like);
                    
                    $total_like = mysqli_num_rows($query_like);
                    
                    
                    ?>
                   
                   
                   
                    <h5>Total react</h5>
                    <span><i class="fa fa-thumbs-up"></i> <?php echo $total_like ?></span>
                </div>

            </div>
            <div class="col-4">
                <div class="green">
        
                   <?php
                    $selectposts = "select * from post where userId = '$userid2'";
                        $runquerypost = mysqli_query($con,$selectposts);
                        $totalpost=mysqli_num_rows($runquerypost);
                    ?>
                   
                    <h5>Total Post</h5>
                    <span><i class="fa fa-gratipay"></i> <?php echo $totalpost ?></span>
                </div>

            </div>
        </div>
        <div class="row">



            <?php
            
    include "connection.php";
            
    $user_id = $_SESSION['user_id'];    
    $select = "select * from profile where userId = $user_id ";
    $query = mysqli_query($con,$select);
    $row   = mysqli_fetch_array($query);
    
    $shortBio = $row['shortBio'];
    $currentCity = $row['currentCity'];
    $language  = $row['language'];
    $country  = $row['country'];
    $dob     = $row['dob'];
    $lifeEvent = $row['lifeEvent'];
    $professional = $row['professional'];
        
                
            
            
            ?>




            <div class="col-12 mb-4">
                <div class="card">
                    <div class="container">
                       
                        <?php
                            
                            if($shortBio){
                            
                            ?>
                        <div class="row">
                            <div class="col-md-2"></div>
                            
                           
                            
                            <div class="col-md-8">
                                <div class="short_bio text-success">
                                    <p class="ml-2"><i class="fa fa-book text-secondary"></i><?php echo $shortBio ?></p>
                                </div>
                            </div>
                            
                            

                            <div class="col-md-2"></div>

                        </div>
                        <?php } ?>
                        
                      
                        <div class="row">
                           
                           <?php 
                            
                            if($dob){
                            
                            
                            ?>
                            <div class="col-md-3">
                                <div class="birth">
                                    <p><i class="fa fa-birthday-cake mr-2 text-danger"></i><?php echo $dob ?></p>
                                </div>

                            </div>
                            
                            <?php } ?>
                            
                            <?php 
                            
                            if($language){
                            
                            
                            ?>
                            
                            <div class="col-md-3">
                                <div class="language">
                                    <p><i class="fa fa-language mr-2"></i><?php echo $language ?></p>

                                </div>
                            </div>
                            
                            <?php } ?>
                            
                            <?php
                            if($country){
                            
                            ?>

                            <div class="col-md-3">
                                <div class="country">
                                    <p><i class="fa fa-globe mr-2 text-primary" aria-hidden="true"></i><?php echo $country ?></p>

                                </div>

                            </div>
                            
                            <?php } ?>
                            
                            <?php 
                            if($currentCity){
                            
                            ?>
                            <div class="col-md-3">
                                <div class="Ccity">
                                    <p><i class="fa fa-home mr-2 text-warning" aria-hidden="true"></i><?php echo $currentCity ?></p>
                                </div>

                            </div>
                            
                            <?php } ?>

                        </div>
                        
                     
                     

                        <div class="row mb-3">
                           
                           <?php 
                            if($professional){
                            
                            ?>
                            <div class="col-md-6">
                                <div class="profession">
                                    <p class="ml-2"><?php echo $professional ?></p>

                                </div>

                            </div>
                            
                            <?php } ?>
                            
                            <?php 
                            if($lifeEvent){
                            
                            ?>
                            <div class="col-md-6">
                                <div class="lifeE">
                                    <p class="ml-2"><?php echo $lifeEvent ?></p>

                                </div>

                            </div>
                            <?php } ?>

                        </div>
                        
                   


                    </div>




                    <!--                    <h4></h4>-->
                    <!--                    <h4></h4>-->
                    <!--                    <h4></h4>-->
                    <!--                    <h4></h4>-->
                    <!--                    <h4></h4>-->
                    <!--                    <h4></h4>-->
                    <!--                    <h4></h4>-->
                </div>

            </div>

        </div>
    </div>

    <!--    </div>-->




    <div id="mymodal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="img01">

    </div>





    <!--
    <script type="text/javascript" src="swiper.min.js"></script>

    <script>
        var swiper = new Swiper('.swiper-container', {
            effect: 'coverflow',
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: 'auto',
            coverflowEffect: {
                rotate: 20,
                stretch: 0,
                depth: 350,
                modifier: 1,
                slideShadows: true,
            },

        });

    </script>
-->

    <script>
        var modal = document.getElementById("mymodal");
        var img = document.getElementById("myimg");
        var modalimg = document.getElementById("img01");
        img.onclick = function() {
            modal.style.display = "block";
            modalimg.src = this.src;
        }
        var span = document.getElementsByClassName("close")[0];

        span.onclick = function() {
            modal.style.display = "none";
        }

    </script>




    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#imgPlaceholder').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#chooseFile").change(function() {
            readURL(this);
        });

    </script>

    <script>
        function myFunction() {
            var x = document.getElementById("myDIV");
            var y = document.getElementById("imagehide");
            if (x.style.display === "none" && y.style.display === "none") {
                x.style.display = "block";
                y.style.display = "block";
            } else {
                x.style.display = "none";
                y.style.display = "none";
            }
        }

    </script>

    <script>
        var modal = document.getElementById('mymodal');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

    </script>

    <script>
        function goBack() {
            window.history.back();
        }

    </script>


</body>

</html>
