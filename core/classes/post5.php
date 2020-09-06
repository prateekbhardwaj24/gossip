<?php
//include 'include/header.php';
//include '././connection.php';
class Post extends Users {

    function __construct($pdo){
$this->pdo = $pdo;
    }

    public function homePosts($user_id, $profileId, $num){
        $userdata = $this->userData($user_id);

//        $stmt= $this->pdo->prepare("SELECT * FROM post p LEFT JOIN my_users1 u ON p.userId = u.user_id LEFT JOIN profile pr ON pr.userId = p.userId WHERE p.userId =:user_id ");
//        $stmt= $this->pdo->prepare("SELECT * FROM post p LEFT JOIN friends fr ON fr.user_one = :user_id OR fr.user_two = :user_id LEFT JOIN profile pr ON pr.userId = p.userId WHERE p.userId = :user_id");
        $stmt= $this->pdo->prepare("SELECT * FROM post ORDER BY postedOn DESC");
//        $stmt= $this->pdo->prepare("SELECT * FROM post");

//        $stmt->bindParam(":user_id", $profileId, PDO::PARAM_INT);
//        $stmt->bindParam(":num", $num, PDO::PARAM_INT);
        $stmt->execute();
        $posts=$stmt->fetchAll(PDO::FETCH_OBJ);

        foreach($posts as $post){
//            $blockedUser = $this->block($post->postBy, $user_id);
//            if(!empty($blockedUser)){}else{
            
                $user_id1 = $_SESSION['user_id'];
               $con = mysqli_connect("localhost", "root", "", "mychat"); 
               $hide_block1 = "SELECT * FROM block WHERE (blockerID= '$user_id1' AND blockedID= '$post->postBy') OR (blockerID= '$post->postBy' AND blockedID= '$user_id1')";
               $blockedUser1 = mysqli_query($con, $hide_block1);

             if(!empty($fetch_hide1 = mysqli_fetch_array($blockedUser1))){}
                        
                        else{
	        $user_id = $post->userId;
            $main_react = $this->main_react($user_id1, $post->post_id);
            $react_max_show = $this->react_max_show($post->post_id);
            $main_react_count = $this-> main_react_count($post->post_id);

            $commentDetails = $this->commentFetch($post->post_id);
            $totalCommentCount = $this->totalCommentCount($post->post_id);
            $totalShareCount = $this->totalShareCount($post->post_id);
            if(empty($post->shareId)){}else{
                $shareDetails = $this->shareFetch($post->shareId, $post->postBy);
            }
            ?>

<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/js/all.min.js">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .postImage{
             max-height:399px; 
             cursor:pointer;
        }
    @media (max-width: 570px) { 
        .main-box{
            padding-left: 0px;
            padding-right: 0px;
            margin-left: 0px;
            margin-right: 0px;
             margin-bottom: 0px;
        }
        .profile-timeline{
            margin-bottom: 0px;
        }
        .postImage{
            max-height: 300px;
            cursor: pointer;
        }
        }
    </style>
</head>

<body>

    <?php 
    include "connection.php";
             
            $select = "select * from profile where userId= '$user_id'";
            $query = mysqli_query($con,$select);
            $row = mysqli_fetch_array($query);
            
            $profile_pic = $row['profilePic'];
            
    
    ?>

    <div class="container-fluid main-box">
        <div class="row main-box" style="display:flex; justify-content:center;">
<!--            <div class="col-1"></div>-->
            <div class="col-xl-8 col-md-10 col-sm-12 main-box">
                <div class="profile-timeline">
                    <div class="news-feed-comp">
                        <div class="news-feed-text" id="<?php echo $post->post_id; ?>">
                            <div class="nf-1">
                                <div class="nf-1-left">
                                    <div class="nf-pro-pic">

                                        <img src="<?php echo $profile_pic ?>" class="pro-pic" alt="">
                                    </div>
                                    <div class="nf-pro-name-time">
                                        <div class="nf-pro-name">

                                            <?php echo ''.$post->user_name.''; ?>

                                        </div>
                                        <div class="nf-pro-time-privacy">
                                            <div class="nf-pro-time">
                                                <?php echo $this->timeAgo($post->postedOn); ?>
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
                                <div class="nf-2-text" data-postid="<?php echo $post->post_id; ?>" data-userid="<?php echo $user_id ?>" >
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
                                                            <?php echo $this->timeAgo($share->postedOn); ?>
                                                        </div>
                                                        <div class="nf-pro-privacy">
                                                            <img src="../../facebook/assets/image/privacy.JPG" alt="">
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
                                    echo '  <div class="post-img-box" data-postImgID="'.$share->id.'" style="max-height:500px; width:100%;
    overflow: hidden;"><img src="'.BASE_URL.$shareImgJson[''.$shareCount++.'']->imageName.'" class="postImage" alt="" style="width: 100%; max-height:450px;cursor:pointer;"></div>';
                                }
                ?>
                                            </div>
                                        </div>

                                    </div>

                                    <?php

                }

            } ?>
                                </div>
                                <div class="nf-2-img" data-postid="<?php echo $post->post_id; ?>" data-userid="<?php echo $user_id ?>" style="  display:flex; justify-content:center;">
                                    <?php $imgJson = json_decode($post->postImage);
                            $count = 0;
                                for($i = 0; $i < count((array)$imgJson); $i++) {
                                    echo '  <div class="post-img-box" data-postImgID="'.$post->userId.'" style="max-height: 400px;
    overflow: hidden; display:flex; flex-direction:column;"><img src="'.BASE_URL.$imgJson[''.$count++.'']->imageName.'" class="postImage" data-userid="'.$user_id.'" data-postid="'.$post->post_id.'" data-profileid="'.$profileId.'" alt=""><marquee>comment on this post</marquee></div>';
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
echo '<img class = "'.$react_max->reactType.'-max-show" src="assets/image/react/'.$react_max->reactType.'.png" alt="" style="height:15px; width:15px; margin-right:2px; cursor:pointer;">';
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
                                            <img src="assets/image/react/<?php echo $main_react->reactType; ?>.png" alt="" class="reactIconSize" style="margin-top:0;">
                                            <div class="like-action-text"><span class="<?php echo $main_react->reactType;  ?>-color"><?php echo $main_react->reactType; ?></span></div>
                                        </div>



                                        <?php
        } ?>
                                    </div>

                                </div>



                            </div>

                        </div>
                        <div class="news-feed-photo"></div>
                    </div>
                </div>
            </div>
<!--            			<div class="col-1"></div>-->
        </div>
    </div>
    <?php
            }
        
            }
    }
    public function posts($user_id, $profileId, $num){
        $userdata = $this->userData($user_id);

        $stmt= $this->pdo->prepare("SELECT * FROM my_users1 LEFT JOIN profile ON my_users1.user_id = profile.userId LEFT JOIN post ON post.userId = my_users1.user_id WHERE post.userId = :user_id ORDER BY post.postedOn DESC LIMIT :num");

        $stmt->bindParam(":user_id", $profileId, PDO::PARAM_INT);
        $stmt->bindParam(":num", $num, PDO::PARAM_INT);
        $stmt->execute();
        $posts=$stmt->fetchAll(PDO::FETCH_OBJ);

        foreach($posts as $post){

            $main_react = $this->main_react($user_id, $post->post_id);
            $react_max_show = $this->react_max_show($post->post_id);
            $main_react_count = $this-> main_react_count($post->post_id);

            $commentDetails = $this->commentFetch($post->post_id);
            $totalCommentCount = $this->totalCommentCount($post->post_id);
            $totalShareCount = $this->totalShareCount($post->post_id);
            if(empty($post->shareId)){}else{
                $shareDetails = $this->shareFetch($post->shareId, $post->postBy);
            }
            ?>
    <div class="container-fluid">
        <div class="row" style="margin-bottom: 25px;">
            <div class="col-sm-4 sexy-boy">
                <div class=" profile-card">
                    <div class="image">
                        <img src="<?php echo $post->profilePic; ?>" alt="parasjha" style="width: 80px; height: 80px; border-radius: 50%;">
                    </div>
                    <div class="bio mb-2">
                        <h3 style="border: none; background: none;"><?php echo ''.$post->user_name.''; ?></h3>
                        <p><?php echo $post->professional; ?></p>
                    </div>
                    <div class="history mb-3 p-2 d-flex" style="justify-content: space-between;">
                        <div class="d-flex flex-column" style="justify-content: center; align-items: center;">
                            <div>
                                <a href="#" class="about p-2 mr-2"><i class="fa fa-heart"></i></a></div>
                            <p class="mt-1 mb-0">2</p>

                            <p>Buddies</p>

                        </div>
                        <div class="d-flex flex-column" style="justify-content: center; align-items: center;">

                            <div>
                                <a href="#" class="about p-2 mr-2"><i class="fa fa-thumbs-up"></i></a></div>
                            <p class="mt-1 mb-0">2</p>
                            <p>Likes</p>
                        </div>
                        <div class="d-flex flex-column" style="justify-content: center; align-items: center;">

                            <div>
                                <a href="#" class="about p-2 ml-sm-2"><i class="fa fa-star"></i></a></div>
                            <p class="mt-1 mb-0">2</p>
                            <p>Highest Likes</p>
                        </div>

                    </div>

                </div>


            </div>
            <div class="col-sm-8">
                <div class="profile-timeline">
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
                                                <?php echo $this->timeAgo($post->postedOn); ?>
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
                                                            <?php echo $this->timeAgo($share->postedOn); ?>
                                                        </div>
                                                        <div class="nf-pro-privacy">
                                                            <img src="../../facebook/assets/image/privacy.JPG" alt="">
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
                                for($i = 0; $i <count((array)$imgJson); $i++) {
                                    echo '  <div class="post-img-box" data-postImgID="'.$post->id.'" style="max-height: 400px;
    overflow: hidden; display:flex; justify-content:center;"><img src="'.BASE_URL.$imgJson[''.$count++.'']->imageName.'" class="postImage" data-userid="'.$user_id.'" data-postid="'.$post->post_id.'" data-profileid="'.$profileId.'" alt="" style=" width:auto; max-height:400px;cursor:pointer;"></div>';
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
echo '<img class = "'.$react_max->reactType.'-max-show" src="assets/image/react/'.$react_max->reactType.'.png" alt="" style="height:15px; width:15px; margin-right:2px; cursor:pointer;">';
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
                                            <img src="assets/image/react/<?php echo $main_react->reactType; ?>.png" alt="" class="reactIconSize" style="margin-top:0;">
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


                            </div>

                        </div>
                        <div class="news-feed-photo"></div>
                    </div>
                </div>
            </div>
            <!--			<div class="col-sm-2"></div>-->
        </div>
    </div>
</body>

</html>
<?php
        }
    }
    public function postUpd($user_id, $post_id, $editText){
        $stmt= $this->pdo->prepare('UPDATE post SET post = :editText WHERE post_id =:post_id AND userId = :user_id');
        $stmt->bindParam(":post_id", $post_id, PDO::PARAM_INT);
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->bindParam(":editText", $editText, PDO::PARAM_INT);
        $y = $stmt->execute();
	    if($y){
		    
	    
	    echo '<script>alert("post uploaded");';
	    }
    }
    public function main_react($userid, $postid){
        $stmt = $this->pdo->prepare("SELECT * FROM `react` WHERE `reactBy` = :user_id AND `reactOn` = :postid AND `reactCommentOn`= '0' AND `reactReplyOn` = '0' ");
        $stmt->bindParam(":user_id", $userid, PDO::PARAM_INT);
        $stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function react_max_show($postid){
        $stmt = $this->pdo->prepare("SELECT reactType, count(*) as maxreact from react WHERE reactOn = :postid AND reactCommentOn = '0' AND reactReplyOn = '0' GROUP BY reactType LIMIT 3");
        $stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function main_react_count($postid){
        $stmt = $this->pdo->prepare("SELECT count(*) as maxreact from react WHERE reactOn = :postid AND reactCommentOn = '0' AND reactReplyOn = '0'");
        $stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function commentFetch($postid){
        $stmt = $this->pdo->prepare("SELECT * FROM comments INNER JOIN profile ON comments.commentBy = profile.userId WHERE comments.commentOn = :postid AND comments.commentReplyID = '0' LIMIT 10");
        $stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
     public function totalCommentCount($postid){
        $stmt = $this->pdo->prepare("SELECT count(*) as totalComment FROM comments WHERE comments.commentOn =:postid");
        $stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function com_react_max_show($postid, $commentid){
        $stmt = $this->pdo->prepare("SELECT reactType, count(*) as maxreact FROM react WHERE reactOn = :postid AND reactCommentOn = :commentID AND reactReplyOn = '0' GROUP BY reactType LIMIT 3");
        $stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
        $stmt->bindParam(":commentID", $commentid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function com_main_react_count($postid, $commentid){
        $stmt = $this->pdo->prepare("SELECT count(*) as maxreact FROM react WHERE reactOn = :postid AND reactCommentOn = :commentID AND reactReplyOn = '0' ");
        $stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
        $stmt->bindParam(":commentID", $commentid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function commentReactCheck($userid, $postid, $commentid){
        $stmt = $this->pdo->prepare("SELECT * FROM react WHERE reactBy = :userid AND reactOn = :postid AND reactCommentOn = :commentid and reactReplyOn = '0' ");
        $stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
        $stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
        $stmt->bindParam(":commentid", $commentid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function lastCommentFetch($commentid){
        $stmt = $this->pdo->prepare("SELECT * FROM comments INNER JOIN profile ON comments.sender = profile.userId WHERE comments.commentID = :commentid");
        $stmt->bindParam(":commentid", $commentid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
public function commentUpd($userid, $postid, $editedTextVal, $commentid){
        $stmt = $this->pdo->prepare("UPDATE comments SET comment = :editedText WHERE commentID =:commentid AND commentBy = :userid AND commentOn = :postid");
        $stmt->bindParam(":commentid", $commentid, PDO::PARAM_INT);
        $stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
        $stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
        $stmt->bindParam(":editedText", $editedTextVal, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function replyFetch($postid, $commentid){
        $stmt = $this->pdo->prepare("SELECT * FROM comments INNER JOIN profile ON comments.commentBy = profile.userId WHERE comments.commentOn = :postid and comments.commentReplyID =:commentid LIMIT 5");

        $stmt->bindParam(":commentid", $commentid, PDO::PARAM_INT);
        $stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function reply_main_react_count($postid, $commentid, $replyid){
        $stmt = $this->pdo->prepare("SELECT count(*) as maxreact FROM react WHERE reactOn = :postid AND reactCommentOn = :commentid AND reactReplyOn = :replyid");

        $stmt->bindParam(":commentid", $commentid, PDO::PARAM_INT);
        $stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
        $stmt->bindParam(":replyid", $replyid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function reply_react_max_show($postid, $commentid, $replyid){
        $stmt = $this->pdo->prepare("SELECT reactType, count(*) as maxreact FROM react WHERE reactOn=:postid AND reactCommentOn=:commentid AND reactReplyOn = :replyid GROUP BY reactType LIMIT 3");
        $stmt->bindParam(":commentid", $commentid, PDO::PARAM_INT);
        $stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
        $stmt->bindParam(":replyid", $replyid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function replyReactCheck($user_id, $postid, $commentid, $replyid){
        $stmt = $this->pdo->prepare("SELECT * FROM react WHERE reactBy = :userid AND reactOn=:postid AND reactCommentOn = :commentid AND reactReplyOn= :replyid");

        $stmt->bindParam(":userid", $user_id, PDO::PARAM_INT);
        $stmt->bindParam(":commentid", $commentid, PDO::PARAM_INT);
        $stmt->bindParam(":postid", $postid, PDO::PARAM_INT);
        $stmt->bindParam(":replyid", $replyid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function lastReplyFetch($replyid){
        $stmt = $this->pdo->prepare("SELECT * FROM comments INNER JOIN profile ON comments.commentBy = profile.userId WHERE comments.commentID = :replyid");

        $stmt->bindParam(":replyid", $replyid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function replyUpd($userid, $postid, $editedTextVal, $replyid){
        $stmt = $this->pdo->prepare("UPDATE comments SET comment = :editText WHERE commentBy = :user_id AND commentOn = :post_id AND commentID = :replyid ");

        $stmt->bindParam(":replyid", $replyid, PDO::PARAM_INT);
        $stmt->bindParam(":editText", $editedTextVal, PDO::PARAM_INT);
        $stmt->bindParam(":post_id", $postid, PDO::PARAM_INT);
        $stmt->bindParam(":user_id", $userid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
   public function totalShareCount($postid){
        $stmt = $this->pdo->prepare("SELECT count(*) as totalShare FROM post WHERE post.shareId = :post_id");

        $stmt->bindParam(":post_id", $postid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function shareFetch($postid, $profileId){
        $stmt = $this->pdo->prepare("SELECT my_users1.*, post.*, profile.* FROM my_users1, post, profile WHERE my_users1.user_id = :user_id AND post.post_id = :post_id AND profile.userId = :user_id");

        $stmt->bindParam(":post_id", $postid, PDO::PARAM_INT);
        $stmt->bindParam(":user_id", $profileId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function sharedPostUpd($userid, $postid, $editText){
        $stmt = $this->pdo->prepare("UPDATE post SET shareText = :editText WHERE post_id =:post_id AND userId = :user_id");

        $stmt->bindParam(":post_id", $postid, PDO::PARAM_INT);
        $stmt->bindParam(":user_id", $userid, PDO::PARAM_INT);
        $stmt->bindParam(":editText", $editText, PDO::PARAM_INT);
        $stmt->execute();
    }
    // public function searchText($search){
    //     $stmt = $this->pdo->prepare("SELECT * FROM my_users1 LEFT JOIN profile ON my_users1.user_id = profile.userId WHERE  my_users1.userLInk LIKE ? ");

    //     $stmt->bindValue(1, $search.'%', PDO::PARAM_STR);
    //     $stmt->execute();
    //     return $stmt->fetchAll(PDO::FETCH_OBJ);
    // }
  public function requestCheck($userid, $profileId){
        $stmt = $this->pdo->prepare("SELECT * FROM request WHERE reqtReceiver = :profileid and ReqtSender = :userid ");

        $stmt->bindParam(":profileid", $profileId, PDO::PARAM_INT);
        $stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function requestConf($profileid, $userid){
        $stmt = $this->pdo->prepare("SELECT * FROM request WHERE reqtReceiver = :userid AND reqtSender =:profileid");

        $stmt->bindParam(":profileid", $profileid, PDO::PARAM_INT);
        $stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function updateConfirmReq($profileid, $userid){
        $stmt = $this->pdo->prepare("UPDATE request SET reqStatus = 1 WHERE reqtReceiver = :userid AND reqtSender = :profileid");
        $stmt->bindParam(":profileid", $profileid, PDO::PARAM_INT);
        $stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function followCheck($profileId, $userid){
        $stmt = $this->pdo->prepare("SELECT * FROM follow WHERE (sender = :profileid AND receiver =:userid) OR (sender = :userid AND receiver = :profileid)");

        $stmt->bindParam(":profileid", $profileId, PDO::PARAM_INT);
        $stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
public function aboutOverview($aboutData, $userid, $profileid, $heading){
$userdata = $this->userdata($profileid);
    echo ($userid != $profileid) ? '<span class="about-success">'.$userdata->$aboutData.'</span><br>' : (($userdata->$aboutData == '') ? '<div class="add-'.$aboutData.' align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><div class="plus-square">+</div><div class="'.$aboutData.'" style="font-size:15px;">'.$heading.'</div></div> ' : '<div class="add-'.$aboutData.' align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style=" margin: 0 0 20px 0"> <span class="about-success">'.$userdata->$aboutData.'</span></div><br>');
}
    public function aboutOverviewAlt($aboutData, $userid, $profileid, $heading){
$userdata = $this->userdata($profileid);
    echo ($userid != $profileid) ? '<span class="about-success">'.$userdata->$aboutData.'</span><br>' : (($userdata->$aboutData == '') ? '<div class="add-'.$aboutData.' align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><div class="contact-plus" style="margin-right:10px;">+</div><div class="'.$aboutData.'" style="font-size:15px;">'.$heading.'</div></div> ' : '<div class="add-'.$aboutData.' align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style=" margin: 0 0 20px 0"> <span class="about-success">'.$userdata->$aboutData.'</span></div><br>');
}


       public function lastPersonWithAllUserMSG($userid){
        $stmt = $this->pdo->prepare("SELECT * FROM messages LEFT JOIN profile ON (SELECT IF(messages.messageFrom = :userid, messages.messageTo, messages.messageFrom)) = profile.userId LEFT JOIN my_users1 ON profile.userId = my_users1.user_id WHERE (messages.messageTo = :userid OR messages.messageFrom = :userid) AND messages.messageID IN (SELECT MAX(messages.messageID) FROM messages GROUP BY messages.messageTo, messages.messageFrom ORDER BY messages.messageID DESC) GROUP BY profile.id ORDER BY messages.messageOn DESC;");
        $stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


//    public function lastPersonMsg($userid){
//         $stmt = $this->pdo->prepare("SELECT * FROM profile LEFT JOIN messages ON profile.userId = (SELECT IF(messages.messageTo =:userid, messages.messageFrom, messages.messageTo)) WHERE (messages.messageFrom = :userid OR messages.messageTo = :userid) ORDER BY messages.messageOn DESC LIMIT 0, 1");
//         $stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
//         $stmt->execute();
//         return $stmt->fetch(PDO::FETCH_OBJ);
//     }
//        public function messageData($userid, $lastpersonid){
//         $stmt = $this->pdo->prepare("SELECT * FROM messages LEFT JOIN profile ON profile.userId = messages.messageFrom WHERE (messageTo = :userid and messageFrom=:otherid) OR (messageTo = :otherid and messageFrom=:userid) ORDER BY messageOn ASC");
//         $stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
//         $stmt->bindParam(":otherid", $lastpersonid, PDO::PARAM_INT);
//         $stmt->execute();
//         return $stmt->fetchAll(PDO::FETCH_OBJ);
//     }
//      public function searchMsgUser($msgUser, $userid){
//         $stmt = $this->pdo->prepare("SELECT * FROM my_users1 LEFT JOIN profile ON my_users1.user_id = profile.userId WHERE my_users1.user_id != ? AND my_users1.userLink LIKE ? ");
//         $stmt->bindValue(1, $userid, PDO::PARAM_INT);
//         $stmt->bindValue(2,  $msgUser.'%', PDO::PARAM_INT);
//          $stmt->execute();
//         return $stmt->fetchAll(PDO::FETCH_OBJ);
//     }
    //  public function notification($userid){
    //     $stmt = $this->pdo->prepare("SELECT * FROM notification LEFT JOIN profile ON notification.notificationFrom = profile.userId LEFT JOIN my_users1 ON profile.userId = my_users1.user_id WHERE notification.notificationFor = :userid ORDER BY notification.notificationOn DESC; ");
    //     $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
    //      $stmt->execute();
    //     return $stmt->fetchAll(PDO::FETCH_OBJ);
    // }

    // public function notificationCount($userid){
    //     $stmt = $this->pdo->prepare("SELECT * FROM notification LEFT JOIN profile ON notification.notificationFrom = profile.userId LEFT JOIN my_users1 ON profile.userId = my_users1.user_id WHERE notification.notificationFor = :userid AND notification.notificationCount = '0' AND notification.type != 'request' AND notification.type != 'message' ORDER BY notification.notificationOn DESC; ");
    //     $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
    //      $stmt->execute();
    //     return $stmt->fetchAll(PDO::FETCH_OBJ);
    // }
    // public function requestNotificationCount($userid){
    //     $stmt = $this->pdo->prepare("SELECT * FROM notification LEFT JOIN profile ON (SELECT IF(notification.notificationFrom = :userid, notification.notificationFor, notification.notificationFrom)) = profile.userId LEFT JOIN my_users1 ON profile.userId = my_users1.user_id WHERE (notification.notificationFrom =:userid AND notification.type = 'request' AND notification.notificationCount = '0' AND notification.friendStatus ='1') OR ( notification.type = 'request' AND notification.notificationCount = '0' AND notification.notificationFor = :userid)  ORDER BY notification.notificationOn DESC;");
    //     $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
    //      $stmt->execute();
    //     return $stmt->fetchAll(PDO::FETCH_OBJ);
    // }

    // public function messageNotificationCount($userid){
    //     $stmt = $this->pdo->prepare("SELECT * FROM notification WHERE notification.type = 'message' AND notificationCount = '0' AND notificationFor = :userid ");
    //     $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
    //      $stmt->execute();
    //     return $stmt->fetchAll(PDO::FETCH_OBJ);
    // }
    // public function notificationCountReset($userid){
    //     $stmt = $this->pdo->prepare("UPDATE notification SET notificationCount = '1' WHERE notificationFor = :userid AND notificationCount = '0' ");
    //     $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
    //      $stmt->execute();
    //     return $stmt->fetchAll(PDO::FETCH_OBJ);
    // }

    // public function notificationCountReset2($userid, $notiType){
    //     $stmt = $this->pdo->prepare("UPDATE notification SET notificationCount = '1' WHERE notificationFor = :userid AND notificationCount = '0' AND type = :type ");
    //     $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
    //     $stmt->bindValue(':type', $notiType, PDO::PARAM_INT);
    //      $stmt->execute();
    //     return $stmt->fetchAll(PDO::FETCH_OBJ);
    // }

//   public function notificationStatusUpdate($userid, $notificationId){
//         $stmt = $this->pdo->prepare("UPDATE notification SET status = '1' WHERE notificationFor = :userid AND ID = :notificationid AND status = '0' ");
//         $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
//         $stmt->bindValue(':notificationid', $notificationId, PDO::PARAM_INT);
//          $stmt->execute();
//         return $stmt->fetchAll(PDO::FETCH_OBJ);
//     }
//     public function confirmRequestUpdate($profileid, $userid){
//         $stmt = $this->pdo->prepare("UPDATE notification SET friendStatus = '1', notificationCount = '0' WHERE notificationFrom = :profileid AND notificationFor = :userid   ");
//         $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
//         $stmt->bindValue(':profileid', $profileid, PDO::PARAM_INT);
//          $stmt->execute();
//         return $stmt->fetchAll(PDO::FETCH_OBJ);
//     }
    public function postDetails($postid){
        $stmt = $this->pdo->prepare("SELECT * FROM my_users1 LEFT JOIN profile ON my_users1.user_id = profile.userId LEFT JOIN post ON post.userId = my_users1.user_id WHERE post.post_id = :postid  ");
        $stmt->bindValue(':postid', $postid, PDO::PARAM_INT);
         $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
//    public function requestData($profileId){
//         $stmt = $this->pdo->prepare(" SELECT count(*) as reqCount FROM request WHERE reqStatus = 0 AND reqtReceiver = :profileid  ");
//         $stmt->bindValue(':profileid', $profileId, PDO::PARAM_INT);
//          $stmt->execute();
//         return $stmt->fetch(PDO::FETCH_OBJ);
//     }

    public function friendsdata($profileid){
    $stmt = $this->pdo->prepare("SELECT * FROM request LEFT JOIN profile ON profile.userId = request.reqtReceiver LEFT JOIN my_users1 ON my_users1.user_id = request.reqtReceiver WHERE request.reqtSender = :profileid AND request.reqStatus = '1'
    UNION
    SELECT * FROM request LEFT JOIN profile ON profile.userId = request.reqtSender LEFT JOIN my_users1 ON my_users1.user_id = request.reqtSender WHERE request.reqtReceiver = :profileid AND request.reqStatus = '1'
    ");
            $stmt->bindParam(":profileid", $profileid, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function followersdata($profileid){
    $stmt = $this->pdo->prepare("SELECT * FROM follow LEFT JOIN profile ON profile.userId = follow.sender LEFT JOIN my_users1 ON my_users1.user_id = follow.sender WHERE follow.receiver = :profileid");
            $stmt->bindParam(":profileid", $profileid, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function yourPhoto($profileId){
    $stmt = $this->pdo->prepare("SELECT * FROM `post` WHERE postImage != '' and postBy = :profileid");
            $stmt->bindParam(":profileid", $profileId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

//     public function block($profileId, $userid){
//     $stmt = $this->pdo->prepare("SELECT * FROM block WHERE (blockerID = :userid AND blockedID = :profileid) OR (blockerID = :profileid AND blockedID = :userid) ");
//             $stmt->bindParam(":profileid", $profileId, PDO::PARAM_INT);
//             $stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
//             $stmt->execute();
//             return $stmt->fetch(PDO::FETCH_OBJ);
//     }


}

?>
