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
	<meta charset="UTF-8">
	<title>Header</title>
	<link rel="stylesheet" href="header.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
    
    
    
    
    ?>


	<nav class="navbar navbar-expand-sm justify-content-between">

		<a href="myprofile.php" class="d-flex float-left" style="align-items: center; text-decoration: none; color: #555;"><img src="prj1.jpg"><span>
				<h5 class="ml-1">Welcome <?php echo "$user_name"; ?>!</h5>
			</span></a>

		<ul class="navbar-nav">
			<li class="nav-item">
				<a href="friendpage.php" class="nav-link mr-3 d-flex" style="align-items: center justify-content: center;"><i class="fa fa-user" aria-hidden="true"></i></a>
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

			<li class="nav-item ">
				<a href="demo.php" class="nav-link mr-3 d-flex" style="align-items: center justify-content: center;"><i class="fa fa-bolt" aria-hidden="true"></i></a>

				<?php
                 if($unread_count > 0){
                ?>
				<span class="noti_badge"><?php echo $unread_count; ?></span>
				<?php } ?>
			</li>


			<li class="nav-item ">
				<a href="profile5.php?username=<?php echo $userData->userLink; ?>" class="nav-link mr-3 d-flex" style="align-items: center justify-content: center;"><i class="fa fa-pagelines" aria-hidden="true"></i></a>
			</li>

			<li class="nav-item">
				<?php
				        $con = mysqli_connect("localhost", "root", "", "mychat");
            $user_id = $userid;
//            $notifycount = mysqli_query($con,"SELECT my_users1.user_name,react.reactType FROM react,my_users1,post WHERE react.status= 0 and react.reactBy='$user_id' and my_users1.user_id =$user_id and  post.userId = $user_id and react.reactBy = $user_id");
//            $notifycount = mysqli_query($con, "select * from react,post,friends where react.status=0 and react.reactOn = post.post_id and (post.userId != friends.user_one or post.userId != friends.user_two)"); 
                $notifycount= mysqli_query($con, "select react.reactType,my_users1.user_name from post,react,my_users1 where react.status = 0 and react.reactBy = $user_id and post.userId = my_users1.user_id");
            $unread_counter = mysqli_num_rows($notifycount);
          
            ?>
				<a href="#" class="nav-link mr-3 d-flex" id="notifications_button" style="align-items: center justify-content: center;"><i class="fa fa-bell-o" aria-hidden="true"></i></a>
				<span class="noti_badge"><?php echo $unread_counter; ?></span>

				<div id="notifications">
					<h3 align="center">Alert</h3>
					<div style="height:300px;" id="show_notification">
						<?php
						if($unread_counter>0){
							while($row=mysqli_fetch_assoc($notifycount)){
								?>
						<div style="background:#f2f7fb;" align="center" class="onclick">
							<a href="profile5.php">
								<p class="ml-3" style="color: #1e71f5;"> <strong style="color:red;"><?php  echo $row['user_name'] ?></strong> has <?php echo $row['reactType'] ?> reacted on your post.</p>
							</a>
						</div>
						<?php
							}
						}
						?>
					</div>
				</div>

			</li>
			<li class="nav-item">
				<a href="logout.php" class="mr-2 nav-link d-flex" style="align-items: center justify-content: center;"><i class="fa fa-sign-out" aria-hidden="true"></i></a>

			</li>

		</ul>

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
