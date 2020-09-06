 <?php
    
    
            
             if(isset($_POST['delete_account'])){
        
                $user_id = $_SESSION['user_id'];
                 
                 $delete_account = "delete from my_users1 where user_id=$user_id";
                 $query = mysqli_query($con, $delete_account);
                 
//                  header("location: delete_account.php");
        
        if($query){
            $delete_chat = "delete from user_chating1 where (sender=$user_id OR receiver=$user_id)";
            $query1 =  mysqli_query($con, $delete_chat);
            
            if($query1){
                $delete_reqst = "delete from friend_request where (sender=$user_id OR receiver=$user_id)";
                $query2 = mysqli_query($con, $delete_reqst);
                
                if($query2){
                    $delete_frnds = "delete from friends where (user_one=$user_id OR user_two=$user_id)";
                    $query3 = mysqli_query($con, $delete_frnds);
                    
                    if($query3){
                        $delete_post = "delete from post where userId=$user_id";
                        $query4 = mysqli_query($con, $delete_post);
                        
                        if($query4){
                            $delete_react = "delete from react where reactBy=$user_id";
                            $query5 = mysqli_query($con, $delete_react);
                            
                            if($query5){
                                $delete_profile = "delete from profile where userId=$user_id";
                                $query6 = mysqli_query($con, $delete_profile);
                                
                                if($query6){
                                    $delete_comment = "delete from comments where commentBy=$user_id";
                                    $query7 = mysqli_query($con, $delete_comment);
                                    
                                    if($query7){
                                        $delete_token = "delete from token where user_id=$user_id";
                                        $query8 = mysqli_query($con, $delete_token);
                                        
                                        if($query8){
                                            echo "<script>alert('delete account')</script>";
                                            header("location: delete_page.php");
                                            
                                        }
                                        else{
                                            echo "<script>alert('doesn't delete account')</script>";
                                        }
                                    }
                                }
                            }
                        }
                     }
                }
            }
        }
    }
    
            
            
            ?>

