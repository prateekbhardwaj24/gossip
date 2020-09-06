
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



<body  onload="myFunction()" style="margin:0;">

<div id="load">
                <div></div>
                <div></div>
                <div></div>
                
 </div>
<div id="fetchingdata">Please wait..</div>
<div style="display:none;" id="myDiv" class="animate-bottom">

<div class="container-fluid main-section">
<!--  <div class="sidenav" id="h_sidenav">-->
   <span style="font-size:30px;cursor:pointer; width: 150px;" onclick="openNav()" class="open_btn"><button class="btn btn-primary">open</button></span>
<!--    </div>-->
    <div class="row">
       
        <div class="col-md-3 left-sidebar mt-1" id="my_Sidenav">
           <h4 class="recent_chats" align="center">Recent Chats</h4>
            <a href="javascript:void(0)" class="closebtn mt-5" onclick="closeNav()" ><i class="fa fa-arrow-circle-left" aria-hidden="true" style="font-size: 20px;"></i></a>

            <div class="input-group-btn mt-2 d-flex justify-content-between" style="align-items: center;">

                <input type="text" placeholder="Search..." id="myinput" class="search-icon p-2 ml-1" style="max-width: 75%">
                <div>
                    <a href="account_settings.php" class="setting mr-3" style="text-decoration: none;" data-toggle="tooltip" title="About">
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
        <div class="col-md-9 col-12 right-sidebar" id="right_sidebar">
            <div class="row profile-header" style="z-index:2;">

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
                         $_SESSION['receiverlock'] = $receiver_id;
                         
                         $select_profile = "select * from profile where userId=$get_user_id";
                         $queryprofile = mysqli_query($con, $select_profile);
                         $fetch_pro = mysqli_fetch_array($queryprofile);
                         
                         $profilePic1 = $fetch_pro['profilePic'];
                  

                 ?>
                <div class="col-md-12 right-header d-flex mt-3" style="align-items: center; height: auto;">
                    <div class="d-flex" style="justify-content: center; align-items: center;">
                        <?php
                        $lockquery = "select locker from lockerroom  where sender = '$user_id' and receiver = '$receiver_id'";
                        $runchecklock1 = mysqli_query($con,$lockquery);
                        $lockedvalue = mysqli_fetch_array($runchecklock1);
                        if(empty($lockedvalue['locker'])){
                        echo '
                        <div class="right-header-img">
                            <a href="#"><img src="'.$profilePic1.'"></a>
                        </div>
    
                        <div> 
                            
                                <button type="button" id="eyeclose" style="font-size:24px" onclick="lockfunc()"> <i class="fa fa-eye"></i></button>
                            
                        </div>
                        ';
                          }else {
                            echo '
                            <div class="right-header-img">
                                <a href="#"><img src="'.$profilePic1.'"></a>
                            </div>
        
                            <div> 
                                
                                    <button type="button" id="eyeclose" style="font-size:24px" onclick="lockfunc()"> <i class="fa fa-eye-slash"></i></button>
                                
                            </div>
                            ';
                          }  ?>
                            

                            
                    <div class="right-header-detail ml-2">

                        <p><?php echo "$username"; ?></p>

                    </div>
                    

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
                                <input type="submit" name="submit1" value="submit">
                            </form>
                    </div>
-->


                    <!--                    3dot-->
                    <div class="dropdown">
                        <div class="Three_dot" data-toggle="dropdown" data-toggle="tooltip" title="Menu"></div>

                        <!--                    menu-->
                        <div id="myDropdown" class="dropdown-menu">
<!--hide drop-->
                            <form action="" method="post">
                                <button id="delete" name="private1" class="dropdown-item" type="submit"  data-toggle="modal" data-target="#myModal">Hide</button>
                            </form>
                            
<!-- block drop-->
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
<!--profile drop-->
                            <?php echo '
                            <a href="profile1.php?id='.$receiver_id.'" name="profile" class="dropdown-item">Profile</a>';
                         ?>
                        </div>
                    </div>
                    
                    
                     <?php
                                if(isset($_POST['private1'])){

                                    $user = $_SESSION['user_email'];
                                    $sel = "select * from my_users1 where user_email='$user'";
                                    $run_user = mysqli_query($con, $sel);
                                    $row = mysqli_fetch_array($run_user);

                                    $unique_id = $row['unique_id'];

                                    if($unique_id == ""){
                            //            echo"<script>window.open('demo3.php', '_self')</script>";
                                        echo "alert('hi')";


                                    }
                                    else{
                            //             echo"<script>window.open('demo4.php', '_self')</script>";

                                        echo '<div id="myModal" class="modal fade" role="dialog">
                                                  <div class="modal-dialog">

                                                    
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Modal Header</h4>
                                                      </div>
                                                      <div class="modal-body">
                                                        <p>Some text in the modal.</p>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                      </div>
                                                    </div>

                                                  </div>
                                                </div>';


                                    }
                                }
                                ?>
                    
                    
                    <!--menu-->
                </div>
            </div>
            <div class="row d-flex justify-content-center">

                                 
                   <!--            eye button on click code-->
     
  <!--            eye button on click code-->
<?php 

$checklock = "select 'lockpass' , 'locker' from lockerroom  where sender = '$user_id' and receiver = '$receiver_id'";
$runchecklock = mysqli_query($con,$checklock);
$fetchlockfields = mysqli_fetch_assoc($runchecklock);
$unlocked = mysqli_real_escape_string($con,'unlocked');                
if(empty($fetchlockfields['lockpass']) and empty($fetchlockfields['locker'])){
?>

  <div id="eyemodal" class="modaleye col-md-4">

      <!-- Modal content -->
      <div class="modal-content-eye">
          <form action="lockchat.php" method="post">
              <div class="modal-header-eye">
                  <span class="closecrosseye">&times;</span>
                  <h4>Lock your chat box</h4>
              </div>
              <div class="modal-body-eye">
                  <input type="password" name="lockpass" placeholder="Enter new password">
                  <input type="password" name="conlockpass" placeholder="Confirm password">
              </div>
              <div class="submitlock">
                  <button type="submit" class="btn-success" name="locksubmit">submit</button>
              </div>
          </form>
      </div>

  </div>


  <?php }else {
  $select = "select locker from lockerroom where sender = '$user_id' and receiver = '$receiver_id'";
  $resultquery = mysqli_query($con,$select);
  $fetcharray = mysqli_fetch_array($resultquery);


  if(empty($fetcharray['locker'])){?>
  <div id="eyemodal" class="modaleye col-md-4">

      <!-- Modal content -->
      <div class="modal-content-eye">
          <form action="lockchat.php" method="post">
              <div class="modal-header-eye">
                  <span class="closecrosseye">&times;</span>
                  <h4>lock your chats again </h4>
              </div>
              <div class="modal-body-eye">
                  <input type="password" name="lockagainpass" placeholder="Enter your password">

              </div>
              <div class="submitlock">
                  <button type="submit" class="btn-success" name="lockagain">lock</button>
              </div>
          </form>
      </div>

  </div>
  <?php }else{?>
  
  <div id="eyemodal" class="modaleye col-md-4">

<!-- Modal content -->
<div class="modal-content-eye">
    <form action="lockchat.php" method="post">
        <div class="modal-header-eye">
            <span class="closecrosseye">&times;</span>
            <h4>unlock your chats again</h4>
        </div>
        <div class="modal-body-eye">
            <input type="password" name="unlockpass" placeholder="Enter your password">

        </div>
        <div class="submitlock">
            <button type="submit" class="btn-success" name="unlock">Unlock</button>
        </div>
    </form>
</div>

</div>

  
  <?php } }?>

             
              
               
<!--               chekiing lock status from lockerroom-->
               <?php 
                    
                      $selectlockstatus = "select locker from lockerroom where sender = '$user_id' and receiver = '$receiver_id'";
                         $runlockerstatus = mysqli_query($con,$selectlockstatus);
                         $fetchlockervalue = mysqli_fetch_array($runlockerstatus);
                        
                         if(!empty($fetchlockervalue['locker'])){
                             
                             ?>
                              <div id="scrolling_to_bottom" class="col-md-12 right-header-contentchat">
                              <p class="text-muted text-center"><i class="fa fa-lock" aria-hidden="true"></i>This chat is secured with end to end protection</p>
                              <p class="text-muted text-center">To view messages you should unlock chat using eye-button</p>
                              </div>
                             
                             <?php
                             
                         }else{
                ?>
               
                <div id="scrolling_to_bottom" class="col-md-12 right-header-contentchat">
                   
                    <?php
                    $update_msg = mysqli_query($con, "UPDATE user_chating1 SET status= 1 WHERE sender='$receiver_id' AND receiver = '$user_id'");
                        
                    $sel_msg ="select * from user_chating1 where (sender='$user_id' AND receiver='$receiver_id') OR (receiver='$user_id' AND sender ='$receiver_id') ORDER by 1 ASC";
                    $run_msg = mysqli_query($con, $sel_msg);
                    
                    while ($row = mysqli_fetch_array($run_msg)){
                        
                        $sender_user_id = $row['sender'];
                        $receiver_user_id = $row['receiver'];
                        $msg_content = $row['content'];
                        $ext = strtolower(pathinfo($msg_content, PATHINFO_EXTENSION));
//                        $extension =  $ext['extension'];
                        $allowd_file_ext = array("jpg", "jpeg", "png", "mp4", "webM", "ogg", "pdf", "doc", "mp3");
                        $allowd_video_ext =  array("mp4", "webM", "ogg");
                        $date = $row['date'];
                        $msg_date = date('h:i a m/d/Y', strtotime($date));
                        $status = $row['status'];
                        
//                        $target  = $_SESSION['target_file'];
//                        $files =  $_SESSION['files'];
                    ?>
                    <ul id="private">
                        <?php
                                
                                if($user_id == $sender_user_id AND $receiver_id == $receiver_user_id){
                                    echo"
                                        <li>
                                            <div class='rightside-right-chat d-flex' id='chat_delete' style='flex-direction: row-reverse;'>
                                            
                                            ";
                                    if($status == 1){
                                        if(in_array($ext, $allowd_file_ext)){
                                            if(in_array($ext, $allowd_video_ext)){
                                            echo"
                                           <span class='read'><small>Ⓡ</small></span>
                                           
                                            <div class='float-right' style='position: relative;'><video style='width: 300px; height: 220px;' class='float-right'   controls> <source src='$msg_content' type='video/mp4'>
                                            <source src='$msg_content' type='video/ogg'><source src='$msg_content' type='video/webM'></video><div ><small style='font-size: 10px;'>$msg_date</small></div> </div>
                                            </div>
                                    
                                    ";
                                        }else{
                                                echo"
                                           <span class='read'><small>Ⓡ</small></span>
                                          
                                            <div class='float-right' style='position: relative;'><a href='$msg_content' download style='position: absolute; background: rgba(275,275,275,0.6);'><i class='fa fa-download' aria-hidden='true' style='font-size: 22px; padding: 5px'></i></a><img src='$msg_content' style='width: 200px; height: 200px;' class='float-right' id='myimg'><div ><small style='font-size: 10px;'>$msg_date</small></div> </div>
                                            </div>
                                    
                                    ";
                                        }
                                    }
                                           else{ 
                                        
                                        echo"
                                           <span class='read'><small>Ⓡ</small></span>
                                          
                                            <p>$msg_content <span class='float-right ml-4'><small style='font-size: 8px;'>$msg_date</small></span> </p>
                                            </div>
                                    
                                    ";
                                    }
                                    }
                                    else{
                                        
                                    if(in_array($ext, $allowd_file_ext)){
                                                 if(in_array($ext, $allowd_video_ext)){
                                              echo"
                                           <span class='read'><small>U</small></span>
                                           
                                            <div class='float-right' style='position: relative;'><video style='width: 300px; height: 220px;' class='float-right'   controls> <source src='$msg_content' type='video/mp4'>
                                            <source src='$msg_content' type='video/ogg'><source src='$msg_content' type='video/webM'></video><div ><small style='font-size: 10px;'>$msg_date</small></div> </div>
                                            </div>
                                    
                                    ";
                                        }else{
                                                echo"
                                           <span class='read'><small>U</small></span>
                                           
                                            <div class='float-right' style='position: relative;'><a href='$msg_content' download style='position: absolute; background: rgba(275,275,275,0.6);'><i class='fa fa-download' aria-hidden='true' style='font-size: 22px; padding: 5px'></i></a><img src='$msg_content' style='width: 200px; height: 200px;' class='float-right' id='myimg'><div ><small style='font-size: 10px;'>$msg_date</small></div> </div>
                                            </div>
                                    
                                    ";
                                        }}
                                           else{ 
                                        
                                        echo"
                                           <div class='read float-right'><small>U</small></div>
                                           
                                            <p>$msg_content <span class='float-right ml-4'><small style='font-size: 8px;'>$msg_date</small></span> </p>
                                            </div>
                                    
                                    ";
                                    }
                                    
                                    "
                                        </li>
                                        ";
                         }
                                }
                         else if($user_id == $receiver_user_id AND $receiver_id == $sender_user_id){
                             
                               echo"
                                            <li>
                                           <div class='rightside-left-chat d-flex'>";
                             
                             if(in_array($ext, $allowd_file_ext)){
                                 
                                        if(in_array($ext, $allowd_video_ext)){
                                          
                                           echo "
                                            <div class='float-left' style='position: relative;'><video style='width: 300px; height: 220px;' class='float-left'   controls> <source src='$msg_content' type='video/mp4'>
                                            <source src='$msg_content' type='video/ogg'><source src='$msg_content' type='video/webM'></video><div><small style='font-size: 10px;'>$msg_date</small></div> </div>
                                            </div>
                                    
                                    ";
                                        }
                                 else{
                                          
                                 
                                 echo"
                                
                                        
                                        <div class='float-left' style='position: relative;' ><a href='$msg_content' download style='position: absolute; background: rgba(275,275,275,0.6);'><i class='fa fa-download' aria-hidden='true' style='font-size: 22px; padding: 5px'></i></a><img src='$msg_content' style='width: 200px; height: 200px;' class='float-left' id='myimg'> <div ><small  style='font-size: 10px;'>$msg_date</small></div></div>
                                    </div>
                                
                                ";
                             }
                             }
                             else {
                             
                                echo"
                               
                                        
                                        <p>$msg_content <span class='float-right ml-4'><small  style='font-size: 8px;'>$msg_date</small></span></p>
                                    </div>
                               
                                ";
                            }
                             "
                              </li>";
                         }
                            
                        ?>

                    </ul>
                    <?php
                         }
                         
                        ?>

                </div>
                
                <?php } ?>

            </div>

           
           
            <div class="row">
                <div class="col-md-12 right-chat-textbox">
                    <form method="post" class="form-control" id="myform" enctype="multipart/form-data">
                        <label for="chooseFile" class="text-dark mb-0" style="font-weight: bold;" data-toggle="tooltip" title="Gallery"><i class="fa fa-paperclip" aria-hidden="true" style="font-size: 25px;"></i></label>
                        <input type="file" name="fileUpload" class="custom-file-input" id="chooseFile">
                        <textarea autocomplete="off" type="text" name="msg_content" placeholder="Write your message..." cols="150"  id="mytextarea" style="display: none; height: auto;" class="form-control"></textarea>
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
<div class="col-md-12 right-header d-flex flex-column mt-3" style="align-items: center; justify-content:center; height: auto;">
    <?php
                        
                        echo '
                        <div class="right-header-img ">
                            <a href="#"><img src="gos.png" style="width: 200px; height: 200px; border: grey;"></a>
                        </div>
                        
                        <div>
                        <h1 class="mt-3 mb-3" style="color: #777;">Enjoy!</h1>
                        </div>
                        <div class=""><p class="text-muted">Gossup keeps your chats private and secured,start conversation freely  </p></div>
                        <div style="border-bottom:1px solid grey; width:425px; text-align:center;"><p class="text-muted mb-4">if you get any issue while using this web-app,please visit our home apge to get help, we will try to help you a best.</p></div>
                        
                         <div class="mt-3"><h2>Thank You!</h2></div>
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
              if($run_insert){
                  
                  $insert1 = "insert into user_chating2(sender, receiver, content, status, date) values('$user_id', '$receiver_id', '$msg', 0 , NOW())";
                  $run_insert1 = mysqli_query($con, $insert1);
                  
                  header("refresh: 0.01");
              }
              
               
    }
        
           
       }
   
     
    ?>




<div id="mymodal" class="modal" style=" display: none;
    position: fixed;z-index: 1;padding-top: 30px; left: 0px;top: 0px; width: 100%;height: 100%;overflow: auto;background-color: rgb(0, 0, 0);background-color: rgba(0, 0, 0, 0.7);">
    <span class="close">&times;</span>
    <img class="modal-content" id="img01" style="  margin: auto; display: block;max-width: 600px;max-height: 600px;">
</div>



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
<!--	<script src="assets/js/jquery.js "></script>-->
	<script src="assets/dist/emojionearea.min.js"></script>
	
	<script>
        $(document).ready(function(){
            $("#mytextarea").emojioneArea({
                pickerPosition: "top"
            });
        })
</script>

<script>
function openNav() {
  document.getElementById("my_Sidenav").style.width = "100%";
}

function closeNav() {
  document.getElementById("my_Sidenav").style.width = "0";
}
</script>

<script>
$(document).ready(function(){
  $("#myBtn").click(function(){
    $("#myModal").modal();
  });
});
</script>

<script>
var myVar;

function myFunction() {
  myVar = setTimeout(showPage, 200);
}

function showPage() {
  document.getElementById("load").style.display = "none";
  document.getElementById("fetchingdata").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
}
</script>

<!--lock eye modal-->
<!--lock eye modal-->
<!--lock eye modal-->
<!--lock eye modal-->

<script>
// Get the modal
var modal = document.getElementById("eyemodal");

// Get the button that opens the modal
var btn = document.getElementById("eyeclose");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("closecrosseye")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

</body>