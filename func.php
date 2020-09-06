<?php
//session_start();

function connect(){
    $dbname = "mychat";
    $dbuser = "root";
    $dbpassword = "";
    
    try{
        $db = new PDO("mysql:host=localhost;dbname=$dbname", $dbuser,$dbpassword);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(Exception $e){
        die($e->getMessage());
    }
    
    return $db;
}



function updatelastseen($username){
    $con = connect();
   
   
    try{
      
        $currentTimestamp = time();
        $query = $con->prepare("UPDATE my_users1 SET lastseen = ? WHERE user_id = ?");
        $query->bindParam(1,$currentTimestamp);
        $query->bindParam(2,$username);
        
        
        $query->execute();
    }catch(Exception $e){
        die($e->getMessage());
    }
}

function setusernamesession($username){
    $_SESSION['user'] = $username;
}

//function getuserlastseen($username){
//    $con = connect();
////    $user_id = $_SESSION['user_id'];
////    $user_id1 = $_SESSION['userid'];
////    $get_user = "select * from my_users1";
////    $run_user = mysqli_query($con, $get_user);
//    
////    $row = mysqli_fetch_array($run_user);
////    $user_id1 = $row['user_id'];
//    try{
//        $query = $con->prepare("SELECT lastseen FROM my_users1 where user_id != ?");
//        $query->bindParam(1, $username);
//        $query->execute();
//        $lastseenArray = $query->Fetch(PDO::FETCH_NUM);
//        
//        $timesince = time() - $lastseenArray[0];
//        
//        $timeAgo = timeAgo($timesince);
//        
//        if($lastseenArray[0] == "" || $lastseenArray[0] == null){
//            return "never seen";
//        }else {
//            if($timesince <=5){
//            return "<h2><span>online</span></h2>";
//        }else{
//            return "<h2><span>Last seen ".$timeAgo."</span></h2>";
//        }
//        }
//    }catch(Exception $e){
//        die($e->getMessage());
//    }
//}

// if($timeStamp <=5){
//            return "<h2><span>online</span></h2>";
//  }else{
//            return "<h2><span>Last seen ".$sam."</span></h2>";
//        }

function timeAgo($timesince){
	
	$timeStamp = time() - $timesince;

    if($timeStamp == 0){
        $timeAgo = "1 second ago";
    }else if($timeStamp == 1){
        $timeAgo = "$timeStamp second ago";
    }else if($timeStamp < 60){
        $timeAgo = "$timeStamp seconds ago";
    }else if($timeStamp >=60 && $timeStamp < 3600){
        $time = $timeStamp / 60;
        
        if(round($time) < 2){
            $timeAgo = "1 min ago";
        }else{
            $timeAgo =  round($time)." mins ago";
        }
    }else if($timeStamp >= 3600 && $timeStamp < 86400){
        $time = $timeStamp / 3600;
        if(round($time) < 2){
            $timeAgo = "1 hour ago";
        }else {
            $timeAgo = round($time)." hours ago";
        }
    }else if($timeStamp >= 86400 && $timeStamp < 2419200){
        $time = $timeStamp / 86400;
        if(round($time) < 2){
            $timeAgo = "1 day ago";
        }else{
            $timeAgo = round($time)." days ago";
        }
    }else if($timeStamp >= 2419200 && $timeStamp < 31536000){
        $time = $timeStamp / 2419200;
        if(round($time) == 1){
            $timeAgo = "1 month ago";
        }else{
            $timeAgo = round($time)." months ago"; 
        }
    }else {
        $time = $timeStamp / 31536000;
        if(round($time) == 1){
            $timeAgo = "1 year ago";
        }else{
            $timeAgo = round($time)." years ago";
        }
    }
	 if($timeStamp <=5){
            return "<h4><span>online</span></h4>";
  }else{
            return "<h4><span>Last seen ".$timeAgo."</span></h4>";
        }
//    return $timeAgo;
}






	  function messagecount($user_id,$sender){
//	  $user_id = $_SESSION['user_id'];
		 
	 $con = connect();	
		try{
			$sql = "select  count(*) from user_chating1 where user_chating1.status= 0 and user_chating1.receiver=:user_id and user_chating1.sender=:sender";
                        $stmt = $con->prepare($sql);
			 $stmt->bindValue(':user_id',$user_id, PDO::PARAM_INT);
			 $stmt->bindValue(':sender',$sender, PDO::PARAM_INT);
			$stmt->execute();
			$counting = $stmt->fetchColumn();
//			$count = $counting/5;
			if($counting > 0){
				return $counting;
			}
			
		}
	  catch (PDOException $e) {
            die($e->getMessage());
        }
	}

?>
