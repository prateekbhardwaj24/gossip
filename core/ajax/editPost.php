<?php
include '../load.php';
include '../../connect/login.php';
require '../../connect/DB.php';

$user_id = login::isLoggedIn();

if(isset($_POST['editedTextVal'])){

    $editedTextVal = $_POST['editedTextVal'];
    $userid=$_POST['userid'];
    $postid=$_POST['postid'];
    $loadFromPost->postUpd($userid, $postid, $editedTextVal);

    echo $editedTextVal;

}
if(isset($_POST['deletePost'])){
    $postid= $_POST['deletePost'];
    $userid=$_POST['userid'];
    $loadFromUser->delete('post', array('post_id'=>$postid, 'userId'=>$userid));
}


$deleteTime = DB::query("DELETE FROM post WHERE postedOn < :deleteTime", array(':deleteTime'=>DATE_SUB(NOW(), INTERVAL 1 minute)));
if ($deleteTime) {
    ?>
<script>alert('your post is deleted');</script>
    <?php
}



?>
