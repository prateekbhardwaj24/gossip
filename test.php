<?php
 include("connection.php");
 
  $insert = "INSERT INTO profile (id, user_email) SELECT user_id, user_email FROM my_users1";
  $query = mysqli_query($con, $insert);

if($query){
    echo "<script>alert('data insert')</script>";
}
else{
    echo "<script>alert('data not insert')</script>";
}

?>