<!DOCTYPE html>
<?php
ob_start(); 
include "Tlheader.php";
include 'friends.php';
include "send_pic.php";
//include 'connection.php';
//include 'header1.php';
require_once "func.php";


if(!isset($_SESSION['user_email'])){
    header('location:index.php');
}


  //    profile fetch-------------------------------------------------------
    $userid1 = $_SESSION['user_id'];
    $getprofile = "select * from profile where userId='$userid1'";
           $profilequery = mysqli_query($con, $getprofile);
          $profile = mysqli_fetch_array($profilequery);
    $profilePic = $profile['profilePic'];

?>










<div class="container-fluid main-section">
    <div class="row">
        <div class="col-lg-3 col-4 left-sidebar mt-3">

            <div class="input-group-btn mt-2 d-flex justify-content-between" style="align-items: center;">

                <input type="text" placeholder="Search..." id="myinput" class="search-icon p-2 ml-1" style="max-width: 75%">
                <div>
                    <a href="account_settings.php" class="setting mr-3" style="text-decration: none;">
                        <i class="fa fa-cog " style="font-size: 20px;"></i>
                    </a>


                </div>

            </div>

            <div class="left-chat" id="left_chat">
                <ul>
                    <?php
                        
                    include("get_users_data.php");
                    ?>
                </ul>
            </div>
        </div>
        <div class="col-lg-9 col-md-8 right-sidebar" id="right_sidebar">
            <div class="row profile-header">

                <?php
                     
                     $user = $_SESSION['user_email'];
                     $get_user = "select * from my_users1 where user_email = '$user'";
                     $run_user = mysqli_query($con, $get_user);
                     $row = mysqli_fetch_array($run_user);
                     
                     $user_id = $row['user_id'];
                     $user_name = $row['user_name'];
                 ?>

                <?php
                     if(isset($_GET['user_id'])){
                         global $con;
                         

                         $get_user_id = $_GET['user_id'];
                         $get_user = "select * from my_users1 where user_id= $get_user_id";
                         
                         $run_user = mysqli_query($con, $get_user);
                         $row_user = mysqli_fetch_array($run_user);
                         
                         $username = $row_user['user_name'];
                         $user_profile_image = $row_user['user_profile'];
                         $receiver_id = $row_user['user_id'];
//                         $profilePic = $row_user['user_profile'];
                         
                         $select_profile = "select * from profile where userId=$get_user_id";
                         $queryprofile = mysqli_query($con, $select_profile);
                         $fetch_pro = mysqli_fetch_array($queryprofile);
                         
                         $profilePic1 = $fetch_pro['profilePic'];
                  

                 ?>
                <div class="col-md-12 right-header d-flex mt-3" style="align-items: center; height: auto;">
                    <div class="d-flex" style="justify-content: center; align-items: center;">
                        <?php
                        
                        echo '
                        <div class="right-header-img">
                            <a href="#"><img src="'.$profilePic1.'"></a>
                        </div>
                        ';
                            ?>

                    </div>

                    <div class="right-header-detail ml-2">

                        <p><?php echo "$username"; ?></p>

                    </div>

                    <!--
                        <div>
                            <h1>Select time</h1>
                            <form action="" method="post">
                                <select name="time">
                                    <option value="">Select...</option>
                                    <option value="1">1 min</option>
                                    <option value="2">2 min</option>
                                    <option value="3">3 min</option>
                                </select>
                                <input type="submit" name="submit" value="submit">
                            </form>
                    </div>
-->

                    <!--                    3dot-->
                    <div class="dropdown">
                        <div class="Three_dot" data-toggle="dropdown"></div>

                        <!--                    menu-->
                        <div id="myDropdown" class="dropdown-menu">
                            <form action="private.php" method="post">
                                <input id="delete" name="private" class="dropdown-item" type="submit" value="Private chat">
                            </form>
                            <form action="" method="post">
                                <input name="allchat" class="dropdown-item" type="submit" value="Delete all chat">
                            </form>
                            <?php 
                            if(isset($_POST['allchat'])){
                         
                              
                                $delete = "delete from user_chating1 where (sender= '$user_id' AND receiver= '$receiver_id') OR (sender= '$receiver_id' AND receiver= '$user_id')";
                                $deletequery = mysqli_query($con, $delete);
    
                                    if($deletequery){
    
                                        echo"<script>alert('data delete')</script>";
    
                                            }
                                    else{
                                        echo"<script>alert('data  doesno't delete')</script>";  
                                    }
                            }
                                ?>
                            <form action="" method="post">
                                <input name="block" class="dropdown-item" type="submit" value="Block">

                            </form>
                            <?php
                            if(isset($_POST['block'])){
                                $block = "insert into block (blockerID, blockedID, blockOn) values ('$user_id','$receiver_id',NOW())";
                                $blockquery = mysqli_query($con, $block);
                                if($blockquery){
                                    $delete_friends = "delete from friends where (user_one='$user_id' AND user_two='$receiver_id') OR (user_one='$receiver_id' AND user_two='$user_id')";
                                    $Frnds_query = mysqli_query($con, $delete_friends);
                                    
                                    if($Frnds_query){
                                    header("location: demo.php");    
                                    echo"<script>alert('blocked')</script>";
                                    }
                                    
                                }else{
                                    echo"<script>alert(' nooot blocked')</script>";
                                }
                            }
                            ?>

                            <?php echo '
                            <a href="profile1.php?id='.$receiver_id.'" name="profile" class="dropdown-item">Profile</a>';
                         ?>
                        </div>
                    </div>
                    <!--menu-->
                </div>
            </div>
            <div class="row">

                <div id="scrolling_to_bottom" class="col-md-12 right-header-contentchat">
                    <?php
                    $update_msg = mysqli_query($con, "UPDATE user_chating1 SET status= 1 WHERE sender='$receiver_id' AND receiver = '$user_id'");
                        
                    $sel_msg ="select * from user_chating1 where (sender='$user_id' AND receiver='$receiver_id') OR (receiver='$user_id' AND sender ='$receiver_id') ORDER by 1 ASC";
                    $run_msg = mysqli_query($con, $sel_msg);
                    
                    while ($row = mysqli_fetch_array($run_msg)){
                        
                        $sender_user_id = $row['sender'];
                        $receiver_user_id = $row['receiver'];
                        $msg_content = $row['content'];
                        $date = $row['date'];
                        $msg_date = date('h:i a m/d/Y', strtotime($date));
                        $status = $row['status'];
                        
                        $target  = $_SESSION['target_file'];
                        
                    ?>
                    <ul id="private">
                        <?php
                                
                                if($user_id == $sender_user_id AND $receiver_id == $receiver_user_id){
                                    echo"
                                        <li>
                                            <div class='rightside-right-chat' id='chat_delete'>
                                            
                                            ";
                                    if($status == 1){
                                        if($msg_content ==  $target){
                                             echo"
                                           <span class='read'><small>Ⓡ</small></span>
                                           <a href='#'><i class='fa fa-trash'></i></a>
                                            <div class='float-right' style='position: relative;'><a href='$msg_content' download style='position: absolute; background: rgba(275,275,275,0.6);'><i class='fa fa-download' aria-hidden='true' style='font-size: 22px; padding: 5px'></i></a><img src='$msg_content' style='width: 200px; height: 200px;' class='float-right' id='myimg'><div ><small style='font-size: 10px;'>$msg_date</small></div> </div>
                                            </div>
                                    
                                    ";
                                        }
                                        
                                           else{ 
                                        
                                        echo"
                                           <span class='read'><small>Ⓡ</small></span>
                                           <a href='#'><i class='fa fa-trash'></i></a>
                                            <p>$msg_content <span class='float-right'><small style='font-size: 10px;'>$msg_date</small></span> </p>
                                            </div>
                                    
                                    ";
                                    }
                                    }
                                    else{
                                        
                                    if($msg_content ==  $target){
                                             echo"
                                           <span class='read'><small>U</small></span>
                                           <a href='#'><i class='fa fa-trash'></i></a>
                                            <div class='float-right' style='position: relative;'><a href='$msg_content' download style='position: absolute; background: rgba(275,275,275,0.6);'><i class='fa fa-download' aria-hidden='true' style='font-size: 22px; padding: 5px'></i></a><img src='$msg_content' style='width: 200px; height: 200px;' class='float-right' id='myimg'><div ><small style='font-size: 10px;'>$msg_date</small></div> </div>
                                            </div>
                                    
                                    ";
                                        }
                                        
                                           else{ 
                                        
                                        echo"
                                           <span class='read'><small>U</small></span>
                                           <a href='#'><i class='fa fa-trash'></i></a>
                                            <p>$msg_content <span class='float-right'><small style='font-size: 10px;'>$msg_date</small></span> </p>
                                            </div>
                                    
                                    ";
                                    }
                                    }
                                    "
                                        </li>
                                        ";
                         }
                         else if($user_id == $receiver_user_id AND $receiver_id == $sender_user_id){
                             
                             if($msg_content ==  $target){
                                 echo"
                                <li>
                                    <div class='rightside-left-chat'>
                                        <a href='#'><i class='fa fa-trash'></i></a>
                                        <div class='float-left' style='position: relative; ><a href='$msg_content' download style='position: absolute; background: rgba(275,275,275,0.6);'><i class='fa fa-download' aria-hidden='true' style='font-size: 22px; padding: 5px'></i></a><img src='$msg_content' style='width: 200px; height: 200px;' class='float-left' id='myimg'> <div ><small  style='font-size: 10px;'>$msg_date</small></div></div>
                                    </div>
                                </li>
                                ";
                             }
                             else {
                             
                                echo"
                                <li>
                                    <div class='rightside-left-chat'>
                                        <a href='#'><i class='fa fa-trash'></i></a>
                                        <p>$msg_content <span class='float-right'><small  style='font-size: 10px;'>$msg_date</small></span></p>
                                    </div>
                                </li>
                                ";
                            }
                         }
                            
                        ?>

                    </ul>
                    <?php
                         }
                         
                        ?>

                </div>

            </div>

            <div class="row">
                <div class="col-md-12 right-chat-textbox">
                    <form method="post" class="form-control" id="myform" enctype="multipart/form-data">
                        <label for="chooseFile" class="text-dark mb-0" style="font-weight: bold;"><i class="fa fa-paperclip" aria-hidden="true" style="font-size: 25px;"></i></label>
                        <input type="file" name="fileUpload" class="custom-file-input" id="chooseFile">
                        <input autocomplete="off" type="text" name="msg_content" placeholder="Write your message...">
                        <button class="btn" name="submit" id="mybtn"><i class="fa fa-telegram" aria-hidden="true"></i></button>
                    </form>


                    <!--                    image send-->

                    <!-- image send end-->








                </div>



            </div>


        </div>

    </div>

</div>


<?php }

else{
    ?>
<div class="col-md-12 right-header d-flex flex-column mt-3" style="align-items: center; height: auto;">
    <?php
                        
                        echo '
                        <div class="right-header-img mb-4">
                            <a href="#"><img src="prj.jpg" style="width: 200px; height: 200px; border: grey;"></a>
                        </div>
                        
                        <div>
                        <h1 class="mt-3" style="color: #777;">Enjoy!</h1>
                        </div>
                        ';
                            ?>




</div>
<?php
}


?>



<?php
           
        include("connection.php");
       if(isset($_POST['submit'])){
           $msg = htmlentities($_POST['msg_content']);
           if($msg == ""){
               echo"
                    <div class='alert alert-danger'>
                        <strong><center>Message was unable to send</center></strong>
                    </div>
               "; 
           }
           else if(strlen($msg) > 1000000){
               echo"
                    <div class='alert alert-danger'>
                        <strong><center>Message is too long. use only 100 characters </center></strong>
                    </div>
               "; 
           }
          else{
              $insert = "insert into user_chating1(sender, receiver, content, status, date) values('$user_id', '$receiver_id', '$msg', 0 , NOW())";
              $run_insert = mysqli_query($con, $insert);
              header("refresh: 0.01");
               
    }
        
           
       }
   
     
    ?>

<?php

if(isset($_POST['submit'])){
            $select = $_POST['time'];
        
        switch($select){
            case 1:
                 echo"<script>
                   function time(){
                    var text = document.getElementById('private');
                    if(text.style.display !== 'none'){
                    text.style.display = 'none';
                            }
                    else {
                       text.style.display = 'block';

                    }        
                        } 
                    setTimeout(time, 1*60*1000);

                    </script>
                ";  
                break;
            case 2:
                 echo"<script>
                   function time(){
                    var text = document.getElementById('private');
                    if(text.style.display !== 'none'){
                    text.style.display = 'none';
                            }
                    else {
                       text.style.display = 'block';

                    }        
                    
                        } 
                    setTimeout(time, 2*60*1000);

                    </script>
                ";  
                break;
            case 3:
                 echo"<script>
                   function time(){
                    var text = document.getElementById('private');
                    if(text.style.display !== 'none'){
                    text.style.display = 'none';
                            }
                    else {
                       text.style.display = 'block';

                    }        
                    
                        } 
                    setTimeout(time, 3*60*1000);

                    </script>
                ";  
                break;
    

            }
        }



?>


<div id="mymodal" class="modal" style=" display: none;
    position: fixed;z-index: 1;padding-top: 30px; left: 0px;top: 0px; width: 100%;height: 100%;overflow: auto;background-color: rgb(0, 0, 0);background-color: rgba(0, 0, 0, 0.7);">
    <span class="close">&times;</span>
    <img class="modal-content" id="img01" style="  margin: auto; display: block;max-width: 600px;max-height: 600px;">
</div>






<script>
    //        $('#scrolling_to_bottom').animate({
    //            scrollTop: $('#scrolling_to_bottom').get(0).scrollHeight
    //        });

</script>

<script type="text/javascript">
    $(document).ready(function() {
        var height = $(window).height();
        $('.left-chat').css('height', (height - 92) + 'px');
        $('.right-header-contentchat').css('height', (height - 206) + 'px');
    });

</script>


<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

</script>

<script>
    $("#myinput").keydown(function(event) {
        if (event.keyCode === 13) {
            $(this.trigger("#mybtn"))
        }
    });

</script>

<script>
    $(document).ready(function() {
        $("#myinput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".chat").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

</script>



<script>
    $(document).ready(function() {

        function realtime() {
            var time = 0;

            function keepchecking() {
                setTimeout(keepchecking, 1000);

                if (time == 1) {
                    $.ajax({
                        url: "last_seen.php",
                        type: "post",
                        async: true,
                        cache: false,
                        success: function(data) {
                            //                        alert(data);
                            time = 0;
                        },
                        error: function() {
                            time = 0;
                        }
                    })
                }


                if (time == 10) {
                    time = 0;

                }
                time++;

            }
            keepchecking();
        }
        realtime();
    })

</script>
<script>
    $("#chooseFile").change(function() {
        readURL(this);
    });

</script>

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
