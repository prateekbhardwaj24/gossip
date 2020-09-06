<?php
//include  'include/header.php';
include 'connect/login.php';
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
}
else{
    $profileId = $userid;
}
    $profileData = $loadFromUser->userData($profileId);
    $userData = $loadFromUser->userData($userid);

            $post = $loadFromPost->postDetails($postid);

            $main_react = $loadFromPost->main_react($user_id, $post->post_id);
            $react_max_show = $loadFromPost->react_max_show($post->post_id);
            $main_react_count = $loadFromPost-> main_react_count($post->post_id);

            $commentDetails = $loadFromPost->commentFetch($post->post_id);
            $totalCommentCount = $loadFromPost->totalCommentCount($post->post_id);
            $totalShareCount = $loadFromPost->totalShareCount($post->post_id);
            if(empty($post->shareId)){}else{
                $shareDetails = $loadFromPost->shareFetch($post->shareId, $post->postBy);
            }


?>


<html lang="en">

<head>
	<meta charset="UTF-8">
	<title><?php echo ''.$profileData->user_name.''; ?></title>
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/dist/emojionearea.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/js/all.min.js">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>


	</style>
</head>

<!--<body>-->
<div class="userid-profileid-placeholder" data-userid="<?php echo $user_id; ?>" data-profileid="<?php echo $profileid; ?>"> </div>
<main>
	<div class="container-fluid">
		<div class="main-area">
			<div class="profile-left-wrap">


				<div class="bio-timeline">

					<div class="status-timeline-wrap">
						<?php if($profileId == $userid){ ?>
						<div class="row">
							<div class="col-sm-4 sexy-boy">
								<div class=" profile-card">
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


							</div>
							<div class="col-sm-8">
								<div class="profile-status-write">
									<div class="status-wrap">
										<div class="status-top-wrap">
											<div class="status-top">
												Create Thoughts
											</div>
										</div>

										<div class="status-med">
											<div class="status-prof-textarea">
												<textarea name="textStatus" id="statusEmoji" cols="5" rows="5" class="status align-middle" placeholder="Share your thoughts!"></textarea>
											</div>
										</div>
										<div class="status-bot">
											<div class="file-upload-remIm input-restore">

												<label for="multiple_files" class="file-upload-label">
													<div class="status-bot-1">
														<img src="assets/image/photo.JPG" alt="">
														<div class="status-bot-text">Photo</div>
													</div>
												</label>
												<input type="file" name="post-file-upload" id="multiple_files" class="file-upload-input postImage" data-multiple-caption="{count} files selected" multiple="">

											</div>


										</div>

										<div id="error_multiple_files"></div>
										<div class="status-share-button-wrap">

											<div class="seemore-sharebutton">

												<div class="status-share-button align-middle">
													POST
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--							<div class="col-sm-2"></div>-->
						</div>
						<?php } ?>
						<div class="container-fluid">
							<div class="row">
								<div class="col-sm-4 sexy-boy">
									<div class=" profile-card">
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


								</div>
								<div class="col-sm-8">
									<div class="ptaf-wrap">

										<div class="profile-timeline container">
											<div class="news-feed-comp">
												<div class="news-feed-text">
													<div class="nf-1">
														<div class="nf-1-left">
															<div class="nf-pro-pic">
																<a href="<?php echo BASE_URL.$post->userLink; ?>"></a>
																<img src="<?php echo BASE_URL.$post->profilePic; ?>" class="pro-pic" alt="">
															</div>
															<div class="nf-pro-name-time">
																<div class="nf-pro-name">
																	<a href="<?php echo BASE_URL.$post->userLink; ?>" class="nf-pro-name">
																		<?php echo ''.$post->user_name.''; ?>
																	</a>
																</div>
																<div class="nf-pro-time-privacy">
																	<div class="nf-pro-time">
																		<?php echo $loadFromPost->timeAgo($post->postedOn); ?>
																	</div>
																	<div class="nf-pro-privacy"></div>
																</div>
															</div>
														</div>
														<div class="nf-1-right">
															<div class="nf-1-right-dott">
																<?php
            if(empty($post->shareId)){
                if($user_id == $profileId){
                    ?>
																<div class="post-option" data-postid="<?php echo $post->post_id; ?>" data-userid="<?php echo $user_id ?>">...</div>
																<div class="post-option-details-container"></div>
																<?php
                }else{}
            }else{
                if($user_id == $profileId){

                    ?>
																<div class="shared-post-option" data-postid="<?php echo $post->post_id; ?>" data-userid="<?php echo $user_id ?>">...</div>
																<div class="shared-post-option-details-container"></div>

																<?php

                                          }else{}
            }

            ?>
															</div>
														</div>
													</div>
													<div class="nf-2">
														<div class="nf-2-text" data-postid="<?php echo $post->post_id; ?>" data-userid="<?php echo $user_id ?>" data-profilePic="<?php echo $post->profilePic; ?>">
															<?php if(empty($post->shareId)){echo $post->post; }else{
                if(empty($shareDetails)){echo 'Share has not found.';}else{echo '<span class="nf-2-text-span" data-postid = "'.$post->post_id.'" data-userid="'.$user_id.'" data-profilepic="'.$post->profilePic.'">'.$post->shareText.'</span>'; }

                foreach($shareDetails as $share){ ?>

															<div class="share-container" style="padding:5px; box-shadow: 0 0 3px gray; margin-top:10px; display:flex; flex-direction:column; align-items:flex-start; cursor:pointer" data-userlink="<?php echo $share->userLink; ?>">

																<div class="nf-1">
																	<div class="nf-1-left">
																		<div class="nf-pro-pic">
																			<a href="<?php echo BASE_URL.$share->userLink; ?>"></a>
																			<img src="<?php echo BASE_URL.$share->profilePic; ?>" class="pro-pic" alt="">
																		</div>
																		<div class="nf-pro-name-time">
																			<div class="nf-pro-name">
																				<a href="<?php echo BASE_URL.$share->userLink; ?>" class="nf-pro-name">
																					<?php echo ''.$share->user_name.''; ?>
																				</a>
																			</div>
																			<div class="nf-pro-time-privacy">
																				<div class="nf-pro-time">
																					<?php echo $loadFromPost->timeAgo($share->postedOn); ?>
																				</div>
																				<div class="nf-pro-privacy">
																					<img src="../../mychat/assets/image/privacy.JPG" alt="">
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="nf-1-right">
																	</div>
																</div>
																<div class="nf-2">
																	<div class="nf-2-text" data-postid="<?php echo $share->post_id; ?>" data-userid="<?php echo $user_id ?>" data-profilePic="<?php echo $share->profilePic; ?>">
																		<?php echo $share->post;  ?>
																	</div>
																	<div class="nf-2-img" data-postid="<?php echo $share->post_id; ?>" data-userid="<?php echo $user_id ?>">
																		<?php $shareImgJson = json_decode($share->postImage);
                            $shareCount = 0;
                                for($i = 0; $i < count($shareImgJson); $i++) {
                                    echo '  <div class="post-img-box" data-postImgID="'.$share->id.'" style="max-height: 400px;
    overflow: hidden;"><img src="'.BASE_URL.$shareImgJson[''.$shareCount++.'']->imageName.'" class="postImage" alt="" style="width: 100%;cursor:pointer;"></div>';
                                }
                ?>
																	</div>
																</div>

															</div>

															<?php

                }

            } ?>
														</div>
														<div class="nf-2-img" data-postid="<?php echo $post->post_id; ?>" data-userid="<?php echo $user_id ?>">
															<?php $imgJson = json_decode($post->postImage);
                            $count = 0;
                                for($i = 0; $i < array(count($imgJson)); $i++) {
                                    echo '  <div class="post-img-box" data-postImgID="'.$post->id.'" style="max-height: 400px; 
    overflow: hidden; display:flex; justify-content:center;"><img src="'.BASE_URL.$imgJson[''.$count++.'']->imageName.'" class="postImage" alt="" style="width:auto; max-height:400px; cursor:pointer;"></div>';
                                }
                ?>
														</div>
													</div>

													<div class="nf-3">

														<div class="react-comment-count-wrap" style="width:100%; display:flex; justify-content:space-between; align-items:center;">
															<div class="react-count-wrap align-middle">
																<div class="nf-3-react-icon">
																	<div class="react-inst-img align-middle">
																		<?php
            foreach($react_max_show as $react_max){
echo '<img class = "'.$react_max->reactType.'-max-show" src="assets/image/react/'.$react_max->reactType.'.JPEG" alt="" style="height:15px; width:15px; margin-right:2px; cursor:pointer;">';
            }

            ?>
																	</div>
																</div>
																<div class="nf-3-react-username">
																	<?php
            if($main_react_count->maxreact == '0'){}else{
                echo $main_react_count->maxreact;
            }            ?>
																</div>
															</div>
															<div class="comment-share-count-wrap align-middle" style="font-size:13px; color:gray;">
																<div class="comment-count-wrap" style="margin-right:10px;">
																	<?php if(empty($totalCommentCount->totalComment)){}else{
                echo ''.$totalCommentCount->totalComment.' comments';
            } ?>
																</div>
																<div class="share-count-wrap">
																	<?php if(empty($totalShareCount->totalShare)){}else{ echo ''.$totalShareCount->totalShare.' Share'; } ?>
																</div>

															</div>
														</div>


													</div>
													<div class="nf-4">
														<div class="like-action-wrap" data-postid="<?php echo $post->post_id; ?>" data-userid="<?php echo $user_id; ?>" style="position:relative;">
															<div class="react-bundle-wrap">

															</div>

															<div class="like-action ra">
																<?php  if(empty($main_react)){ ?>
																<div class="like-action-icon">
																	<img src="assets/image/likeAction.JPG" alt="">
																</div>
																<div class="like-action-text"><span>Like</span></div>

																<?php }else{
            ?>

																<div class="like-action-icon" style="display: flex;align-items: center;">
																	<img src="assets/image/react/<?php echo $main_react->reactType; ?>.JPEG" alt="" class="reactIconSize" style="margin-top:0;">
																	<div class="like-action-text"><span class="<?php echo $main_react->reactType;  ?>-color"><?php echo $main_react->reactType; ?></span></div>
																</div>







																<?php
        } ?>
															</div>

														</div>
														<div class="comment-action ra">
															<div class="comment-action-icon">
																<img src="assets/image/commentAction.JPG" alt="">
															</div>
															<div class="comment-action-text">
																<div class="comment-count-text-wrap">
																	<div class="comment-wrap"></div>
																	<div class="comment-text">Comment</div>
																</div>
															</div>
														</div>
														<div class="share-action ra" data-postid="<?php echo $post->post_id; ?>" data-userid="<?php echo $user_id ?>" data-profileid="<?php echo $profileId; ?>" data-profilePic="<?php echo $post->profilePic; ?>">
															<div class="share-action-icon">
																<img src="assets/image/shareAction.JPG" alt="">
															</div>
															<div class="share-action-text">Share</div>
														</div>

													</div>

													<div class="nf-5">
														<div class="comment-list">
															<ul class="add-comment">
																<?php
if(!empty($commentDetails)){
             foreach($commentDetails as $comment){
                 $com_react_max_show = $loadFromPost->com_react_max_show($comment->commentOn, $comment->commentID);
                 $com_main_react_count = $loadFromPost->com_main_react_count($comment->commentOn, $comment->commentID);
                 $commentReactCheck = $loadFromPost->commentReactCheck($user_id, $comment->commentOn, $comment->commentID);



            ?>
																<li class="new-comment">
																	<div class="com-details">
																		<div class="com-pro-pic">
																			<a href="#">
																				<span class="top-pic"><img src="<?php echo $comment->profilePic; ?>" alt=""></span>
																			</a>
																		</div>
																		<div class="com-pro-wrap">
																			<div class="com-text-react-wrap">
																				<div class="com-text-option-wrap align-middle">
																					<div class="com-pro-text align-middle">
																						<div class="com-react-placeholder-wrap align-middle">
																							<div>
																								<span class="nf-pro-name">
																									<a href="" class="nf-pro-name"><?php echo ''.$comment->user_name.'' ?> </a>
																								</span>
																								<span class="com-text" style="margin-left:5px; " data-postid="<?php echo $comment->commentOn; ?> " data-userid="<?php echo $user_id; ?>" data-commentid="<?php echo $comment->commentID;  ?>" data-profilepic="<?php echo $userdata->profilePic; ?>"><?php echo $comment->comment; ?></span>
																							</div>
																							<div class="com-nf-3-wrap">
																								<?php
                                                            if($com_main_react_count->maxreact == '0'){}else{
                                                                ?>
																								<div class="com-nf-3 com- align-middle">
																									<div class="nf-3-react-icon">
																										<div class="react-inst-img align-middle">
																											<?php
                                                                foreach($com_react_max_show as $react_max){
                                                                    echo '<img class="'.$react_max->reactType.'-max-show" src="assets/image/react/'.$react_max->reactType.'.JPEG" alt="" style="height:12px; width:12px;margin-right:2px;cursor:pointer;">';
                                                                }
                                                                ?>
																										</div>
																									</div>
																									<div class="nf-3-react-username">
																										<?php
                                                                if($com_main_react_count->maxreact == '0'){}else{echo $com_main_react_count->maxreact;}
                                                                ?>
																									</div>
																								</div>
																								<?php
                                                            }


                                                            ?>
																							</div>
																						</div>
																					</div>
																					<?php
                                                    if($user_id == $comment->commentBy){
                                                        ?>
																					<div class="com-dot-option-wrap">
																						<div class="com-dot" style="color:gray; margin-left:5px; cursor:pointer;font-weight:600;" data-postid="<?php echo $comment->commentOn; ?>" data-userid="<?php echo $user_id; ?>" data-commentid="<?php echo $comment->commentID; ?>">...</div>
																						<div class="com-option-details-container">

																						</div>
																					</div>

																					<?php
                                                    }else{}
                                                    ?>
																				</div>
																				<div class="com-react">
																					<div class="com-like-react" data-postid="<?php echo $comment->commentOn; ?>" data-userid="<?php echo $user_id; ?>" data-commentid="<?php echo $comment->commentID; ?>">
																						<div class="com-react-bundle-wrap" data-commentid="<?php echo $comment->commentID; ?>"></div>
																						<?php
                                                    if(empty($commentReactCheck)){
                                                        echo '<div class="com-like-action-text"><span>Like</span></div>';
                                                    }else{
                                                        echo '<div class="com-like-action-text"><span class="'.$commentReactCheck->reactType.'-color">'.$commentReactCheck->reactType.'</span></div>';
                                                    }
                                                    ?>
																					</div>
																					<div class="com-reply-action" data-postid="<?php echo $comment->commentOn; ?>" data-userid="<?php echo $user_id; ?>" data-commentid="<?php echo $comment->commentID; ?>" data-profilepic="<?php echo $userdata->profilePic;?>">
																						Reply
																					</div>
																					<div class="com-time">
																						<?php echo $loadFromPost->timeAgo($comment->commentAt); ?>
																					</div>
																				</div>
																			</div>
																			<div class="reply-wrap">
																				<div class="reply-text-wrap">
																					<ul class="old-reply">
																						<?php
                 $replyDetails = $loadFromPost->replyFetch($comment->commentOn, $comment->commentID);

                 foreach($replyDetails as $reply){
                     $reply_react_count = $loadFromPost->reply_main_react_count($reply->commentOn, $reply->commentID, $reply->commentReplyID);
                     $reply_react_max_show = $loadFromPost->reply_react_max_show($reply->commentOn, $reply->commentID, $reply->commentReplyID);
                     $replyReactCheck = $loadFromPost->replyReactCheck($user_id, $reply->commentOn, $reply->commentID, $reply->commentReplyID);
                     ?>

																						<li class="new-reply" style="margin-top:10px">
																							<div class="com-details">
																								<div class="com-pro-pic">
																									<a href="">
																										<div class="top-pic"><img src="<?php echo $reply->profilePic ?>" alt=""></div>
																									</a>
																								</div>
																								<div class="com-pro-wrap">
																									<div class="com-text-react-wrap">
																										<div class="reply-text-option-wrap align-middle" style="justify-content: flex-start;">
																											<div class="com-pro-text align-middle">
																												<a href="">
																													<span class="nf-pro-name"><?php echo ''.$reply->user_name.'' ?></span>
																												</a>

																												<div class="com-react-placeholder-wrap align-middle">
																													<div class="com-text" data-commentid="<?php echo $comment->commentID; ?>" data-postid="<?php echo $comment->commentOn;?>" data-profilepic="<?php echo $userdata->profilePic; ?>" data-replyid="<?php echo $reply->commentID; ?>" data-userid="<?php echo $user_id;?>" style="margin-left:5px;">
																														<?php echo $reply->comment; ?>
																													</div>
																													<div class="com-nf-3-wrap">
																														<?php
                     if(empty($reply_react_count) || empty($reply_react_max_show)){}else{

                         ?>
																														<div class="com-nf-3 align-middle">
																															<div class="nf-3-react-icon">
																																<div class="react-inst-img align-middle">
																																	<?php
                foreach($reply_react_max_show as $react_max){
                echo '<img class="'.$react_max->reactType.'-max-show" src="assets/image/react/'.$react_max->reactType.'.JPEG" alt="" style="height:12px; width:12px; margin-right:2px; cursor:pointer;">';
                }
?>
																																</div>
																															</div>
																															<div class="nf-3-react-username">
																																<?php if($reply_react_count->maxreact == '0'){}else{
            echo $reply_react_count->maxreact;
                } ?>
																															</div>
																														</div>


																														<?php

}
                     ?>
																													</div>
																												</div>
																											</div>
																											<div class="reply-dot-option-wrap">
																												<div class="reply-dot" style="margin-left:5px;cursor:pointer;color:gray;" data-postid="<?php echo $comment->commentOn?>" data-userid="<?php echo $user_id; ?>" data-commentid="<?php echo $comment->commentID; ?>" data-replyid="<?php echo $reply->commentID; ?>">
																													...
																												</div>
																												<div class="reply-option-details-container"></div>
																											</div>
																										</div>
																										<div class="com-react">
																											<div class="com-like-react-reply" data-postid="<?php echo $reply->commentOn; ?>" data-userid="<?php echo $user_id; ?>" data-commentid="<?php
                    echo $reply->commentID; ?>" data-commentparentid="<?php echo $reply->commentReplyID; ?>">
																												<div class="com-react-bundle-wrap reply" data-commentid="<?php
                    echo $reply->commentID; ?>" data-commentparentid="<?php echo $reply->commentReplyID; ?>">

																												</div>
																												<?php if(empty($replyReactCheck)){
                        echo '<div class="reply-like-action-text"><span>Like</span></div>';
                    }else{echo '<div class="reply-like-action-text"><span class="'.$replyReactCheck->reactType.'-color">'.$replyReactCheck->reactType.'</span></div>';} ?>

																											</div>
																											<div class="com-reply-action-child" style="cursor:pointer;" data-postid="<?php echo $reply->commentOn; ?>" data-userid="<?php echo $user_id; ?>" data-commentid="<?php echo $reply->commentReplyID; ?>" data-profilepic="<?php echo $userdata->profilePic; ?>">
																												Reply
																											</div>
																											<div class="com-time">
																												<?php echo  $loadFromPost->timeAgoForCom($reply->commentAt);  ?>
																											</div>
																										</div>
																									</div>
																								</div>
																							</div>
																						</li>

																						<?php
                 }


                 ?>
																					</ul>
																				</div>
																				<div class="replyInput">

																				</div>
																			</div>
																		</div>
																	</div>
																</li>
																<?php
   }
             }
    ?>

															</ul>
														</div>
														<div class="comment-write">
															<div class="com-pro-pic" style="margin-top:4px;">
																<a href="#">
																	<span class="top-pic"><img src="<?php echo $userdata->profilePic; ?>" alt=""></span>
																</a>
															</div>
															<div class="com-input">
																<div class="comment-input" style="flex-basis:90%;">
																	<input type="text" name="" id="" class="comment-input-style comment-submit" placeholder="Write a comment..." data-postid="<?php echo $post->post_id; ?>" data-userid="<?php echo $user_id; ?>">
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="news-feed-photo"></div>
											</div>
										</div>


									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="profile-right-wrap "></div>
		</div>
		<div class="top-box-show"></div>
		<div id="adv_dem "></div>
	</div>
</main>


<script src="assets/js/jquery.js "></script>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>
	$(document).ready(function() {
		var maxLength = 1000;
		$(".nf-2-text").each(function() {
			var myStr = $(this).html();
			if ($.trim(myStr).length > maxLength) {
				var newStr = myStr.substring(0, maxLength);
				var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
				$(this).empty().html(newStr);
				$(this).append(' <a href="javascript:void(0);" class="read-more">read more...</a>');
				$(this).append('<span class="more-text">' + removedStr + '</span>');
			}
		});
		$(".read-more").click(function() {
			$(this).siblings(".more-text").contents().unwrap();
			$(this).remove();
		});
	});

</script>
<script src="assets/dist/emojionearea.min.js"></script>
<script>
	$(function() {
		var u_id = $('.userid-profileid-placeholder').data('userid');
		var p_id = $('.userid-profileid-placeholder').data('profileid');

		function notificationUpdate(userid) {
			$.post('http://localhost/mychat/core/ajax/notify.php', {
				notificationUpdate: userid
			}, function(data) {
				if (data.trim() == '0') {
					$('.notification-count').empty();
					$('.notification-count').css({
						"background-color": "transparent"
					});

				} else {
					$('.notification-count').html(data);
					$('.notification-count').css({
						"background-color": "red"
					});



					//
				}
			})
		}

		function requestNotificationUpdate(userid) {
			$.post('http://localhost/mychat/core/ajax/notify.php', {
				requestNotificationUpdate: userid
			}, function(data) {
				if (data.trim() == '0') {
					$('.request-count').empty();
					$('.request-count').css({
						"background-color": "transparent"
					});

				} else {
					$('.request-count').html(data);
					$('.request-count').css({
						"background-color": "red"
					});

				}
			})
		}

		$(document).on('click', '.top-notification', function() {
			$('.notification-list-wrap').toggle();
			var userid = u_id;

			$.post('http://localhost/mychat/core/ajax/notify.php', {
				notify: userid
			}, function(data) {

			})
		})

		$(document).on('click', '.request-top-notification', function() {
			$('.request-notification-list-wrap').toggle();
			var userid = u_id;

			$.post('http://localhost/mychat/core/ajax/notify.php', {
				notify: userid
			}, function(data) {

			})
		})



		var notificationInterval;
		var userid = u_id;
		notificationInterval = setInterval(function() {
			notificationUpdate(userid);
		}, 1000);
		var requestNotificationInterval;
		var userid = u_id;
		requestNotificationInterval = setInterval(function() {
			requestNotificationUpdate(userid);
		}, 1000);



		$(document).on('click', '.unread-notification', function() {
			$(this).removeClass('unread-notification').addClass('read-notification');
			var postid = $(this).data('postid');
			var notificationId = $(this).data('notificationid');
			var profileid = $(this).data('profileid');
			var userid = u_id;
			$.post('http://localhost/mychat/core/ajax/notify.php', {
				statusUpdate: userid,
				profileid: profileid,
				postid: postid,
				notificationId: notificationId
			}, function(data) {

			})
		})

		$('.profile-pic-upload').on('click', function() {
			$('.top-box-show').html('<div class="top-box align-vertical-middle profile-dialoge-show "> <div class="profile-pic-upload-action "> <div class="pro-pic-up "> <div class="file-upload "> <label for="profile-upload " class="file-upload-label "> <snap class="upload-plus-text align-middle "> <snap class="upload-plus-sign ">+</snap>Upload Photo</snap> </label> <input type="file" name="file-upload " id="profile-upload " class="file-upload-input "> </div> </div> <div class="pro-pic-choose "></div> </div> </div>')
		})
		$(document).on('change', '#profile-upload', function() {

			var name = $('#profile-upload').val().split('\\').pop();
			var file_data = $('#profile-upload').prop('files')[0];
			var file_size = file_data['size'];
			var file_type = file_data['type'].split('/').pop();
			var userid = u_id;
			var imgName = 'user/' + userid + '/profilePhoto/' + name + '';
			var form_data = new FormData();
			form_data.append('file', file_data);

			if (name != '') {
				$.post('http://localhost/mychat/core/ajax/profilePhoto.php', {
					imgName: imgName,
					userid: userid
				}, function(data) {
					//                            $('#adv_dem').html(/data);
				})

				$.ajax({
					url: 'http://localhost/mychat/core/ajax/profilePhoto.php',
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,
					type: 'post',
					success: function(data) {
						$('.profile-pic-me').attr('src', " " + data + " ");
						$('.profile-dialoge-show').hide();
					}
				})

			}

		})


		$('.add-cover-photo').on('click', function() {
			$('.add-cov-opt').toggle();
		})

		$('#cover-upload').on('change', function() {
			var name = $('#cover-upload').val().split('\\').pop();
			var file_data = $('#cover-upload').prop('files')[0];
			var file_size = file_data["size "];
			var file_type = file_data['type'].split('/').pop();

			var userid = u_id;
			var imgName = 'user/' + userid + '/coverphoto/' + name + '';

			var form_data = new FormData();

			form_data.append('file', file_data);

			if (name != '') {
				$.post('http://localhost/mychat/core/ajax/profile5.php', {
					imgName: imgName,
					userid: userid
				}, function(data) {
					//                            alert(data);

				})
			}
			$.ajax({
				url: 'http://localhost/mychat/core/ajax/profile5.php',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function(data) {
					$('.profile-cover-wrap').css('background-image', 'url(' + data + ')');
					$('.add-cov-opt').hide();
				}

			})
		});

		$('#statusEmoji').emojioneArea({
			pickPosition: "right",
			spellcheck: true
		});

		$(document).on('click', '.emojionearea-editor', function() {
			$('.status-share-button-wrap').show('0.5');
		})
		$(document).on('click', '.status-bot', function() {
			$('.status-share-button-wrap').show('0.5');
		})

		var fileCollection = new Array();

		$(document).on("change", "#multiple_files", function(e) {
			var count = 0;
			var files = e.target.files;
			$(this).removeData();
			var text = "";

			$.each(files, function(i, file) {
				fileCollection.push(file);
				var reader = new FileReader();

				reader.readAsDataURL(file);

				reader.onload = function(e) {
					var name = document.getElementById("multiple_files").files[i].name;
					var template = '<li class="ui-state-default del" style="position:relative;"><img id="' + name + '" style="width:60px; height:60px" src="' + e.target.result + '"></li>';
					$("#sortable").append(template);
				}
			})

			$("#sortable").append('<div class="remImg" style="position:absolute; top:0;right:0;cursor:pointer; display:flex;justify-content:center; align-items:center; background-color:white; border-radius:50%; height:1rem; width:1rem; font-size: 0.694rem;">X</div>')

		})
		$(document).on('click', '.remImg', function() {
			$('#sortable').empty();
			$('.input-restore').empty().html('<label for="multiple_files" class="file-upload-label"><div class="status-bot-1"><img src="assets/image/photo.JPG" alt=""><div class="status-bot-text">Photo/Video</div></div></label><input type="file" name="file-upload" id="multiple_files" class="file-upload-input" data-multiple-caption="{count} files selected" multiple="">');
		})

		$('.status-share-button').on('click', function() {
			var statusText = $('.emojionearea-editor').html();

			var formData = new FormData()

			var storeImage = [];

			var error_images = [];

			var files = $('#multiple_files')[0].files;

			if (files.length != 0) {
				if (files.length > 10) {
					error_images += 'You can not select more than 10 images';
				} else {
					for (var i = 0; i < files.length; i++) {
						var name = document.getElementById('multiple_files').files[i].name;

						storeImage += '{\"imageName\":\"user/' + u_id + '/postImage/' + name + '\"},';

						var ext = name.split('.').pop().toLowerCase();

						if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
							error_images += '<p>Invalid ' + i + ' File </p>';
						}

						var ofReader = new FileReader();

						ofReader.readAsDataURL(document.getElementById('multiple_files').files[i]);

						var f = document.getElementById('multiple_files').files[i];

						var fsize = f.size || f.fileSize;

						if (fsize > 200000000) {
							error_images += '<p>' + i + ' File Size is very big</p>';
						} else {
							formData.append('file[]', document.getElementById('multiple_files').files[i]);
						}

					}
				}

				if (files.length < 1) {

				} else {
					var str = storeImage.replace(/,\s*$/, "");

					var stIm = '[' + str + ']';
				}
				if (error_images == '') {
					$.ajax({
						url: 'http://localhost/mychat/core/ajax/uploadPostImage.php',
						method: "POST",
						data: formData,
						contentType: false,
						cache: false,
						processData: false,
						beforeSend: function() {
							$('#error_multiple_files').html('<br/><label> Uploading...</label>');
						},
						success: function(data) {
							$('#error_multiple_files').html(data);
							$('#sortable').empty();
						}
					})
				} else {
					$('#multiple_files').val('');
					$('#error_multiple_files').html("<span> " + error_images + "</span>");
					return false;
				}
			} else {
				var stIm = '';
			}
			if (stIm == '') {
				$.post('http://localhost/mychat/core/ajax/postSubmit.php', {
					onlyStatusText: statusText
				}, function(data) {
					$('adv_dem').html(data);
					location.reload();
				})
			} else {
				$.post('http://localhost/mychat/core/ajax/postSubmit.php', {
					stIm: stIm,
					statusText: statusText

				}, function(data) {
					$('#adv_dem').html(data);
					//                            location.reload();
				})
			}
		})
		//...........................post option......................
		$(document).on('click', '.post-option', function() {
			$('.post-option').removeAttr('id');
			$(this).attr('id', 'opt-click');
			var postid = $(this).data('postid');
			var userid = $(this).data('userid');
			var postDetails = $(this).siblings('.post-option-details-container');
			$(postDetails).show().html('<div class="post-option-details"><ul><li class="post-edit" data-postid="' + postid + '" data-userid="' + userid + '">Edit</li><li class="post-delete" data-postid="' + postid + '" data-userid="' + userid + '">Delete</li><li class="post-privacy" data-postid="' + postid + '" data-userid="' + userid + '">Privacy</li></ul></div>');
		})

		$(document).on('click', 'li.post-edit', function() {
			var statusTextContainer = $(this).parents('.nf-1').siblings('.nf-2').find('.nf-2-text');
			var addId = $(statusTextContainer).attr('id', 'editPostPut');
			var getPostText1 = $(statusTextContainer).text();
			var postid = $(statusTextContainer).data('postid');
			var userid = $(statusTextContainer).data('userid');
			var getPostImg = $(this).parents('.nf-1').siblings('.nf-2').find('.nf-2-img');
			var thiss = $(this).parents('.nf-1').siblings('.nf-2').find('.nf-2-img');
			var profilePic = $(statusTextContainer).data('profiePic');
			var getPostText = getPostText1.replace(/\s+/g, " ").trim();

			$('.top-box-show').html('<div class="top-box profile-dialog-show" style="top: 12.5%;left: 22.5%;width: 55%;"> <div class="edit-post-header align-middle " style="justify-content: space-between; padding: 10px; height: 20px; background-color: lightgray;font-size: 14px; font-weight:600; "> <div class="edit-post-text">Edit Post</div> <div class="edit-post-close" style="padding: 5px; color: gray; cursor:pointer;">x</div> </div> <div class="edit-post-value" style="border-bottom: 1px solid lightgray;"> <div class="status-med"> <div class="status-prof"> <div class="top-pic"><img src="' + profilePic + '" alt=""></div> </div> <div class="status-prof-textarea"><textarea data-autoresize rows="5" columns="5" placeholder="" name="textStatus" class="editStatus align-middle" style="font-family:sens-serif; font-weight:400; padding:5px;">' + getPostText + '</textarea></div> </div> </div> <div class="edit-post-submit" style="position: absolute;right:0; bottom: 0; display: flex; align-items: center; margin: 10px;"> <div class="status-privacy-wrap"> <div class="status-privacy "> <div class="privacy-icon align-middle"><img src="assets/images/profile/publicIcon.JPG" alt=""></div> <div class="privacy-text">Public</div> <div class="privacy-downarrow-icon align-middle"><img src="assets/images/watchmore.JPEG" alt=""></div> </div> <div class="status-privacy-option"></div> </div> <div class="edit-post-save" style="padding: 3px 15px; background-color: #4267bc;color: white; font-size: 14px; margin-left:5px; cursor:pointer;" data-postid="' + postid + '" data-userid="' + userid + '" data-tag="' + thiss + '">Save</div> </div> </div>');



		})

		$(document).on('click', '.edit-post-save', function() {
			var postid = $(this).data('postid');
			var userid = $(this).data('userid');
			var editedText = $(this).parents('.edit-post-submit').siblings('.edit-post-value').find('.editStatus');
			var editedTextVal = $(editedText).val();

			$.post('http://localhost/mychat/core/ajax/editPost.php', {
				editedTextVal: editedTextVal,
				postid: postid,
				userid: userid

			}, function(data) {
				$('#editPostPut').html(data).removeAttr('id');
				$('.top-box-show').empty();
			})
		})

		$(document).on('click', '.post-delete', function() {
			var postid = $(this).data('postid');
			var userid = $(this).data('userid');
			var postContainer = $(this).parents('.profile-timeline');
			var r = confirm("Do you want to delete the post?");

			if (r == true) {
				$.post('http://localhost/mychat/core/ajax/editPost.php', {
					deletePost: postid,
					userid: userid
				}, function(data) {
					$(postContainer).empty();

					alert(data);




				})
			}
		})


		//...........................post option end......................


		//...........................Main react......................
		$(document).on('click', '.like-action', function() {
			var likeActionIcon = $(this).find('.like-action-icon img');
			var likeReactParent = $(this).parents('.like-action-wrap');
			var nf4 = $(likeReactParent).parents('.nf-4');
			var nf_3 = $(nf4).siblings('.nf-3').find('.react-count-wrap');
			var reactCount = $(nf4).siblings('.nf-3').find('.nf-3-react-username');
			var reactNumText = $(reactCount).text();
			var postId = $(likeReactParent).data('postid');
			var userId = $(likeReactParent).data('userid');
			var typeText = $(this).find('.like-action-text span');
			var typeR = $(typeText).text();
			var spanClass = $(this).find('.like-action-text').find('span');


			if ($(spanClass).attr('class') !== undefined) {

				if ($(likeActionIcon).attr('src') == 'assets/image/likeAction.JPG') {
					(spanClass).addClass('like-color');
					$(likeActionIcon).attr('src', 'assets/image/react/like.JPEG').addClass('reactIconSize');
					spanClass.text('like');
					mainReactSubmit(typeR, postId, userId, nf_3);
				} else {
					$(likeActionIcon).attr('src', 'assets/image/likeAction.JPG');
					spanClass.removeClass();
					spanClass.text('Like');
					mainReactDelete(typeR, postId, userId, nf_3);
				}
			} else if ($(spanClass).attr('class') === undefined) {
				(spanClass).addClass('like-color');
				$(likeActionIcon).attr('src', 'assets/image/react/like.JPEG').addClass('reactIconSize');
				spanClass.text('like');
				mainReactSubmit(typeR, postId, userId, nf_3);
			} else {
				(spanClass).addClass('like-color');
				$(likeActionIcon).attr('src', 'assets/image/react/like.JPEG').addClass('reactIconSize');
				spanClass.text('like');
				mainReactSubmit(typeR, postId, userId, nf_3);
			}


		})

		function mainReactSubmit(typeR, postId, userId, nf_3) {
			var profileid = "<?php echo $profileId; ?>";
			$.post('http://localhost/mychat/core/ajax/react.php', {
				reactType: typeR,
				postId: postId,
				userId: userId,
				profileid: profileid
			}, function(data) {
				$(nf_3).empty().html(data);
			})
		}

		function mainReactDelete(typeR, postId, userId, nf_3) {
			var profileid = p_id;
			$.post('http://localhost/mychat/core/ajax/react.php', {
				deleteReactType: typeR,
				postId: postId,
				userId: userId,
				profileid: profileid
			}, function(data) {
				$(nf_3).empty().html(data);
			})
		}

		$('.like-action-wrap').hover(function() {
			var mainReact = $(this).find('.react-bundle-wrap');
			$(mainReact).html(' <div class="react-bundle align-middle" style="position:absolute;margin-top: -43px; margin-left: -40px; display:flex; background-color:white;padding: 0 2px;border-radius: 25px; box-shadow: 0px 0px 5px black; height:45px; width:270px; justify-content:space-around; transition: 0.3s;"> <div class="like-react-click align-middle"> <img class="main-icon-css" src="<?php echo " ".BASE_URL."assets/image/react/like.JPEG "; ?>" alt=""></div> <div class="love-react-click align-middle"> <img class="main-icon-css" src="<?php echo " ".BASE_URL."assets/image/react/love.JPEG "; ?>" alt=""></div> <div class="haha-react-click align-middle"> <img class="main-icon-css" src="<?php echo " ".BASE_URL."assets/image/react/haha.JPEG "; ?>" alt=""></div> <div class="wow-react-click align-middle"> <img class="main-icon-css" src="<?php echo " ".BASE_URL."assets/image/react/wow.JPEG "; ?>" alt=""></div> <div class="sad-react-click align-middle"> <img class="main-icon-css" src="<?php echo " ".BASE_URL."assets/image/react/sad.JPEG "; ?>" alt=""></div> <div class="angry-react-click align-middle"> <img class="main-icon-css" src="<?php echo " ".BASE_URL."assets/image/react/angry.JPEG "; ?>" alt=""></div> </div>');
		}, function() {
			var mainReact = $(this).find('.react-bundle-wrap');
			$(mainReact).html('');
		})

		$(document).on('click', '.main-icon-css', function() {
			var likeReact = $(this).parent();
			reactReply(likeReact);
		})

		function reactReply(sClass) {
			if ($(sClass).hasClass('like-react-click')) {
				mainReactSub('like', 'blue');
			} else if ($(sClass).hasClass('love-react-click')) {
				mainReactSub('love', 'red');
			} else if ($(sClass).hasClass('haha-react-click')) {
				mainReactSub('haha', 'yellow');
			} else if ($(sClass).hasClass('wow-react-click')) {
				mainReactSub('wow', 'yellow');
			} else if ($(sClass).hasClass('sad-react-click')) {
				mainReactSub('sad', 'yellow');
			} else if ($(sClass).hasClass('angry-react-click')) {
				mainReactSub('angry', 'red');
			} else {
				console.log('Not found');
			}
		}

		function mainReactSub(typeR, color) {
			var reactColor = '' + typeR + '-color';
			var pClass = $('.' + typeR + '-react-click.align-middle');
			var likeReactParent = $(pClass).parents('.like-action-wrap');
			var nf4 = $(likeReactParent).parents('.nf-4');
			var nf_3 = $(nf4).siblings('.nf-3').find('.react-count-wrap');
			var reactCount = $(nf4).siblings('.nf-3').find('.nf-3-react-username');
			var reactNumText = $(reactCount).text();

			var postId = $(likeReactParent).data('postid');
			var userId = $(likeReactParent).data('userid');
			var likeAction = $(likeReactParent).find('.like-action');
			var likeActionIcon = $(likeAction).find('.like-action-icon img');
			var spanClass = $(likeAction).find('.like-action-text').find('span');

			if ($(spanClass).hasClass(reactColor)) {
				$(spanClass).removeClass();
				spanClass.text('Like');
				$(likeActionIcon).attr('src', 'assets/image/likeAction.JPG');
				mainReactDelete(typeR, postId, userId, nf_3);
			} else if ($(spanClass).attr('class') !== undefined) {
				$(spanClass).removeClass().addClass(reactColor);
				spanClass.text(typeR);
				$(likeActionIcon).removeAttr('src').attr('src', 'assets/image/react/' + typeR + '.JPEG').addClass('reactIconSize');
				mainReactSubmit(typeR, postId, userId, nf_3);
			} else {
				$(spanClass).addClass(reactColor);
				//                        $(likeActionIcon).attr('src', 'assets/image/react/' + typeR + '.JPEG').addClass('reactIconSize');
				spanClass.text(typeR);
				$(likeActionIcon).removeAttr('src').attr('src', 'assets/image/react/' + typeR + '.JPEG').addClass('reactIconSize');
				mainReactSubmit(typeR, postId, userId, nf_3);
			}


		}


		//...........................Main react end ......................


		//...........................Comment start ......................

		$(document).on('click', '.comment-action', function() {
			$(this).parents('.nf-4').siblings('.nf-5').find('input.comment-input-style.comment-submit').focus();
		})

		$('.comment-submit').keyup(function(e) {
			if (e.keyCode == 13) {
				var inputNull = $(this);
				var comment = $(this).val();
				var postid = $(this).data('postid');
				var userid = $(this).data('userid');
				var profileid = p_id;
				var commentPlaceholder = $(this).parents('.nf-5').find('ul.add-comment');

				if (comment == '') {
					alert("Please Enter Some Text");
				} else {
					$.ajax({
						type: "POST",
						url: "http://localhost/mychat/core/ajax/comment.php",
						data: {
							comment: comment,
							userid: userid,
							postid: postid,
							profileid: profileid
						},
						cache: false,
						success: function(html) {
							$(commentPlaceholder).append(html);
							$(inputNull).val('');
							commentHover();
						}
					})
				}



			}
		})

		commentHover();

		function commentHover() {

			$('.com-like-react').hover(function() {
				var mainReact = $(this).find('.com-react-bundle-wrap');
				$(mainReact).html('<div class="react-bundle align-middle" style="position:absolute;margin-top: -45px; margin-left: -40px; display:flex; background-color:white;padding: 0 2px;border-radius: 25px; box-shadow: 0px 0px 5px black; height:45px; width:270px; justify-content:space-around; transition: 0.3s;z-index:2"><div class="com-like-react-click align-middle"><img class="com-main-icon-css" src="<?php echo " ".BASE_URL."assets/image/react/like.JPEG "; ?>" alt=""></div><div class="com-love-react-click align-middle"><img class="com-main-icon-css" src="<?php echo " ".BASE_URL."assets/image/react/love.JPEG "; ?>" alt=""></div><div class="com-haha-react-click align-middle"><img class="com-main-icon-css" src="<?php echo " ".BASE_URL."assets/image/react/haha.JPEG "; ?>" alt=""></div><div class="com-wow-react-click align-middle"><img class="com-main-icon-css" src="<?php echo " ".BASE_URL."assets/image/react/wow.JPEG "; ?>" alt=""></div><div class="com-sad-react-click align-middle"><img class="com-main-icon-css" src="<?php echo " ".BASE_URL."assets/image/react/sad.JPEG "; ?>" alt=""></div><div class="com-angry-react-click align-middle"><img class="com-main-icon-css" src="<?php echo " ".BASE_URL."assets/image/react/angry.JPEG "; ?>" alt=""></div></div>');
			}, function() {
				var mainReact = $(this).find('.com-react-bundle-wrap');
				$(mainReact).html('');
			})
		}

		$(document).on('click', '.com-main-icon-css', function() {
			var com_bundle = $(this).parents('.com-react-bundle-wrap');
			var commentID = $(com_bundle).data('commentid');
			var likeReact = $(this).parent();
			comReactApply(likeReact, commentID);

		})

		function comReactApply(sClass, commentID) {
			if ($(sClass).hasClass('com-like-react-click')) {
				comReactSub('like', commentID);
			} else if ($(sClass).hasClass('com-love-react-click')) {
				comReactSub('love', commentID);
			} else if ($(sClass).hasClass('com-haha-react-click')) {
				comReactSub('haha', commentID);
			} else if ($(sClass).hasClass('com-wow-react-click')) {
				comReactSub('wow', commentID);
			} else if ($(sClass).hasClass('com-sad-react-click')) {
				comReactSub('sad', commentID);
			} else if ($(sClass).hasClass('com-angry-react-click')) {
				comReactSub('angry', commentID);
			} else {
				console.log('Not found');
			}
		}

		function comReactSub(typeR, commentID) {
			var reactColor = '' + typeR + '-color';
			var parentClass = $('.com-' + typeR + '-react-click.align-middle');
			var grandParent = $(parentClass).parents('.com-like-react');
			var postid = $(grandParent).data('postid');
			var userid = $(grandParent).data('userid');

			var spanClass = $(grandParent).find('.com-like-action-text').find('span');
			var com_nf_3 = $(grandParent).parent('.com-react').siblings('.com-text-option-wrap').find('.com-nf-3-wrap');
			if ($(spanClass).attr('class') !== undefined) {
				if ($(spanClass).hasClass(reactColor)) {
					$(spanClass).removeAttr('class');
					spanClass.text('Like');
					comReactDelete(typeR, postid, userid, commentID, com_nf_3);
				} else {
					$(spanClass).removeClass().addClass(reactColor);
					spanClass.text(typeR);
					comReactSubmit(typeR, postid, userid, commentID, com_nf_3);
				}
			} else {
				$(spanClass).addClass(reactColor);
				spanClass.text(typeR);
				comReactSubmit(typeR, postid, userid, commentID, com_nf_3)
			}
		}

		$(document).on('click', '.com-like-action-text', function() {
			var thisParents = $(this).parents('.com-like-react');
			var postid = $(thisParents).data('postid');
			var userid = $(thisParents).data('userid');
			var commentID = $(thisParents).data('commentid');
			var typeText = $(thisParents).find('.com-like-action-text');
			var typeR = $(typeText).text();
			var com_nf_3 = $(thisParents).parents('.com-react').siblings('.com-text-option-wrap').find('.com-nf-3-wrap');
			var spanClass = $(thisParents).find('.com-like-action-text').find('span');

			if ($(spanClass).attr('class') !== undefined) {
				$(spanClass).removeAttr('class');
				spanClass.text('Like');
				comReactDelete(typeR, postid, userid, commentID, com_nf_3);
			} else {
				$(spanClass).addClass('like-color');
				spanClass.text('Like');
				comReactSubmit(typeR, postid, userid, commentID, com_nf_3);
			}
		})

		function comReactSubmit(typeR, postid, userid, commentID, com_nf_3) {
			var profileid = p_id;
			$.post('http://localhost/mychat/core/ajax/commentReact.php', {
					commentid: commentID,
					reactType: typeR,
					postid: postid,
					userid: userid,
					profileid: profileid
				},
				function(data) {
					$(com_nf_3).empty().html(data);

				});
		}

		function comReactDelete(typeR, postid, userid, commentID, com_nf_3) {
			var profileid = p_id;;
			$.post('http://localhost/mychat/core/ajax/commentReact.php', {
					deleteReactType: typeR,
					delCommentid: commentID,
					postid: postid,
					userid: userid,
					profileid: profileid
				},
				function(data) {
					$(com_nf_3).empty().html(data);
				});
		}

		$(document).on('click', '.com-dot', function() {
			$('.com-dot').removeAttr('id');
			$(this).attr('id', 'com-opt-click');
			var postid = $(this).data('postid');
			var userid = $(this).data('userid');
			var commentid = $(this).data('commentid');
			var comDetails = $(this).siblings('.com-option-details-container');
			$(comDetails).show().html('<div class="com-option-details" style="z-index:2;"><ul><li class="com-edit" data-postid="' + postid + '" data-userid="' + userid + '" data-commentid="' + commentid + '">Edit</li><li class="com-delete" data-postid="' + postid + '" data-userid="' + userid + '" data-commentid="' + commentid + '">Delete</li><li class="com-privacy" data-postid="' + postid + '" data-userid="' + userid + '">privacy</li></ul></div>');
		})

		$(document).on('click', 'li.com-edit', function() {
			var comTextContainer = $(this).parents('.com-dot-option-wrap').siblings('.com-pro-text').find('.com-text');
			var addId = $(comTextContainer).attr('id', 'editComPut');
			var getComText1 = $(comTextContainer).text();
			var postid = $(comTextContainer).data('postid');
			var userid = $(comTextContainer).data('userid');
			var commentid = $(comTextContainer).data('commentid');
			var profilepic = $(comTextContainer).data('profilepic');
			var getComText = getComText1.replace(/\s+/g, " ").trim();
			$('.top-box-show').html('<div class="top-box profile-dialog-show" style="top: 12.5%;left: 22.5%;width: 55%;"><div class="edit-post-header align-middle " style="justify-content: space-between; padding: 10px; height: 20px; background-color: lightgray;font-size: 14px; font-weight:600; "><div class="edit-post-text">Edit Comment</div><div class="edit-post-close" style="padding: 5px; color: gray; cursor:pointer;">x</div></div><div class="edit-post-value" style="border-bottom: 1px solid lightgray;"><div class="status-med"><div class="status-prof"><div class="top-pic"><img src="' + profilepic + '" alt=""></div></div><div class="status-prof-textarea"><textarea data-autoresize rows="5" columns="5" placeholder="" name="textStatus" class="editCom align-middle" style="font-family:sens-serif; font-weight:400; padding:5px;">' + getComText + '</textarea></div></div></div><div class="edit-post-submit" style="position: absolute;right:0; bottom: 0; display: flex; align-items: center; margin: 10px;"><div class="status-privacy-wrap"><div class="status-privacy  "><div class="privacy-icon align-middle"><img src="assets/image/profile/publicIcon.JPG" alt=""></div><div class="privacy-text">Public</div><div class="privacy-downarrow-icon align-middle"><img src="assets/image/watchmore.JPEG" alt=""></div></div><div class="status-privacy-option"></div></div><div class="edit-com-save" style="padding: 3px 15px; background-color: #4267bc;color: white; font-size: 14px; margin-left:5px; cursor:pointer;" data-postid="' + postid + '" data-userid="' + userid + '" data-commentid="' + commentid + '" >Save</div></div></div>');
		})

		$(document).on('click', '.edit-com-save', function() {
			var postid = $(this).data('postid');
			var userid = $(this).data('userid');
			var commentid = $(this).data('commentid');
			var editedText = $(this).parents('.edit-post-submit').siblings('.edit-post-value').find('.editCom');
			var editedTextVal = $(editedText).val();
			$.post('http://localhost/mychat/core/ajax/editComment.php', {
				postid: postid,
				userid: userid,
				editedTextVal: editedTextVal,
				commentid: commentid
			}, function(data) {
				$('#editComPut').html(data).removeAttr('id');
				$('.top-box-show').empty();
			})
		})
		$(document).on('click', '.com-delete', function() {
			var postid = $(this).data('postid');
			var userid = $(this).data('userid');
			var commentid = $(this).data('commentid');
			var comContainer = $(this).parents('.new-comment');
			var profileid = p_id;

			var r = confirm('Do you want to delete the comment?');
			if (r === true) {
				$.post('http://localhost/mychat/core/ajax/editComment.php', {
					deletePost: postid,
					userid: userid,
					commentid: commentid
				}, function(data) {
					$(comContainer).empty();
				})
			}
		})


		//...........................Comment end ......................


		//...........................Reply Start ......................
		$(document).on('click', '.com-reply-action', function() {
			$('.reply-input').empty();
			$('.reply-write').hide();
			var BASE_URL = 'http://localhost/mychat';
			var userid = $(this).data('userid');
			var postid = $(this).data('postid');
			var commentid = $(this).data('commentid');
			var profilepic = $(this).data('profilepic');

			var input_field = $(this).parents('.com-text-react-wrap').siblings('.reply-wrap').find('.replyInput');

			input_field.html('<div class="reply-write"><div class="com-pro-pic" style="margin-top: 4px;"><a href="#"><div class="top-pic"><img src="' + profilepic + '" alt=""></div></a></div><div class="com-input" style=""><div class="reply-input" style="flex-basis:96%;"><input type="text" name="" id="" class="reply-input-style reply-submit" style="" data-postid="' + postid + '" data-userid="' + userid + '" data-commentid="' + commentid + '" placeholder="Write a reply..."></div></div></div>');

			replyInput(input_field);

		})
		$(document).on('click', '.com-reply-action-child', function() {
			$('.reply-input').empty();
			$('.reply-write').hide();
			var BASE_URL = 'http://localhost/mychat';
			var userid = $(this).data('userid');
			var postid = $(this).data('postid');
			var commentid = $(this).data('commentid');
			var profilepic = $(this).data('profilepic');

			var input_field = $(this).parents('.reply-wrap').find('.replyInput');

			input_field.html('<div class="reply-write"><div class="com-pro-pic" style="margin-top: 4px;"><a href="#"><div class="top-pic"><img src="' + profilepic + '" alt=""></div></a></div><div class="com-input" style=""><div class="reply-input" style="flex-basis:96%;"><input type="text" name="" id="" class="reply-input-style reply-submit" style="" data-postid="' + postid + '" data-userid="' + userid + '" data-commentid="' + commentid + '" placeholder="Write a reply..."></div></div></div>');

			replyInput(input_field);

		})

		function replyInput(input_field) {
			console.log(input_field);
			$(input_field).find('input.reply-input-style.reply-submit').focus();
			$('input.reply-input-style.reply-submit').keyup(function(e) {
				if (e.keyCode == 13) {
					var inputNull = $(this);
					var comment = $(this).val();
					var postid = $(this).data('postid');
					var userid = $(this).data('userid');
					var commentid = $(this).data('commentid');
					var profileid = p_id;
					var replyPlaceholder = $(this).parents('.replyInput').siblings('.reply-text-wrap').find('.old-reply');
					if (comment == '') {
						alert("Please Enter Some Text.");
					} else {
						$.ajax({
							type: "POST",
							url: "http://localhost/mychat/core/ajax/reply.php",
							data: {
								replyComment: comment,
								userid: userid,
								postid: postid,
								commentid: commentid,
								profileid: profileid
							},
							cache: false,
							success: function(html) {
								$(replyPlaceholder).append(html)
								$(inputNull).val('');
								replyHover();
							}
						})
					}

				}
			})
		}
		replyHover();

		function replyHover() {
			$('.com-like-react-reply').hover(function() {
				var mainReact = $(this).find('.com-react-bundle-wrap.reply');
				$(mainReact).html(' <div class="react-bundle  align-middle" style="position:absolute;margin-top: -45px; margin-left: -40px; display:flex; background-color:white;padding: 0 2px;border-radius: 25px; box-shadow: 0px 0px 5px black; height:45px; width:270px; justify-content:space-around; transition: 0.3s;z-index:2"><div class="com-like-react-click  align-middle"><img class="reply-main-icon-css " src="<?php echo " ".BASE_URL."assets/image/react/like.JPEG "; ?>" alt=""></div><div class="com-love-react-click align-middle"><img class="reply-main-icon-css " src="<?php echo " ".BASE_URL."assets/image/react/love.JPEG "; ?>" alt=""></div><div class="com-haha-react-click  align-middle"><img class="reply-main-icon-css " src="<?php echo " ".BASE_URL."assets/image/react/haha.JPEG "; ?>" alt=""></div><div class="com-wow-react-click  align-middle"><img class="reply-main-icon-css " src="<?php echo " ".BASE_URL."assets/image/react/wow.JPEG "; ?>" alt=""></div><div class="com-sad-react-click  align-middle"><img class="reply-main-icon-css " src="<?php echo " ".BASE_URL."assets/image/react/sad.JPEG "; ?>" alt=""></div><div class="com-angry-react-click  align-middle"><img class="reply-main-icon-css " src="<?php echo " ".BASE_URL."assets/image/react/angry.JPEG "; ?>" alt=""></div></div>');
			}, function() {
				var mainReact = $(this).find('.com-react-bundle-wrap');
				$(mainReact).html('');
			})
		}

		$(document).on('click', '.reply-main-icon-css', function() {
			var com_bundle = $(this).parents('.com-react-bundle-wrap');
			var commentID = $(com_bundle).data('commentid');
			var commentparentid = $(com_bundle).data('commentparentid');
			var likeReact = $(this).parent();
			replyReactApply(likeReact, commentID, commentparentid);
		})

		function replyReactApply(sClass, commentID, commentparentid) {
			if ($(sClass).hasClass('com-like-react-click')) {
				replyReactSub('like', commentID, commentparentid);
			} else if ($(sClass).hasClass('com-love-react-click')) {
				replyReactSub('love', commentID, commentparentid);
			} else if ($(sClass).hasClass('com-haha-react-click')) {
				replyReactSub('haha', commentID, commentparentid);
			} else if ($(sClass).hasClass('com-wow-react-click')) {
				replyReactSub('wow', commentID, commentparentid);
			} else if ($(sClass).hasClass('com-sad-react-click')) {
				replyReactSub('sad', commentID, commentparentid);
			} else if ($(sClass).hasClass('com-angry-react-click')) {
				replyReactSub('angry', commentID, commentparentid);
			} else {
				console.log('not found');
			}
		}

		function replyReactSub(typeR, commentID, commentparentid) {
			var reactColor = '' + typeR + '-color';
			var parentClass = $('.com-' + typeR + '-react-click.align-middle');
			var grandParent = $(parentClass).parents('.com-like-react-reply');
			var postid = $(grandParent).data('postid');
			var userid = $(grandParent).data('userid');

			var spanClass = $(grandParent).find('.reply-like-action-text').find('span');
			var com_nf_3 = $(grandParent).parent('.com-react').siblings('.reply-text-option-wrap').find('.com-nf-3-wrap');

			if ($(spanClass).attr('class') !== undefined) {
				if ($(spanClass).hasClass(reactColor)) {
					$(spanClass).removeAttr('class');
					spanClass.text('Like');
					replyReactDelete(typeR, postid, userid, commentID, commentparentid, com_nf_3);
				} else {
					$(spanClass).removeClass().addClass('reactColor');
					spanClass.text(typeR);
					replyReactSubmit(typeR, postid, userid, commentID, commentparentid, com_nf_3);
				}
			} else {
				$(spanClass).addClass(reactColor);
				spanClass.text(typeR);
				replyReactSubmit(typeR, postid, userid, commentID, commentparentid, com_nf_3);
			}

		}

		$(document).on('click', '.reply-like-action-text', function() {
			var thisParents = $(this).parents('.com-like-react-reply');
			var postid = $(thisParents).data('postid');
			var userid = $(thisParents).data('userid');
			var commentID = $(thisParents).data('commentid');
			var commentparentid = $(thisParents).data('commentparentid');
			var typeText = $(thisParents).find('.reply-like-action-text span');

			var typeR = $(typeText).text();
			var reactColor = '' + typeR + '-color';
			var com_nf_3 = $(thisParents).parent('.com-react').siblings('.reply-text-option-wrap').find('.com-nf-3-wrap');

			var spanClass = $(thisParents).find('.reply-like-action-text').find('span');

			if ($(spanClass).attr('class') !== undefined) {
				if ($(spanClass).hasClass(reactColor)) {
					$(spanClass).removeAttr('class');
					spanClass.text('Like');
					replyReactDelete(typeR, postid, userid, commentID, commentparentid, com_nf_3);
				} else {
					$(spanClass).removeClass().addClass(reactColor);
					spanClass.text(typeR);
					replyReactSubmit(typeR, postid, userid, commentID, commentparentid, com_nf_3);
				}
			} else {
				$(spanClass).addClass(reactColor);
				spanClass.text('Like');
				replyReactSubmit(typeR, postid, userid, commentID, commentparentid, com_nf_3);
			}
		})

		function replyReactSubmit(typeR, postid, userid, commentID, commentparentid, com_nf_3) {
			var profileid = <?php echo $profileId; ?>;
			$.post('http://localhost/mychat/core/ajax/replyReact.php', {
				commentid: commentID,
				reactType: typeR,
				postid: postid,
				userid: userid,
				commentparentid: commentparentid,
				profileid: profileid
			}, function(data) {
				$(com_nf_3).empty().html(data);
			})
		}

		function replyReactDelete(typeR, postid, userid, commentID, commentparentid, com_nf_3) {
			var profileid = p_id;
			$.post('http://localhost/mychat/core/ajax/replyReact.php', {
				delcommentid: commentID,
				deleteReactType: typeR,
				postid: postid,
				userid: userid,
				commentparentid: commentparentid,
				profileid: profileid
			}, function(data) {
				$(com_nf_3).empty().html(data);
			})
		}

		$(document).on('click', '.reply-dot', function() {

			$('.reply-dot').removeAttr('id');
			$(this).attr('id', 'reply-opt-click');
			var postid = $(this).data('postid');
			var userid = $(this).data('userid');
			var commentid = $(this).data('commentid');
			var replyid = $(this).data('replyid');

			var replyDetails = $(this).siblings('.reply-option-details-container');
			$(replyDetails).html('<div class="reply-option-details" style="z-index:2;"><ul style="padding:0;"><li class="reply-edit" data-postid="' + postid + '" data-userid="' + userid + '" data-commentid="' + commentid + '">Edit</li><li class="reply-delete" data-postid="' + postid + '" data-userid="' + userid + '" data-commentid="' + commentid + '" data-replyid="' + replyid + '">Delete</li><li class="reply-privacy" data-postid="' + postid + '" data-userid="' + userid + '">privacy</li></ul></div>');
		})
		$(document).on('click', 'li.reply-edit', function() {
			var comTextContainer = $(this).parents('.reply-dot-option-wrap').siblings('.com-pro-text').find('.com-text');

			var addId = $(comTextContainer).attr('id', 'editReplyPut');
			var getComText1 = $(comTextContainer).text();
			var postid = $(comTextContainer).data('postid');
			var userid = $(comTextContainer).data('userid');
			var commentid = $(comTextContainer).data('commentid');
			var replyid = $(comTextContainer).data('replyid');
			var profilepic = $(comTextContainer).data('profilepic');
			var getComText = getComText1.replace(/\s+/g, " ").trim();

			$('.top-box-show').html('<div class="top-box profile-dialog-show" style="top: 12.5%;left: 22.5%;width: 55%;"><div class="edit-post-header align-middle " style="justify-content: space-between; padding: 10px; height: 20px; background-color: lightgray;font-size: 14px; font-weight:600; "><div class="edit-post-text">Edit Comment</div><div class="edit-post-close" style="padding: 5px; color: gray; cursor:pointer;">x</div></div><div class="edit-post-value" style="border-bottom: 1px solid lightgray;"><div class="status-med"><div class="status-prof"><div class="top-pic"><img src="' + profilepic + '" alt=""></div></div><div class="status-prof-textarea"><textarea data-autoresize rows="5" columns="5" placeholder="" name="textStatus" class="editReply align-middle" style="font-family:sens-serif; font-weight:400; padding:5px;">' + getComText + '</textarea></div></div></div><div class="edit-post-submit" style="position: absolute;right:0; bottom: 0; display: flex; align-items: center; margin: 10px;"><div class="status-privacy-wrap"><div class="status-privacy  "><div class="privacy-icon align-middle"><img src="assets/images/profile/publicIcon.JPG" alt=""></div><div class="privacy-text">Public</div><div class="privacy-downarrow-icon align-middle"><img src="assets/images/watchmore.JPEG" alt=""></div></div><div class="status-privacy-option"></div></div><div class="edit-reply-save" style="padding: 3px 15px; background-color: #4267bc;color: white; font-size: 14px; margin-left:5px; cursor:pointer;" data-postid="' + postid + '" data-userid="' + userid + '" data-commentid="' + commentid + '" data-replyid="' + replyid + '">Save</div></div></div>');

		});

		$(document).on('click', '.edit-reply-save', function() {
			var postid = $(this).data('postid');
			var userid = $(this).data('userid');
			var commentid = $(this).data('commentid');
			var replyid = $(this).data('replyid');
			var editedText = $(this).parents('.edit-post-submit').siblings('.edit-post-value').find('.editReply');

			var editedTextVal = $(editedText).val();

			$.post('http://localhost/mychat/core/ajax/editReply.php', {
				postid: postid,
				userid: userid,
				editedTextVal: editedTextVal,
				commentid: commentid,
				replyid: replyid
			}, function(data) {
				$('#editReplyPut').html(data).removeAttr('id');
				$('.top-box-show').empty();
			})
		})


		$(document).on('click', '.reply-delete', function() {
			var postid = $(this).data('postid');
			var userid = $(this).data('userid');
			var commentid = $(this).data('commentid');
			var replyid = $(this).data('replyid');
			var replyContainer = $(this).parents('.new-reply');
			var r = confirm("Do you want to delete the comment?");
			if (r == true) {
				$.post('http://localhost/mychat/core/ajax/editReply.php', {
					deleteReply: postid,
					userid: userid,
					commentid: commentid,
					replyid: replyid
				}, function(data) {

					$(replyContainer).empty();
				})
			}
		})

		//...........................Reply end ......................


		//...........................Share ......................

		$(document).on('click', '.share-action', function() {
			var postid = $(this).data('postid');
			var userid = $(this).data('userid');
			var profilePic = $(this).data('profilepic');
			var profileid = $(this).data('profileid');

			var nf_1 = $(this).parents('.nf-4').siblings('.nf-1').html();
			var nf_2 = $(this).parents('.nf-4').siblings('.nf-2').html();

			$('.top-box-show').html('<div class="top-box profile-dialog-show" style="overflow: hidden;background-color: rgb(236, 236, 236);"> <div class="edit-post-header align-middle " style="justify-content: space-between; padding: 10px; height: 20px; background-color: lightgray;font-size: 14px; font-weight:600; "> <div class="edit-post-text">Share Post</div> <div class="edit-post-close" style="padding: 5px; color: gray; cursor:pointer;">x</div> </div> <div class="edit-post-value" style=""> <div class="status-med"> <div class="status-prof"> <div class="top-pic"><img src="' + profilePic + '" alt=""></div> </div> <div class="status-prof-textarea"> <textarea data-autoresize rows="5" columns="5" placeholder="Tell something about the post.." name="textStatus" class="shareText align-middle" style="padding-top: 10px;"></textarea> </div> </div> </div> <div class="news-feed-text" style=" display: flex; flex-direction: column; align-items: baseline; margin:5px;box-shadow:0 0 2px darkgray;overflow: hidden;"> ' + nf_1 + ' ' + nf_2 + ' </div> <div class="edit-post-submit" style="position: absolute;right:0; bottom: 0; display: flex; align-items: center; margin: 10px; z-index: 1;"> <div class="status-privacy-wrap"> <div class="status-privacy " style="background-color: #f5f6f8;"> <div class="privacy-icon align-middle"> <img src="assets/image/profile/publicIcon.JPG" alt=""> </div> <div class="privacy-text">Public</div> <div class="privacy-downarrow-icon align-middle"> <img src="assets/image/watchmore.JPEG" alt=""> </div> </div> <div class="status-privacy-option"> </div> </div> <div class="post-Share" style="padding: 3px 15px; background-color: #4267bc;color: white; font-size: 14px; margin-left:5px;cursor:pointer;" data-postid="' + postid + '" data-userid="' + userid + '" data-profileid="' + profileid + '" >Share</div> </div> <div style=" position: absolute; bottom: 0; height: 43px; width: 100%; text-align: center; background: lightgrey;box-shadow: -1px -1px 5px grey;"></div> </div>');

			$('.nf-1-right-dott').hide();
		})
		$(document).on('click', '.post-Share', function() {
			var postid = $(this).data('postid');
			var userid = $(this).data('userid');
			var profileid = $(this).data('profileid');
			var shareText = $(this).parents('.edit-post-submit').siblings('.edit-post-value').find('.shareText').val();

			$.post('http://localhost/mychat/core/ajax/share.php', {
				shareText: shareText,
				profileid: profileid,
				postid: postid,
				userid: userid

			}, function(data) {
				$('.top-box-show').empty();
			})
		})
		$(document).on('click', '.share-container', function() {
			var userLink = $(this).data('userlink');
			window.location.href = "http://localhost/mychat/profile5.php?username=" + userLink + "";
		})
		$(document).on('click', '.shared-post-option', function() {
			$('.shared-post-option').removeAttr('id');
			$('.post-option').removeAttr('id');
			var postid = $(this).data('postid');
			var userid = $(this).data('userid');
			$(this).attr('id', 'opt-click');

			var postDetails = $(this).siblings('.shared-post-option-details-container');
			$(postDetails).show().html('<div class="shared-post-option-details"><ul style="padding:0;"><li class="shared-post-edit" data-postid="' + postid + '" data-userid="' + userid + '">Edit</li><li class="shared-post-delete" data-postid="' + postid + '" data-userid="' + userid + '">Delete</li><li class="post-privacy" data-postid="' + postid + '" data-userid="' + userid + '">privacy</li></ul></div>');
		})

		$(document).on('click', 'li.shared-post-edit', function() {
			var statusTextContainer = $(this).parents('.nf-1').siblings('.nf-2').find('.nf-2-text-span');
			var addId = $(statusTextContainer).attr('id', 'editPostPut');
			var getPostText1 = $(statusTextContainer).text();
			var getPostText = getPostText1.replace(/\s+/g, " ").trim();
			var postid = $(statusTextContainer).data('postid');
			var userid = $(statusTextContainer).data('userid');
			var getPostImg = $(this).parents('.nf-1').siblings('.nf-2').find('.nf-2-img');
			var thiss = $(this).parents('.nf-1').siblings('.nf-2').find('.nf-2-img');
			var profilepic = $(statusTextContainer).data('profilepic');
			$('.top-box-show').html('<div class="top-box profile-dialog-show" style="top: 12.5%;left: 22.5%;width: 55%;"><div class="edit-post-header align-middle " style="justify-content: space-between; padding: 10px; height: 20px; background-color: lightgray;font-size: 14px; font-weight:600; "><div class="edit-post-text">Edit Post</div><div class="shared-edit-post-close" style="padding: 5px; color: gray; cursor:pointer;">x</div></div><div class="edit-post-value" style="border-bottom: 1px solid lightgray;"><div class="status-med"><div class="status-prof"><div class="top-pic"><img src="' + profilepic + '" alt=""></div></div><div class="status-prof-textarea"><textarea data-autoresize rows="5" columns="5" placeholder="" name="textStatus" class="sharedEditStatus align-middle" style="font-family:sens-serif; font-weight:400; padding:5px;">' + getPostText + '</textarea></div></div></div><div class="edit-post-submit" style="position: absolute;right:0; bottom: 0; display: flex; align-items: center; margin: 10px;"><div class="status-privacy-wrap"><div class="status-privacy  "><div class="privacy-icon align-middle"><img src="assets/image/profile/publicIcon.JPG" alt=""></div><div class="privacy-text">Public</div><div class="privacy-downarrow-icon align-middle"><img src="assets/image/watchmore.JPEG" alt=""></div></div><div class="status-privacy-option"></div></div><div class="shared-edit-post-save" style="padding: 3px 15px; background-color: #4267bc;color: white; font-size: 14px; margin-left:5px; cursor:pointer;" data-postid="' + postid + '" data-userid="' + userid + '" data-tag="' + thiss + '">Save</div></div></div>')
		})

		$(document).on('click', '.shared-edit-post-save', function() {
			var postid = $(this).data('postid');
			var userid = $(this).data('userid');
			var editedText = $(this).parents('.edit-post-submit').siblings('.edit-post-value').find('.sharedEditStatus');
			var editedTextVal = $(editedText).val();
			$.post('http://localhost/mychat/core/ajax/sharedEditPost.php', {
				sharedPostid: postid,
				userid: userid,
				editedTextVal: editedTextVal
			}, function(data) {
				$('#editPostPut').html(data).removeAttr('id');
				$('.top-box-show').empty();
			})
		})

		$(document).on('click', '.shared-post-delete', function() {
			var postid = $(this).data('postid');
			var userid = $(this).data('userid');
			var postContainer = $(this).parents('.profile-timeline');
			var r = confirm("Do you want to delete the post?");

			if (r == true) {
				$.post('http://localhost/mychat/core/ajax/sharedEditPost.php', {
					deletePost: postid,
					userid: userid,
				}, function(data) {

					$(postContainer).empty();
				})
			}
		})
		//...........................Share end ......................

		//...........................Live Search ......................
		$(document).on('keyup', 'input#main-search', function() {
			var searchText = $(this).val();
			if (searchText == '') {
				$('.search-result').empty();
			} else {
				$.post('http://localhost/mychat/core/ajax/search.php', {
					searchText: searchText
				}, function(data) {
					if (data == '') {
						$('.search-result').html('<p>No user found</p>')
					} else {
						$('.search-result').html(data);
					}
				})
			}
		})
		//...........................Live Search end ......................

		//...........................Request ......................

		$(document).on('click', '.profile-add-friend', function() {
			$(this).parents('.profile-action').find('.profile-follow-button').removeClass().addClass('profile-unfollow-button').html('<img src="assets/image/rightsignGray.JPG" alt=""><div class="profile-activity-button-text">Following</div>');
			$(this).find('.edit-profile-button-text').text('Friend Request Sent');
			$(this).removeClass().addClass('profile-friend-sent');
			var userid = $(this).data('userid');
			var profileid = $(this).data('profileid');

			$.post('http://localhost/mychat/core/ajax/request.php', {
				request: profileid,
				userid: userid
			}, function(data) {

			})

			$.post('http://localhost/mychat/core/ajax/request.php', {
				follow: profileid,
				userid: userid
			}, function(data) {})
		})

		$(document).on('click', '.accept-req', function() {

			var userid = $(this).data('userid');
			var profileid = $(this).data('profileid');

			$(this).parent().empty().html('<div class="con-req align-middle"><img src="assets/image/rightsignGray.JPG" alt="">Friend</div><div class="request-unfriend" data-userid="' + userid + '" data-profileid="' + profileid + '">Unfriend</div>');

			$.post('http://localhost/mychat/core/ajax/request.php', {
				confirmRequest: profileid,
				userid: userid
			}, function(data) {})
		});

		$(document).on('click', '.profile-friend-sent', function() {
			$(this).parents('.profile-action').find('.profile-unfollow-button').removeClass().addClass('profile-unfollow-button').html('<img src="assets/image/followGray.JPG" alt=""><div class="profile-activity-button-text">Follow</div>');
			$(this).find('.edit-profile-button-text').text('Add Friend');
			$(this).removeClass().addClass('profile-add-friend');
			var userid = $(this).data('userid');
			var profileid = $(this).data('profileid');

			$.post('http://localhost/mychat/core/ajax/request.php', {
				cancelSentRequest: profileid,
				userid: userid
			}, function(data) {})

			$.post('http://localhost/mychat/core/ajax/request.php', {
				unfollow: profileid,
				userid: userid
			}, function(data) {})
		})
		$(document).on('click', '.request-cancel', function() {
			$(this).parents('.profile-friend-confirm').removeClass().addClass('profile-add-friend').html(' <img src="assets/image/friendRequestGray.JPG" alt=""><div class="edit-profile-button-text">Add Friend</div>');
			var userid = $(this).data('userid');
			var profileid = $(this).data('profileid');
			$.post('http://localhost/mychat/core/ajax/request.php', {
				cancelSentRequest: userid,
				userid: profileid
			}, function(data) {})
		})

		$(document).on('click', '.request-unfriend', function() {
			$(this).parents('.profile-friend-confirm').removeClass().addClass('profile-add-friend').html(' <img src="assets/image/friendRequestGray.JPG" alt=""><div class="edit-profile-button-text">Add Friend</div>');
			var userid = $(this).data('userid');
			var profileid = $(this).data('profileid');
			$.post('http://localhost/mychat/core/ajax/request.php', {
				unfriendRequest: profileid,
				userid: userid
			}, function(data) {})
		})

		$(document).on('mouseenter', '.edit-profile-confirm-button', function() {
			var reqCancel = $(this).find('.request-cancel');
			var reqUnfriend = $(this).find('.request-unfriend');
			$(reqCancel).show();
			$(reqUnfriend).show();
		})
		$(document).on('mouseleave', '.profile-friend-confirm', function() {
			var reqCancel = $(this).find('.request-cancel');
			var reqUnfriend = $(this).find('.request-unfriend');
			$(reqCancel).hide();
			$(reqUnfriend).hide();
		})
		//...........................Request end ......................


		//...........................follow  ......................
		$(document).on('click', '.profile-follow-button', function() {
			$(this).removeClass().addClass('profile-unfollow-button').html(' <img src="assets/image/rightsignGray.JPG" alt=""><div class="profile-activity-button-text">Following</div>');
			var userid = $(this).data('userid');
			var profileid = $(this).data('profileid');

			$.post('http://localhost/mychat/core/ajax/request.php', {
				follow: profileid,
				userid: userid
			}, function(data) {})
		})
		$(document).on('click', '.profile-unfollow-button', function() {
			$(this).removeClass().addClass('profile-follow-button').html(' <img src="assets/image/followGray.JPG" alt=""><div class="profile-activity-button-text">Follow</div>');
			var userid = $(this).data('userid');
			var profileid = $(this).data('profileid');

			$.post('http://localhost/mychat/core/ajax/request.php', {
				unfollow: profileid,
				userid: userid
			}, function(data) {})
		})

		//...........................follow end ......................






		$(document).mouseup(function(e) {
			var container = new Array();
			container.push($('.add-cov-opt'));
			container.push($('.profile-dialoge-show'));
			container.push($('.notification-list-wrap'));

			$.each(container, function(key, value) {
				if (!$(value).is(e.target) && $(value).has(e.target).length === 0) {
					$(value).hide();
				}
			})

		})

		$(document).mouseup(function(e) {
			var container = new Array();
			container.push($('.post-option-details-container'));
			container.push($('.top-box-show'));
			container.push($('.com-option-details-container'));
			container.push($('.reply-option-details-container'));
			container.push($('.shared-post-option-details-container'));

			$.each(container, function(key, value) {
				if (!$(value).is(e.target) && $(value).has(e.target).length === 0) {
					$(value).empty();
				}
			})

		})

		$(document).mouseup(function(e) {
			var container = new Array();
			container.push($('.profile-status-write'));

			$.each(container, function(key, value) {
				if (!$(value).is(e.target) && $(value).has(e.target).length === 0) {
					$('.status-share-button-wrap').hide('0.2');
				}
			})


		})



		//			-------------------------------------------------------		read more---------------------------------

		//		$(document).ready(function() {
		var maxLength = 800;
		$(".nf-2-text").each(function() {
			var myStr = $(this).text();
			if ($.trim(myStr).length > maxLength) {
				var newStr = myStr.substring(0, maxLength);
				var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
				$(this).empty().html(newStr);
				$(this).append(' <a href="javascript:void(0);" class="read-more">read more...</a>');
				$(this).append('<span class="more-text">' + removedStr + '</span>');
			}
		})
		$(".read-more").click(function() {
			$(this).siblings(".more-text").contents().unwrap();
			$(this).remove();
		})
		//		});


	})

</script>

<!--
</body>

</html>
-->
