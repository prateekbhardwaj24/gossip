<?php 
require 'includes/init.php';
 include 'notifications.php';
include 'connection.php'; 
//include 'friends.php';
 include 'profile.php';

include 'connect/login.php';
include 'core/load.php';
if(login::isLoggedIn()){
    $userid = login::isLoggedIn();
}else{
header('location: index.php');
}

if(isset($_GET['username']) == true && empty($_GET['username']) === false){
    $username = $loadFromUser->checkInput($_GET['username']);
    $profileId = $loadFromUser->userIdByUsername($username);
}
 else{
 $profileId = $userid;
 }
 $profileData = $loadFromUser->userData($profileId);
 $userData = $loadFromUser->userData($userid);
 $requestCheck =$loadFromPost->requestCheck($userid, $profileId);
 $requestConf = $loadFromPost->requestConf($profileId, $userid);
 $followCheck= $loadFromPost->followCheck($profileId, $userid);

?>


<!DOCTYPE html>
<html lang="en">

<head>
<!--	<meta charset="UTF-8">-->
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<title>Header</title>
	<link rel="stylesheet" href="header.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" href="assets/dist/emojionearea.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!--     <link rel="stylesheet" href="swiper.min.css">-->
	<link rel="stylesheet" href="chat.css">
	<link rel="stylesheet" href="friendpage.css">
	<!--    <link rel="stylesheet" href="profile.css">-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.4/holder.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>


</head>

<body>

	<?php
    
    
        $con = mysqli_connect("localhost", "root", "", "mychat");

//          $user = $_SESSION['user_email'];
          $user = $userid;
          $get_user = "select * from my_users1 where user_id='$user'";
          $run_user = mysqli_query($con, $get_user);
          $row2 = mysqli_fetch_array($run_user);
       
          $user_name = $row2['user_name'];
//          $user_profile = $row2['user_profile'];
          $user_country = $row2['user_country'];
          $user_gender = $row2['user_gender'];
          $user_email = $row2['user_email'];
          $user_id = $row2['user_id'];
    
    
    //    profile fetch-------------------------------------------------------
    $userid1 = $_SESSION['user_id'];
    $getprofile = "select * from profile where userId='$userid1'";
           $profilequery = mysqli_query($con, $getprofile);
          $profile = mysqli_fetch_array($profilequery);
    $profilePic = $profile['profilePic'];
    
  
    ?>

 <nav class="navbar justify-content-between">

		<a href="myprofile.php" class="d-flex float-left header_image" style="align-items: center; text-decoration: none; color: #555;"data-toggle="tooltip" title="Your Profile"><img src="<?php echo $profilePic ?>"><span>
				<h6>Hi <?php echo "$user_name"; ?>!</h6>
			</span></a>
			
			
			<li class="nav-item  mt-2 " style="list-style: none;">
            <a href="#" ><img src="gossup1.png" alt="" style="width: auto; height: 40px;"></a>
			    
			</li>
			
			<!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler mr-0" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"><img src="menu.png" style="width: 30px; height: 30px;"></span>
        </button>
        
<!--navbar item-->
    <div class="collapse navbar-collapse" id="collapsibleNavbar" style="z-index:202; text-align: end;">
		<ul class="navbar-nav" style=" float:right;">
			<li class="nav-item  mt-2">
				<a href="friendpage.php" class="nav-link  d-flex" style="align-items: center justify-content: center;" data-toggle="tooltip" title="Buddies"><i class="fa fa-user" aria-hidden="true"></i></a>
				<?php
//				$get_req_num = $frnd_obj->request_notification($userid, false);
	// $get_frnd_num = $frnd_obj->get_all_friends($userid, false);
            if($get_req_num > 0){
                
            
            ?>
				<span class="noti_badge"><?php echo $get_req_num;?></span>
				<?php } ?>
			</li>
			
			
			
			



			<?php
            $user_id = $userid;
            $res_message = mysqli_query($con, "select my_users1.user_name,user_chating1.content from user_chating1, my_users1 where user_chating1.status= 0 and user_chating1.receiver='$user_id' and my_users1.user_id=user_chating1.sender");
            $unread_count = mysqli_num_rows($res_message);
          
            ?>

			<li class="nav-item  mt-2 ">
				<a href="demo.php" class="nav-link d-flex" style="align-items: center justify-content: center;" data-toggle="tooltip" title="Messages"><i class="fa fa-bolt" aria-hidden="true"></i></a>

				<?php
                 if($unread_count > 0){
                ?>
				<span class="noti_badge"><?php echo $unread_count; ?></span>
				<?php } ?>
			</li>


			<li class="nav-item  mt-2 ">
				<a href="profile5.php?username=<?php echo $userData->userLink; ?>" class="nav-link  d-flex" style="align-items: center justify-content: center;" data-toggle="tooltip" title="Posts"><i class="fa fa-pagelines" aria-hidden="true"></i></a>
			</li>

			<li class="nav-item  mt-2">
				<?php
				        $con = mysqli_connect("localhost", "root", "", "mychat");
                $userId = $userid;
                
                $notifycount =mysqli_query($con, "select user_name, react.reactType, react.reactTimeOn, react.sender, react.reciever from react,my_users1 where react.status=0 and react.reciever='$userId' and my_users1.user_id=react.sender");
                
//                $query_post = mysqli_query($con, $post_noti);
                
                $unread_counter = mysqli_num_rows($notifycount);
                
                
            ?>
				<a href="#" class="nav-link  d-flex" id="notifications_button" style="align-items: center justify-content: center;" data-toggle="tooltip" title="Notification"><i class="fa fa-bell-o" aria-hidden="true"></i></a>
				<?php 
                if($unread_counter > 0){
             
                ?>
				<span class="noti_badge"><?php echo $unread_counter; ?></span>
				<?php } ?>

				<div id="notifications" style="background-color: #f2f7fb;">
					<h3 align="center" style="background: #f2f7fb; color:  #1e71f5;">Alert</h3>
					<div style="height:400px; overflow-y: scroll; background: #f2f7fb;" id="show_notification">
						
				
<!--							<a href="profile5.php">-->
                                
                               <?php 
                               
                                
                                
                                $con = mysqli_connect("localhost", "root", "", "mychat");
                                $userId1 = $userid;
                
                                $notifycount1 =mysqli_query($con, "select user_name, user_id, react.reactType, react.reactTimeOn, react.reactOn from react,my_users1 where react.reciever='$userId1' and my_users1.user_id=react.sender");
                                $comments =mysqli_query($con, "select user_name, user_id, comments.comment, comments.commentAt, comments.commentOn from comments,my_users1 where comments.reciever='$userId1' and my_users1.user_id=comments.sender");
                
                             
                                ?>
                                
                                <?php
						         
							         while(!empty($row=mysqli_fetch_assoc($notifycount1)) && !empty($rowComment=mysqli_fetch_assoc($comments))){
                                          $date = $row['reactTimeOn'];
                                          $react_date = date('h:i a', strtotime($date));
                                          $postid = $row['reactOn'];
										  $receiver_user_id = $row['user_id'];
										  
										//   comments details

                                          $dateComment = $rowComment['commentAt'];
                                          $Comment_date = date('h:i a', strtotime($dateComment));
                                          $postidComment = $rowComment['commentOn'];
                                          $receiver_user_id_Comment = $rowComment['user_id'];
                                         
                                        //  profile pic
                                         $select_pro = mysqli_query($con, "select * from profile where userId=$receiver_user_id");
                                         $get_pro = mysqli_fetch_array($select_pro);
										 $pro_pic = $get_pro['profilePic'];
										 
                                         $select_pro_comm = mysqli_query($con, "select * from profile where userId=$receiver_user_id_Comment");
                                         $get_pro_comm = mysqli_fetch_array($select_pro_comm);
                                         $pro_pic_comm = $get_pro_comm['profilePic'];
                                         
                                         
								?>
                               
                                 <?php echo '
                            <a href="profile5.php#'.$postid.'" onclick="myFunction()" style="text-decoration: none;">';
                         ?>
						            <div  align="center" class="onclick noti_data d-flex" style="justify-content: center; align-items: center; font-family: serif;">
                                    <img src="<?php echo $pro_pic ?>" alt="" style="width: 40px; height: 40px; border-radius: 50%;" class="float-left ml-2">
                                
                          	        <p class="ml-3" style="font-family: serif;"><strong ><?php  echo $row['user_name'] ?></strong> has <?php echo $row['reactType'] ?> reacted on your post. </p>
                          	        <span><small style="color:  #1e71f5; font-size: 10px;"><?php echo $react_date ?></small></span>

						</div>
						<?php echo '
						</a>';
						?>
						<!-- comment notification -->
                             
						<?php echo '
                            <a href="profile5.php#'.$postid.'" onclick="myFunction()" style="text-decoration: none;">';
                         ?>
						            <div  align="center" class="onclick noti_data d-flex" style="justify-content: center; align-items: center; font-family: serif;">
                                    <img src="<?php echo $pro_pic_comm ?>" alt="" style="width: 40px; height: 40px; border-radius: 50%;" class="float-left ml-2">
                                
                          	        <p class="ml-3" style="font-family: serif;"><strong ><?php  echo $rowComment['user_name'] ?></strong> has commented on your post. </p>
                          	        <span><small style="color:  #1e71f5; font-size: 10px;"><?php echo $Comment_date ?></small></span>

						</div>
						<?php echo '
						</a>';
						?>

						<?php
							}
						
						?>
					</div>
				</div>

			</li>
			<li class="nav-item  mt-2">
				<a href="logout.php" class=" nav-link d-flex" style="align-items: center justify-content: center;" data-toggle="tooltip" title="Logout"><i class="fa fa-sign-out" aria-hidden="true"></i></a>

			</li>

		</ul>
     </div>

	</nav>




	<script>
		$(document).ready(function() {
			$('#notifications_button').click(function() {
				jQuery.ajax({
					url: 'update_notify.php',
					success: function() {
						$('#notifications').fadeToggle('fast', 'linear');
						$('#notifications_counter').fadeOut('slow');

					}
				})
				return false;
			});
			$(document).click(function() {
				$('#notifications').hide();
			});
		});

	</script>
<!--// smooth-scroll-->
<script>
$('a[href*=#]:not([href=#])').click(function() {
    $.smoothScroll({
        beforeScroll: function () {location.replace("/profile5.php");},
        offset: -120,
        scrollTarget: this.hash
    });
    return false;
});
</script>