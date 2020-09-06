<?php
//require 'includes/init.php';
include 'user_profile.php';
include 'func.php';

$get_frnd_num1 = $frnd_obj->get_all_friends($_GET['id'], false);

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

    <link rel="stylesheet" href="swiper.min.css">
    <link rel="stylesheet" href="profile.css">

 


</head>

<body>

    <?php 

//          $con = mysqli_connect("localhost", "root", "", "frnd_req_system");
//
//          $user = $_SESSION['email'];
//          $get_user = "select * from users where user_email='$user'";
//          $run_user = mysqli_query($con, $get_user);
//          $row2 = mysqli_fetch_array($run_user);
//       
//          $user_name = $row2['username'];
//          $user_profile = $row2['user_profile'];
//          $user_country = $row2['user_country'];
//          $user_gender = $row2['user_gender'];
//          $user_email = $row2['user_email'];
//          $user_id = $row2['id'];
//    
//          $_SESSION['email'] = $user_email;
//          $_SESSION['user_id'] = $user_id;
    
    
          
    
    

?>


    

<!--header-->

    <div class="container-fluid">
          <div class="profile-name">
            <div class="header_detail mr-auto ml-4">
                <a href="#" type="button" onclick="goBack()" data-toggle="tooltip" title="Back"> <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>
            </div>
            <div class="mr-auto">
                <h2 class='profilename'><?php echo $user_data->user_name; ?></h2>
            </div>
        </div>
       
<!--       profile image-->
       
       
       <?php
        include "connection.php";
        
        if(isset($_GET['id'])){
        
            $user_id1 = $_GET['id'];
            $select1 = "select * from profile where userId = $user_id1 ";
            $query1 = mysqli_query($con,$select1);
            $row1   = mysqli_fetch_array($query1);
            
            $get_profile = $row1['profilePic'];
        
        ?>
       
       
       
       
       
        <div class="container-fluid mt-4 mb-2">
            <div class="d-flex  imgbx" style="justify-content: center; align-items: center;">
                <div class='pro_image'>
                    <img src="<?php echo $get_profile ?>" id='myimg' alt="paaras" style="width: 200px; height: 200px;">
                </div>
            </div>
        </div>

<?php } ?>

<!--last seen-->
           <?php
         
          $ram = $user_data->lastseen;
        $lastseen = timeAgo($ram);
         
         ?>
        <div class="user_status d-flex mb-2" style="justify-content: center; align-items: center; color:
            #01baef; font-family: serif; letter-spacing: 2px;">
            <p><?php echo $lastseen; ?></p>
        </div>



        <!--        reqst system-->
        <div class="actions text-center mt-4">
            <?php
                if($is_already_friends){
                    echo '<a href="functions.php?action=unfriend_req&id='.$user_data->user_id.'" class="req_actionBtn unfriend btn">Break</a>';
                }
                elseif($check_req_sender){
                    echo '<a href="functions.php?action=cancel_req&id='.$user_data->user_id.'" class="req_actionBtn cancleRequest btn">Disconnect</a>';
                }
                elseif($check_req_receiver){
                    echo '<a href="functions.php?action=ignore_req&id='.$user_data->user_id.'" class="req_actionBtn ignoreRequest btn">Ignore</a>&nbsp;
                    <a href="functions.php?action=accept_req&id='.$user_data->user_id.'" class="req_actionBtn acceptRequest btn">Connect</a>';
                }
                else{
                    echo '<a href="functions.php?action=send_req&id='.$user_data->user_id.'" class="req_actionBtn sendRequest btn">Join</a>';
                }
                ?>

        </div>









        <!--cards-->
        <!--        <div class="container">-->
        <div class="row">

            <div class="col-4">
                <a href="friendpage.php" style="text-decoration: none;">
                    <div class="buddies">
                        <h5>Buddies</h5>
                        
                   
                        <span style="color: #DC143C;"><i class="fa fa-user"> <?php echo $get_frnd_num1 ?></i></span>
                        
                        
                    
                    </div>
                </a>

            </div>

            <div class="col-4">
                <div class=" yellow">
                    <h5>Total react</h5>
                    
                        <?php
                        
                        if(isset($_GET['id'])){
                          $userid2 = $_GET['id'];
                    
                          $select_like = "select * from react where reciever=$userid2";
                          $query_like  = mysqli_query($con, $select_like);
                    
                          $total_like = mysqli_num_rows($query_like);
                        
                        ?>
                    
                    
                    <span><i class="fa fa-thumbs-up"></i> <?php echo $total_like ?></span>
                        <?php } ?>
                </div>

            </div>
            <div class="col-4">
                <div class="green">
                    <h5>Total Post</h5>
                    
                    
                   <?php
                    if(isset($_GET['id'])){
                        $user_pro = $_GET['id'];
    
                    
                        $selectposts = "select * from post where userId = '$user_pro'";
                        $runquerypost = mysqli_query($con,$selectposts);
                        $totalpost=mysqli_num_rows($runquerypost);
                    ?>
                    
                    
                    <span><i class="fa fa-gratipay"></i> <?php echo $totalpost ?></span>
                    <?php } ?>
                    
                </div>

            </div>
        </div>


        <div class="row">

            <?php
                include "connection.php";
                if(isset($_GET['id'])){
                    $user_id = $_GET['id'];
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
                <div class="card ">
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
                </div>

            </div>

            <?php } ?>

        </div>
    </div>

    <!--   </div>-->




    <div id="mymodal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="img01">

    </div>





    <script type="text/javascript" src="swiper.min.js"></script>

<!--
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
