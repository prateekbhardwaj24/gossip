<!DOCTYPE html>
<?php
  session_start();
//include 'header1.php';

if(!isset($_SESSION['user_email'])){
    header('location:login.php');
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>MyHome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="chat.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.4/holder.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

</head>

<body>

    <div class="container-fluid main-section">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12 left-sidebar">
                <div class="input-group searchbox">
                    <div class="input-group-btn">
                        <center><a href="find_friend.php"><button class="btn btn-default search-icon" name="search_box" type="submit">Add new friends</button></a></center>
                    </div>
                </div>
                <div class="left-chat">
                    <ul>
                        <?php
                    include("get_users_data1.php");
                    ?>
                    </ul>
                </div>
            </div>
            <div class="col-md-9 col-sm-9  right-sidebar">
                <div class="row">

                    <?php
                     
                     $user = $_SESSION['user_email'];
                     $get_user = "select * from my_users1 where user_email = '$user'";
                     $run_user = mysqli_query($con, $get_user);
                     $row = mysqli_fetch_array($run_user);
                     
                     $user_id = $row['user_id'];
                     $user_name = $row['user_name'];
                 ?>

                    <?php
                     if(isset($_GET['user_name'])){
                         global $con;
                         
                         $get_username = $_GET['user_name'];
                         $get_user = "select * from my_users1 where user_name = '$get_username'";
                         
                         $run_user = mysqli_query($con, $get_user);
                         $row_user = mysqli_fetch_array($run_user);
                         
                         $username = $row_user['user_name'];
                         $user_profile_image = $row_user['user_profile'];
                     }
                     
                     $total_messages = "select * from user_chating1 where (sender='$user_name' AND receiver= '$username') OR (receiver= '$user_name' AND sender = '$username')";
                     $run_messages = mysqli_query($con, $total_messages);
                     $total = mysqli_num_rows($run_messages);
                 ?>
                    <div class="col-md-12 right-header">
                        <div class="right-header-img">
                            <img src="<?php echo"$user_profile_image"; ?>">
                        </div>
                        <div class="right-header-detail">
                            <form method="post" class="form-control">
                                <p><?php echo "$username"; ?></p>
                                <span><?php echo $total; ?> messages</span>&nbsp &nbsp
                                <button class="btn" name="logout">Logout</button>
                            </form>
                            <?php
                                if(isset($_POST['logout'])){
                                    $update_msg = mysqli_query($con, "UPDATE my_users1 SET log_in='offline' WHERE user_name= '$user_name'");
                                    echo"<script>window.open('logout.php', '_self')</script>";
                                    exit();
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div id="scrolling_to_bottom" class="col-md-12 right-header-contentchat">
                        <?php
                    $update_msg = mysqli_query($con, "UPDATE user_chating1 SET status='read' WHERE sender='$username' AND receiver = '$user_name'");
                        
                    $sel_msg ="select * from user_chating1 where (sender='$user_name' AND receiver='$username') OR (receiver='$user_name' AND sender ='$username') ORDER by 1 ASC";
                    $run_msg = mysqli_query($con, $sel_msg);
                    
                    while ($row = mysqli_fetch_array($run_msg)){
                        
                        $sender_username = $row['sender'];
                        $receiver_username = $row['receiver'];
                        $msg_content = $row['content'];
                        $msg_date = $row['date'];
                    
                    ?>
                        <ul>
                            <?php
                                
                                if($user_name == $sender_username AND $username == $receiver_username){
                                    echo"
                                        <li>
                                            <div class='rightside-right-chat'>
                                            <span> $user_name <small>$msg_date</small></span><br><br>
                                            <p>$msg_content</p>
                                            </div>
                                        </li>
                                        ";
                         }
                         else if($user_name == $receiver_username AND $username == $sender_username){
                                echo"
                                <li>
                                    <div class='rightside-left-chat'>
                                        <span> $username <small>$msg_date</small></span><br><br>
                                        <p>$msg_content</p>
                                    </div>
                                </li>
                                ";
                            }
                            
                        ?>

                        </ul>
                        <?php
                            }
                        ?>

                    </div>


                </div>

                <div class="row">
                    <div class="col-md-12 right-chat-textbox">
                        <form method="post" class="form-control" id="myform">
                            <input autocomplete="off" type="text" name="msg_content" placeholder="Write your message..." id="myinput">
                            <button class="btn" name="submit" id="mybtn"><i class="fa fa-telegram" aria-hidden="true"></i></button>
                        </form>
                    </div>

                </div>



            </div>

        </div>

    </div>

    <?php
           
        include("connection.php");
       if(isset($_POST['submit'])){
           $msg = htmlentities($_POST['msg_content']);
           if($msg == ""){
               echo"
                    <div class='alert alert-danger'>
                        <strong><center>Message was unable to send</center></strong>
                    </div>
               "; 
           }
           else if(strlen($msg) > 100){
               echo"
                    <div class='alert alert-danger'>
                        <strong><center>Message is too long. use only 100 characters </center></strong>
                    </div>
               "; 
           }
          else{
              $insert = "insert into user_chating1(sender, receiver, content, status, date) values('$user_name', '$username', '$msg', 'unread', NOW())";
              $run_insert = mysqli_query($con, $insert);
               
    }
        
           
       }
   
     
    ?>

    <script>
        $('#scrolling_to_bottom').animate({
            scrollTop: $('#scrolling_to_bottom').get(0).scrollHeight
        }, 1000);

    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            var height = $(window).height();
            $('.left-chat').css('height', (height - 92) + 'px');
            $('.right-header-contentchat').css('height', (height - 163) + 'px');
        });

    </script>


    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

    </script>

    <script>
        $("#myinput").keydown(function(event) {
            if (event.keyCode === 13) {
                $(this.trigger("#mybtn"))
            }
        });

    </script>






</body>

</html>





<div class="react-bundle align-middle" style="position:absolute;margin-top: -43px; margin-left: -40px;  background-color:white;padding: 0 2px;border-radius: 25px; box-shadow: 0px 0px 5px black; height:45px; width:270px; justify-content:space-around; transition: 0.3s;"><div style="position:absolute;margin-top: -43px; margin-left: -40px; display:flex; background-color:white;padding: 0 2px;border-radius: 25px; box-shadow: 0px 0px 5px black; height:45px; width:270px; justify-content:space-around; transition: 0.3s;"> <div class="like-react-click align-middle"> <img class="main-icon-css" src="' + BASE_URL + 'assets/image/react/like.png " alt=""></div> <div class="love-react-click align-middle"> <img class="main-icon-css" src="' + BASE_URL + 'assets/image/react/love.png " alt=""></div> <div class="haha-react-click align-middle"> <img class="main-icon-css" src="' + BASE_URL + 'assets/image/react/haha.png " alt=""></div></div> <div style="position:absolute;margin-top: -43px; margin-left: -40px; display:flex; background-color:white;padding: 0 2px;border-radius: 25px; box-shadow: 0px 0px 5px black; height:45px; width:270px; justify-content:space-around; transition: 0.3s;"> <div class="wow-react-click align-middle"> <img class="main-icon-css" src="' + BASE_URL + 'assets/image/react/wow.png " alt=""></div> <div class="sad-react-click align-middle"> <img class="main-icon-css" src="' + BASE_URL + 'assets/image/react/sad.png " alt=""></div> <div class="angry-react-click align-middle"> <img class="main-icon-css" src="' + BASE_URL + 'assets/image/react/angry.png " alt=""></div></div> </div>