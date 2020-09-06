<?php
// user.php
class User{
    protected $db;
    protected $user_name;
    protected $user_email;
    protected $user_pass;
    protected $hash_pass;
    protected $user_country;
    protected $user_gender;
    
    function __construct($db_connection){
        $this->db = $db_connection;
    }

    // SING UP USER
    function singUpUser($user_name, $user_email, $password, $user_country, $user_gender){
        try{
            $this->user_name = trim($user_name);
            $this->user_email = trim($user_email);
            $this->user_pass = trim($password);
            $this->user_country = trim($user_country);
            $this->user_gender = trim($user_gender);
            $screenName = ''.$user_name.'';
            if($this->db->prepare("SELECT user_name FROM my_users1 WHERE user_name = :user_name", array(':screenName' => $screenName ))){
                $screenRand = rand();
                            $userLink = ''.user_name.''.$screenRand.'';
                        }else{
                            $userLink = $screenName;
                        }
                    

            if(!empty($this->user_name) && !empty($this->user_email) && !empty($this->user_pass) && !empty($this->user_country) && !empty($this->user_gender)){

                if (filter_var($this->user_email, FILTER_VALIDATE_EMAIL)) { 

                    if(strlen($password)<8){
                        echo"<script>alert('Password should be minimum 8 characters')</script>";
                       echo"<script>window.open('create1.php', '_self')</script>";
                        exit();
                    }
                    

                    $check_email = $this->db->prepare("SELECT * FROM `my_users1` WHERE user_email = ?");
                    $check_email->execute([$this->user_email]);

                  

                    if($check_email->rowCount() > 0){
                        return ['errorMessage' => 'This Email Address is already registered. Please Try another.'];
                    }
                    else{
                        
                       

                        $this->hash_pass = password_hash($this->user_pass, PASSWORD_DEFAULT);
                        $sql = "INSERT INTO `my_users1` (user_name, user_email, user_pass, user_country, user_gender) VALUES(:user_name, :user_email, :user_pass, :user_country, :user_gender)";
            
                        $sign_up_stmt = $this->db->prepare($sql);
                        //BIND VALUES
                        $sign_up_stmt->bindValue(':user_name',htmlspecialchars($this->user_name), PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':user_email',$this->user_email, PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':user_pass',$this->hash_pass, PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':user_country',
                        $this->user_country, PDO::PARAM_STR);
                        $sign_up_stmt->bindValue(':user_gender',
                        $this->user_gender, PDO::PARAM_STR);
                        // INSERTING RANDOM IMAGE NAME
//                         $sign_up_stmt->bindValue(':user_profile',$user_profile.'.png', PDO::PARAM_STR);
                        $sign_up_stmt->execute();
                        return ['successMessage' => 'You have signed up successfully.'];                   
                    }
                }
                else{
                    return ['errorMessage' => 'Invalid email address!'];
                }    
            }
            else{
                return ['errorMessage' => 'Please fill in all the required fields.'];
            } 
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // LOGIN USER
    function loginUser($email, $password){
        
        try{
            $this->user_email = trim($email);
            $this->user_pass = trim($password);

            $find_email = $this->db->prepare("SELECT * FROM `my_users1` WHERE user_email = ?");
            $find_email->execute([$this->user_email]);
            
            if($find_email->rowCount() === 1){
                $row = $find_email->fetch(PDO::FETCH_ASSOC);

                $match_pass = password_verify($this->user_pass, $row['user_pass']);
                if($match_pass){
                    $_SESSION = [
                        'user_id' => $row['user_id'],
                        'user_email' => $row['user_email']
                    ];
                    header("Location: post.php");
                }
                else{
                    return ['errorMessage' => 'Invalid password'];
                }
                
            }
            else{
                return ['errorMessage' => 'Invalid email address!'];
            }

        }
        catch (PDOException $e) {
            die($e->getMessage());
        }

    }

    // FIND USER BY ID
    function find_user_by_id($id){
        try{
            $find_user = $this->db->prepare("SELECT * FROM `my_users1` WHERE user_id = ?");
            $find_user->execute([$id]);
            if($find_user->rowCount() === 1){
                return $find_user->fetch(PDO::FETCH_OBJ);
            }
            else{
                return false;
            }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    
    // FETCH ALL USERS WHERE ID IS NOT EQUAL TO MY ID
    function all_users($id){
        try{
            $get_users = $this->db->prepare("SELECT user_id, user_name, user_country, user_gender FROM `my_users1` WHERE user_id != ?");
            $get_users->execute([$id]);
            if($get_users->rowCount() > 0){
                return $get_users->fetchAll(PDO::FETCH_OBJ);
            }
            else{
                return false;
            }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
?>