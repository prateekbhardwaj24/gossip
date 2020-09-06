  <?php

session_start();
include("connection.php");
 $receiver_id = $_SESSION['receiverlock'];                   
 $user = $_SESSION['user_email'];
 $get_user = "select * from my_users1 where user_email = '$user'";
 $run_user = mysqli_query($con, $get_user);
 $row = mysqli_fetch_array($run_user);

 $user_id = $row['user_id'];
  
// lock two passwords inserting code//
         if(isset($_POST['locksubmit'])){
             $lockpass = $_POST['lockpass'];
             $conlockpass = $_POST['conlockpass'];                             
             $lockervalue = 'locked';
             if($lockpass==$conlockpass){
             $lockupdate = "insert into lockerroom (lockpass, locker, sender, receiver) VALUES('$lockpass','1','$user_id','$receiver_id')"; 
                 $runlockupdate = mysqli_query($con,$lockupdate);
                 if($runlockupdate){
                     header('location:demo.php');
                 }else{
                      echo '<script>alert("not submit pass")</script>'; 
                 }
             }else
             {
                  echo '<script>alert("wrong password")</script>'; 
             }
         }
        else{
            echo '<script>alert("lock button not pressed")</script>';    
         }

// unlocking chat code //

         if(isset($_POST['unlock'])){
             $unlockpass = $_POST['unlockpass'];
             $lockervalue = 'U';
             $selectpass = "select lockpass from lockerroom where sender = '$user_id' and receiver= '$receiver_id'";
             $runpass = mysqli_query($con,$selectpass);
             $fetchpass = mysqli_fetch_array($runpass);
             $oldpass = $fetchpass['lockpass'];
             
             if($oldpass == $unlockpass){
                 $updatelocker = "update lockerroom set locker = '0' where sender = '$user_id' and receiver= '$receiver_id' ";
                 $runupdate = mysqli_query($con,$updatelocker);
                 header('location:demo.php');
             }else{
                 echo '<script>alert("Your password does not match! Please remember your password")</script>'; 
             }
         }

//lock again chat code//


        if(isset($_POST['lockagain'])){
             $lockagain = $_POST['lockagainpass'];
             $selectpass = "select lockpass from lockerroom where sender = '$user_id' and receiver= '$receiver_id'";
             $runpass = mysqli_query($con,$selectpass);
             $fetchpass = mysqli_fetch_array($runpass);
             $oldpass = $fetchpass['lockpass'];
             $lockervalue = 'locked';
              
             if($oldpass == $lockagain){
                 $updatelocker = "update lockerroom set locker = '1' where sender = '$user_id' and receiver= '$receiver_id'";
                 $runupdate = mysqli_query($con,$updatelocker);
                 header('location:demo.php');
             }else{
                 echo '<script>alert("Your password does not match! Please remember your password")</script>'; 
             }
         }

        
         
 ?>

  <!-- jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj -->

                
               