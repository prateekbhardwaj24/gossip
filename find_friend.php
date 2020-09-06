<!DOCTYPE html>
<?php
  session_start();
include("find_friend_function.php");
if(!isset($_SESSION['user_email'])){
    header('location:login.php');
}
else{
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Search for friends</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="find_people.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.4/holder.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
       <a href="#" class="navbar-brand">
           <?php
           $user = $_SESSION['user_email'];
           $get_user = "select * from my_users1 where user_email='$user'";
           $run_user = mysqli_query($con, $get_user);
           $row1 = mysqli_fetch_array($run_user);
           
           $user_name = $row1['user_name'];
           echo"<a href='home.php?user_name=$user_name'>MyChat</a>";
           ?>
          
       </a>
        <ul class="navbar-nav">
              <li><a href="account_settings.php" style="color: white; text-decoration: none;">Settings</a></li>
               
           </ul>
    </nav><br>
    
    <div class="row">
       <div class="col-sm-4">
           
       </div>
       <div class="col-sm-4">
           <form class="search_form" method="post" action="">
               <input type="text" name="search_query" placeholder="Search Friends" autocomplete="off" required>
               <button class="btn" type="submit" name="submit">Search</button>
           </form>
       </div>
       <div class="col-sm-4">
           
       </div>
        
    </div><br><br>
    <?php search_user(); ?>
</body>
</html>
<?php } ?>
