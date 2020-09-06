<?php 
$user = $_SESSION['user_id'];

setusernamesession($user);

updatelastseen($user);


// $count = messagecount($user);


if($get_frnd_num > 0){
    foreach($get_all_friends as $row){
     
	$userid =  $row->user_id;
        
        $select = "select * from profile where userId=$userid";
        $query = mysqli_query($con, $select);
        $profile_fetch = mysqli_fetch_array($query);
        
        $profile = $profile_fetch['profilePic'];
        
//	    getuserlastseen($ram);
          $ram = $row->lastseen;
        $lastseen = timeAgo($ram);
        
       $sender = $row->user_id;
        
       $message_count = messagecount($user, $sender);
        
    echo'    
    <li>
    <a href="demo.php?user_id='.$row->user_id.'" style="text-decoration: none;">
    <div class=" chat">
    
         <div class="chat-left-img">       
           <p><img src="'.$profile.'" class="mr-2">'.$row->user_name.'</p>           
        </div>   
        <div class="chat-left-detail">       
          <p class="last_seen" style="font-size: 10px; color: #01baef;">'.$lastseen.'</p>
     
        ';
        if($message_count > 0){
            echo '
          <p style="font-size: 12px;" class="mc float-right mr-1 mb-1">'.$message_count.'</p>';
        }


        '
    
        </div>
        

        
      </div>
   
      </a>
      
    </li>
    
      '; 

    }
}
else{
    echo'<div class="no-frnd"><h5 class="text-info ">You have no buddies for chating!</h5>
    <p class="text-info">Add buddies and start chat</p></div>';
}


?>
