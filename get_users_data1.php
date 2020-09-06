<?php 


$con = mysqli_connect("localhost", "root", "", "mychat");

$user = $_SESSION['user_email'];
$get_user = "select * from my_users1 where user_email = '$user'";
$run_user = mysqli_query($con, $get_user);
$row = mysqli_fetch_array($run_user);

$user_id = $row['user_id'];
$user_name = $row['user_name'];


if(isset($_GET['user_name'])){
 global $con;

 $get_username = $_GET['user_name'];
 $get_user = "select * from my_users1 where user_name = '$get_username'";

 $run_user = mysqli_query($con, $get_user);
 $row_user = mysqli_fetch_array($run_user);

 $username = $row_user['user_name'];
 $user_profile_image = $row_user['user_profile'];
}

$total_messages = "select * from user_chating1 where (sender='$user_name') OR (sender = '$username')";
 $run_messages = mysqli_query($con, $total_messages);
 $total = mysqli_num_rows($run_messages);


$sel_msg ="select * from user_chating1 where (sender='$user_name') OR (sender ='$username') ORDER by 1 ASC";
$run_msg = mysqli_query($con, $sel_msg);

$row = mysqli_fetch_array($run_msg);

$msg_content = $row['content'];
$status = $row['status'];
                    


$user = "select * from my_users1";

$run_user = mysqli_query($con, $user);

while($row_user= mysqli_fetch_array($run_user)){
    $user_id = $row_user['user_id'];
    $user_name = $row_user['user_name'];
    $user_profile = $row_user['user_profile'];
    $login = $row_user['log_in'];
    echo"
    
    <li>
    <div class='container-fluid chat'>
         <div class='chat-left-img'>
        <img src= '$user_profile'>
        </div>
        <div class='chat-left-detail'>
        <p><a href='test1.php?user_name=$user_name'>$user_name</a></p>";
    if($status == 'unread'){
        echo"<p>$msg_content<span style='color: green float: right;'>$total</span></p>";
    }
    
        
    
    if($login== 'online'){
        echo"<span><i class='fa fa-circle' aria-hidden='true'></i>Online</span>";
    }
    else {
        echo"<span><i class='fa fa-circle-o' aria-hidden='true'></i>Offline</span>";
    }
    "
        </div>
      </div>
    </li>
    
      ";  
}



?>
