<?php 
 include 'notifications.php';
include 'connection.php'; 
//include 'friends.php';
 include 'profile.php';

include 'connect/login.php';
include 'core/load.php';

if(login::isLoggedIn()){
    $userid = login::isLoggedIn();
	$_SESSION['userid']=$userid;
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
    
    
//        $con = mysqli_connect("localhost", "root", "", "mychat");

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
    
    
    
    
    ?>


	<nav class="navbar navbar-expand-sm justify-content-between">

		<a href="myprofile.php" class="d-flex float-left" style="align-items: center; text-decoration: none; color: #555;"><img src="prj1.jpg"><span>
				<h5 class="ml-1">Welcome <?php echo "$user_name"; ?>!</h5>
			</span></a>

		<ul class="navbar-nav">

			<li class="nav-item">
				<a href="friendpage.php" class="nav-link mr-3 d-flex" style="align-items: center justify-content: center;"><i class="fa fa-user" aria-hidden="true"></i></a>
				<?php
            if($get_req_num > 0){
                
            
            ?>
				<span class="noti_badge"><?php echo $get_req_num;?></span>
				<?php } ?>
			</li>


			<?php
            $user_id = $_SESSION['user_id'];
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
				<a href="#" class="nav-link mr-3 d-flex" style="align-items: center justify-content: center;"><i class="fa fa-bell-o" aria-hidden="true"></i></a>
				<span class="noti_badge">0</span>
			</li>
			<li class="nav-item">
				<a href="logout.php" class="mr-2 nav-link d-flex" style="align-items: center justify-content: center;"><i class="fa fa-sign-out" aria-hidden="true"></i></a>

			</li>

		</ul>

	</nav>
