<?php
include "Tlheader.php";
 include 'friends.php';
// include 'notifications.php';
// include 'profile.php';
// include 'header1.php';
 include 'user_profile1.php';



?>

<body  onload="myFunction()" style="margin:0;">
    

<!--<br>-->
<div class="container-fluid mt-3">
  
   <div id="load">
                <div></div>
                <div></div>
 </div>
 <div id="fetchingdata">Please wait..</div>
  <div style="display:none;" id="myDiv" class="animate-bottom">
   <div class="open_all_sidenav" style="display: flex; justify-content: space-between;">
    <button class="btn btn-primary opensidebarbtn On_btn" onclick="OnNav()"><span style="cursor:pointer;" >open</span></button>

    <button class="btn btn-warning opennavbarbtn On_button" onclick="OnNavbar()"><span style="cursor:pointer;" >open</span></button>
    </div>
    
    <div class="search-user">
        <input type="text" placeholder="Search..." id="myusers">
    </div>


    <!--<div class="container-fluid">-->
    <div class="row mt-1">
        <div class="col-lg-4 buddies budd_nav" id="buddi_sidenav">
            <a href="javascript:void(0)" class="close_btn" onclick="ShutNav()"><i class="fa fa-arrow-circle-left" aria-hidden="true" style="font-size: 25px;"></i></a>
            <h3>Buddies<span class="badge"><?php echo $get_frnd_num;?></span></h3>

            <div class="buddies-content">
                <?php
                 if($get_frnd_num > 0){
                     foreach($get_all_friends as $row){
                     
                         $user_id = $row->user_id;
                         $select = "select * from profile where userId=$user_id";
                         $query = mysqli_query($con, $select);
                         $get_data = mysqli_fetch_array($query);
                         
                         $country = $get_data['country'];
                         $profession = $get_data['professional'];
                         $city = $get_data['currentCity'];
                         $profile = $get_data['profilePic'];
                
                     
                         echo '
                         
                        <a class="chat_btn" href="profile1.php?id='.$row->user_id.'" style="text-decoration: none; outline: none; border: none;">
                         <div class="container">
                         <div class="frnd_detail d-flex">
                               <div class="buddiesimage">
                                <img src="'.$profile.'" alt="Pj" >
                                </div>
                                <div class="buddiesdetails">
                                <h1>'.$row->user_name.'</h1>
                                <p class="title">'.$country.'</p>
                                <p>'.$city.'</p>
                                <p>'.$profession.'</p>
                                <p>'.$row->user_gender.'</p>
                                </div>
                                
                            </div>
                            
                                <div class="break mt-3">
                        
                                  
                                    <a class=" btn btn-danger text-white" href="functions.php?action=unfriend_req&id='.$row->user_id.'" >Break</a>
                                    <a class="btn btn-primary text-white" href="demo.php?user_id='.$row->user_id.'">Chat</a>
                                 
                                                                              
                                </div>
                                
                               
                                
                            </div>
                            </a><br><br>
                            
                            ';
                         
                     }
                     
                     
                 }
                else{
                    echo '<div class="no-buddies"><h5  class="text-secondary">You have no buddies!</h5></div>';
                }
                 
                ?>

            </div>

        </div>

        <!--        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>-->

        <div class="col-lg-4 col-12 users">
            <h3>Users</h3>

            <?php
    

            
                if($all_users){
                
                    foreach($all_users as $row){
                        
                        $user = $row->user_id;
                        $select_data = "select * from profile where userId = $user";
                        $query_data = mysqli_query($con, $select_data);
                        $fetch = mysqli_fetch_array($query_data);
                        
                        $profilepic = $fetch['profilePic'];
                        $country1 = $fetch['country']; 
                        $profession1 = $fetch['professional'];
                        
                        $user_id1 = $_SESSION['user_id'];
                  
                        $hide_block = "SELECT * FROM block WHERE (blockerID= '$user_id1' AND blockedID= '$row->user_id') OR (blockerID= '$row->user_id' AND blockedID= '$user_id1')";
                        $blockedUser = mysqli_query($con, $hide_block);
//                        $fetch_hide = mysqli_fetch_array($blockedUser);
                        
//                        $blockedUser = 
                           if(!empty($fetch_hide = mysqli_fetch_array($blockedUser))){}
                        
                        else{
                        
                        
                        echo'
                        <div class="search-all-user">
                           
                            <div class="container">
                                <div class="frnd_detail d-flex">
                                 <div class="usersimage">
                                    <img src="'.$profilepic.'" alt="paras">
                                 </div>
                                 <div class="usersdetails">
                                    <h1>'.$row->user_name.'</h1>
                                    <p class="title">'.$country1.'</p>
                                    <p>'.$profession1.'</p>
                                    <p>'.$row->user_gender.'</p>
                                 </div>
                                
                               </div> 
                                
                                
                                <div class="connect mt-3">
                                
                            <a class=" btn btn-warning text-white" href="profile1.php?id='.$row->user_id.'">See Profile</a>
                    
                        
                        
                        
                        
                                </div>
                                
                            </div>
                          
                            </div>
                            <br><br>
                            
                            ';
                    
                    }
                        
                    
                    }
                    
                    
                      
                    }
                   
                
                else{
                    echo '<div class="no-user"><h5 class="text-secondary">there is no users!</h5></div>';
                }
        
//            if(isset($_POST['add'])){
//                echo"<script>window.open('home.php?user_name=$user_name', '_self')</script>";
//        }

?>


        </div>
        <div class="col-lg-4 reqst reqst_nav" id="reqst_sidenavbar">
            <a href="javascript:void(0)" class="closebutton " onclick="Shut_Nav()"><i class="fa fa-arrow-circle-left" aria-hidden="true" style="font-size: 25px;"></i></a>
            <h3>Buddies Request<span class="badge <?php 
                   if($get_req_num > 0){
                       echo 'redBadge';
                   }
                   ?>"><?php echo $get_req_num;?></span></h3>
            <div class="buddies-content">
                <?php
                 if($get_req_num > 0){
                     foreach($get_all_req_sender as $row){
                         
                         $userid = $row->sender;
                         
                         $select_data1 = "select * from profile where userId = $userid";
                         $query_data1 = mysqli_query($con, $select_data1);
                         $fetch1 = mysqli_fetch_array($query_data1);
                        
                         $profilepic1 = $fetch1['profilePic'];
                         $country2 = $fetch1['country']; 
                         $profession2 = $fetch1['professional'];
                         
                         
                         
                         echo '
                         <a class="chat_btn" href="profile1.php?id='.$row->sender.'" style="text-decoration: none; outline: none; border: none;">
                                
                         <div class="container">
                          <div class="frnd_detail d-flex">
                               <div class="reqstimage">
                                  <img src="'.$profilepic1.'" alt="parasj">
                                </div>
                                
                                <div class="reqstdetails">
                                  <h1>'.$row->user_name.'</h1>
                                  <p class="title">'.$country2.'</p>
                                  <p>'.$profession2.'</p>
                                  <p>'.$row->user_gender.'</p>
                                </div>
                                
                            </div>    
                                <div class="break mt-3">
                                
                             
                                    <a class=" btn btn-primary text-white" href="functions.php?action=accept_req&id='.$row->sender.'">Connect</a>
                                    <a class=" btn btn-info text-white ml-2" href="functions.php?action=ignore_req&id='.$row->sender.'">Disconnect</a>
                         
                         
                                </div>
                                    
                            </div>
                            </a><br><br>
                            ';
                     }
                     
                 }
                else{
                    echo '<div class="no-reqst"><h5 class="text-secondary">You have no request!</h5>';
                }
                
                                   ?>
            </div>
        </div>

    </div>
</div>
</div>




<script>
    $(document).ready(function() {
        $("#myusers").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".search-all-user").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    })

</script>

<script>
    function OnNav() {
        document.getElementById("buddi_sidenav").style.width = "100%";
    }

    function ShutNav() {
        document.getElementById("buddi_sidenav").style.width = "0";
    }

</script>

<script>
    function OnNavbar() {
        document.getElementById("reqst_sidenavbar").style.width = "100%";
    }

    function Shut_Nav() {
        document.getElementById("reqst_sidenavbar").style.width = "0";
    }

</script>
<script>
var myVar;

function myFunction() {
  myVar = setTimeout(showPage, 200);
}

function showPage() {
  document.getElementById("load").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
}
</script>
</body>