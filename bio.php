<?php

//include 'connect/login.php';
include 'core/load.php';

if(login::isLoggedIn()){
 $userid = login::isLoggedIn();
}else{
header('location: index.php');
}

if(isset($_GET['postid']) == true && empty($_GET['postid']) === false){
    $postid = $_GET['postid'];
    $profileid = $_GET['profileid'];
    $user_id = $userid;
    $username = $loadFromUser->checkInput($_GET['username']);
    $profileId = $loadFromUser->userIdByUsername($username);
}else{
    $profileId = $userid;
}
    $profileData = $loadFromUser->userData($profileId);
    $userData = $loadFromUser->userData($userid);
// $requestCheck =$loadFromPost->requestCheck($userid, $profileId);
// $requestConf = $loadFromPost->requestConf($profileId, $userid);
// $followCheck= $loadFromPost->followCheck($profileId, $userid);
//
//    $notification = $loadFromPost->notification($userid);
//    $notificationCount = $loadFromPost->notificationCount($userid);
//    $requestNotificationCount = $loadFromPost->requestNotificationCount($userid);

            $post = $loadFromPost->postDetails($postid);

//            $main_react = $loadFromPost->main_react($user_id, $post->post_id);
         // $react_max_show = $loadFromPost->react_max_show($post->post_id);
         // $main_react_count = $loadFromPost-> main_react_count($post->post_id);
         //
         // $commentDetails = $loadFromPost->commentFetch($post->post_id);
         // $totalCommentCount = $loadFromPost->totalCommentCount($post->post_id);
         // $totalShareCount = $loadFromPost->totalShareCount($post->post_id);
         // if(empty($post->shareId)){}else{
         // $shareDetails = $loadFromPost->shareFetch($post->shareId, $post->postBy);
         // }

?>







<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/js/all.min.js">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<style>
		body {
			background: #f2f7fb;
			margin: 0px;
			padding: 0px;
		}

		.profile-card {
			background-color: #f2f7fb;
			height: auto;
			box-shadow: 6px 6px 10px -1px rgba(0, 0, 0, 0.15),
				-6px -6px 10px -1px rgba(255, 255, 255, 0.7);
			border: 1px solid rgba(0, 0, 0, 0);
			transition: transform 0.5s;
			border-radius: 8px;
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
			font-family: serif;
			color: #777;


		}

		.image {
			width: 130px;
			height: 130px;
			border-radius: 50%;

			/*            box-shadow: -7px -7px 20px 0px rgba(255,255,255,0.9),*/
			/*                 7px 7px 20px 0px rgba(0,0,0,0.3);*/
			/*             transform: 0.2s;*/
			position: relative;
			margin-top: -35px;
		}

		.image::before {
			content: "";
			position: absolute;
			height: 50%;
			width: 50%;
			background: #f2f7fb;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			border-radius: 50%;
			box-shadow: inset -7px -7px 20px 0px rgba(255, 255, 255, 1),
				inset 7px 7px 20px 0px rgba(0, 0, 0, 0.3);

		}

		.image::before {
			content: "";
			position: absolute;
			height: 80%;
			width: 80%;
			background: #f2f7fb;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			border-radius: 50%;
			box-shadow: inset -7px -7px 20px 0px rgba(255, 255, 255, 1),
				inset 7px 7px 20px 0px rgba(0, 0, 0, 0.3);
		}

		.image img {
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
		}

		.about {
			text-decoration: none;
			color: #777;
			box-shadow: 6px 6px 10px -1px rgba(0, 0, 0, 0.15),
				-6px -6px 10px -1px rgba(255, 255, 255, 0.7);
			border: 1px solid rgba(0, 0, 0, 0);
			transition: transform 0.5s;
			border-radius: 2.5rem
		}

		.about:hover {
			box-shadow: inset 4px 4px 6px -1px rgba(0, 0, 0, 0.2),
				inset -6px -6px 10px -1px rgba(255, 255, 255, 0.7), -0.5px -0.5px 0px rgba(255, 255, 255, 0.7), 0.5px 0.5px 0px rgba(0, 0, 0, 0.15), 0px 12px 10px -10px rgba(0, 0, 0, 0.05);
			border: 1px solid rgba(0, 0, 0, 0.01);
			transform: translateY(2px);
		}

		.about i {
			font-size: 15px;
		}

		.fa-heart {
			color: red;
		}

		.fa-thumbs-up {
			color: green;
		}

		.fa-star {
			color: blue;
		}

		.history {
			display: flex;
		}

	</style>

</head>

<body>


	<div class=" profile-card mt-5">
		<div class="image">
			<img src="prj1.jpg" alt="parasjha" style="width: 80px; height: 80px; border-radius: 50%;">
		</div>
		<div class="bio mt-3 mb-2">
			<h3><?php echo ''.$post->user_name.''; ?></h3>
			<p>Developer</p>
		</div>
		<div class="history mb-3 p-2">
			<div>
				<a href="#" class="about p-2 mr-2"><i class="fa fa-heart"></i></a>

				<p class="mt-2">Buddies</p>

			</div>
			<div class="ml-sm-3">
				<a href="#" class="about p-2 mr-2"><i class="fa fa-thumbs-up"></i></a>
				<p class="mt-2">Likes</p>
			</div>
			<div class="ml-sm-3">
				<a href="#" class="about p-2 ml-sm-2"><i class="fa fa-star"></i></a>
				<p class="mt-2">Highest Likes</p>
			</div>

		</div>

	</div>





</body>

</html>
