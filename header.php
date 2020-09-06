   <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
       <a href="#" class="navbar-brand">
           <?php
           include("connection.php");
           $user = $_SESSION['user_email'];
           $get_user = "select * from my_users1 where user_email='$user'";
           $run_user = mysqli_query($con, $get_user);
           $row = mysqli_fetch_array($run_user);
           
           $user_name = $row['user_name'];
           echo"<a href='home.php?user_name=$user_name'>MyChat</a>";
           ?>
          
       </a>
        <ul class="navbar-nav">
              <li><a href="account_settings.php" style="color: white; text-decoration: none;">Settings</a></li>
               
           </ul>
    </nav><br>