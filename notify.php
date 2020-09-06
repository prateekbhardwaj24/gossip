<?php
require 'connect/DB.php';
require 'core/load.php';




$deleteTime = DB::query("DELETE FROM post WHERE postedOn < :deleteTime", array(':deleteTime'=>DATE_SUB(NOW(), INTERVAL 24 HOUR)));
if ($deleteTime) {
    ?>
<script>alert('your post is deleted');</script>
    <?php
}



?>