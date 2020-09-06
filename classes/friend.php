<?php
 class Friend{
     protected $db;
     
     public function _construct($db_connection){
         $this->db = $db_connection;
     }
     
     
//     check is already friend
     public function is_already_friends($my_id, $user_id){
         try{
             $sql = "SELECT * FROM `friends` WHERE (user_one = :my_id AND user_two = :frnd_id) OR (user_one = :frnd_id AND user_id = :my_id)";
             
             $stmt = $this->db->prepare($sql);
             $stmt->bindValue(':my_id', $my_id, PDO::PARAM_INT);
             $stmt->bindValue(':frnd_id', $user_id, PDO::PARAM_INT); 
             $stmt->execute();
             
             
            if($stmt->rowCount() === 1){
                return true;
            }
             else{
                return false;
            }
             }
        catch (PDOException $e) {
            die($e->getMessage());
        }
         }
     
//     if i am the requets sender
     public function am_i_sender($my_id, $user_id){
         try{
            $sql = "SELECT * FROM `friend_request` WHERE sender = ? AND receiver = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$my_id, $user_id]);

            if($stmt->rowCount() === 1){
                return true;
            }
            else{
                return false;
            }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
         
     }
     
//     if i am the receiver
     public function am_i_receiver($my_id, $user_id){
         try{
             $sql = "SELECT * FROM `friend_request` WHERE sender = ? AND receiver = ?";
             $stmt = $this->db->prepare($sql);
             $stmt->execute([$user_id, $my_id]);
             
             if($stmt->rowCount() === 1){
                 return true;
                 
             }
             else{
                 return false;
                 
             }
             
         }
         catch (PDOException $e){
             die($e->getMessage());
         }
     }
     
//     check reqst already send 
     public function is_reqst_already_sent($my_id, $user_id){
         try{
             $sql = "SELECT * FROM `friend_request` WHERE (sender = :my_id AND receiver = :frnd_id) OR (sender = :frnd_id AND receiver = :my_id)";
             $stmt = $this->db->prepare($sql);
             $stmt->bindValue(':my_id', $my_id, PDO::PARAM_INT);
             $stmt->bindValue(':frnd_id', $user_id, PDO::PARAM_INT);
             $stmt->execute();
             
             if($stmt->rowCount() === 1){
                 return true;
             }
             else{
                 return false;
             }
         }
         catch (PDOException $e){
             die($e->getMessage());
         }
     }
     
//     send friend reqst
     public function send_friend_rqst($my_id, $user_id){
         try{
             $sql = "INSERT INTO `friend_request` (sneder, receiver) VALUES(?,?)";
             $stmt = $this->db->prepare($sql);
             $stmt->execute([$my_id, $user_id]);
             header('Location: profile1.php?id='.$user_id);
             exit();
         }
         catch (PDOException $e){
             die($e->getMessage());
         }
         
     }
     
//     cancle reqst
     public function cancel_reqst($my_id, $user_id){
         try{
             $sql = "DELETE FROM `friend_request` WHERE (sender = :my_id AND receiver = :frnd_id) OR (sender = :frnd_id AND receiver = :my_id)";
             
             $stmt = $this->db->prepare($sql);
             $stmt->bindValue(':my_id', $my_id, PDO::PARAM_INT);
             $stmt->bindValue(':frnd_id', $user_id, PDO::PARAM_INT);
             header('Location: profile1.php?id='.$user_id );
             exit();
         }
         catch(PDOException $e){
             die($e->getMessage());
         }
     }
     
//     make friend
     public function make_frnd($my_id, $user_id){
         try{
             $delete_pending_frnd = "DELETE FROM `friend_request` WHERE  (sender = :my_id AND receiver = :frnd_id) OR (sender = :frnd_id AND receiver = :my_id)";
             
             $delete_stmt = $this->db->prepare($delete_pending_frnd);
             $delete_stmt->bindValue(':my_id', $my_id, PDO::PARAM_INT);
             $delete_stmt->bindValue(':frnd_id', $user_id, PDO::PARAM_INT);
             $delete_stmt->execute();
             
             if( $delete_stmt->execute()){
                 $sql = "INSERT INTO `friends`(user_one, user_two) VALUES(?,?)";
                 $stmt = $this->db->prepare($sql);
                 $stmt->execute([$my_id, $user_id]);
                 header('Location: profile1.php?id='.$user_id);
                 exit();
             }
         }
         catch(PDOException $e){
             die($e->getMessage());
         }
     }
     
//     delete frnd
     public function delete_frnd($my_id, $user_id){
         try{
             $delete_frnd = "DELETE FROM `friends` WHERE (user_one = :my_id AND user_two = :user_id) OR (user_one = :frnd_id AND user_two = :my_id)";
             $stmt = $this->db->prepare($delete_frnd);
             $stmt->bindValue(':my_id', $my_id, PDO::PARAM_INT);
             $stmt->bindValue(':frnd_id', $user_id, PDO::PARAM_INT);
             $stmt->execute();
             header('Location: profile1.php?id ='.$user_id);
             exit();
         }
     catch (PDOException $e){
         die($e->getMessage());
         
     }
    
     }
     
//     Reqst notification
     
     public function reqst_notification($my_id, $send_data){
         try{
             $sql = "SELECT sender, user_name, user_profile FROM `friend_request` JOIN my_users1 ON friend_request.sender = my_users1.id WHERE receiver = ?";
             
             $stmt = $this->db->prepare($sql);
             $stmt->execute([$my_id]);
             if($send_data){
                 return $stmt->fetchAll(PDO::FETCH_OBJ);
             }
             else{
                 return $stmt->rowCount();
             }
                 
         }
         catch(PDOException $e){
             die($e->getMessage());
         }
     }
     
//     get all frnd
     public function get_all_frnd($my_id, $send_data){
         try{
             $sql = "SELECT * FROM `friends` WHERE user_one = :my_id OR user_two = :my_id";
             $stmt = $this->db->prepare($sql);
             $stmt->bindValue(':my_id', $my_id, PDO::PARAM_INT);
             $stmt->execute();
             
             if($send_data){
                 $return_data = [];
                 $all_users = $stmt->fetchAll(PDO::FETCH_OBJ);
                 
                 foreach($all_users as $row){
                     if($row->user_one == $my_id){
                         $get_user = "SELECT user_id, user_name, user_profile FROM my_users1 WHERE id = ?";
                         $get_user_stmt = $this->db->prepare($get_user);
                         $get_user_stmt->execute([$row->user_two]);
                         array_push($return_data, $get_user_stmt->fetch(PDO::FETCH_OBJ));
                     }
                     else{
                         $get_user = "SELECT id, user_name, user_profile FROM my_users1 WHERE id = ?";
                         $get_user_stmt = $this->db->prepare($get_user);
                         $get_user_stmt->execute([$row->user_one]);
                         array_push($return_data, $get_user_stmt->fetch(PDO::FETCH_OBJ));
                     }
                 }
                 return $return_data;
             }
             else{
                 return $stmt->rowCount();
             }
         }
         catch(PDOException $e){
             die($e->getMessage());
         }
     }
     }
?>
