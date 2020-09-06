<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "mychat") or die ("connection was npot establish");

    function search_user(){
        global $con;
    
        if (isset($_POST['submit'])){
            $search_query = htmlentities($_POST['search_query']);
            $get_user = "select * from my_users1 where user_name like '%$search_query%' or user_country like '%$search_query%'"; 
        }
        else {
            $get_user = "SELECT * FROM MY_USERS1 order by user_country, user_name DESC LIMIT 100";
        }
            $run_user = mysqli_query($con, $get_user);
    
        while($row = mysqli_fetch_array($run_user)){
        
            $user_name = $row['user_name'];
            $user_profile = $row['user_profile'];
            $country = $row['user_country'];
            $gender = $row['user_gender'];
            $user_id1 = $row['user_id'];
            
            $_SESSION['userid'] = $user_id1;
        
            echo"
                <div class='card'>
                    <img src='$user_profile'>
                    <h1>$user_name</h1>
                    <p class='title'>$country</p>
                    <p>$gender</p>
                    <form method='post'>
                        <p><button name='add'>Chat with $user_name</button></p>
                    </form>
                </div><br><br>
                ";
        
            if(isset($_POST['add'])){
                echo"<script>window.open('home.php?user_name=$user_name', '_self')</script>";
        }
    }
}
?>