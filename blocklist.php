<?php
include "connection.php";
session_start();

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Block List</title>
    <link rel="stylesheet" href="private.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--    <link rel="stylesheet" href="alert.css">-->

</head>

<body>

    <a href="#" type="button" onclick="goBack()"> <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>
    <div class="container">

        <table class="table table-borderles table-condensed private">
            <tr align="center">
                <td colspan="6" class="active">
                    <h1 style="color: #333">Block List</h1>
                </td>
            </tr>

            <?php
        
        $userid = $_SESSION['user_id'];
        
        $select_block_people = "select block.blockerID, profile.user_name, profile.profilePic, profile.userId from block, profile where blockerID=$userid AND profile.userId = block.blockedID";
        $block_person_query = mysqli_query($con, $select_block_people);
            
        
        
         while($row = mysqli_fetch_array($block_person_query)){
             
             $block_username = $row['user_name'];
             $block_pic = $row['profilePic']; 
             $userId = $row['userId'];
               
              
               
        ?>


            <tr class="d-flex" style="justify-content: space-around;">
                <td><img src="<?php echo $block_pic ?>" alt="" style="width: 50px; height: 50px;"></td>
                <td class="input">
                    <p style="font-size: 30px; font-family: serif; color: #777"><?php echo $block_username ?></p>
                </td>
                <form action="" method="post">
                    <td><?php echo'<a href="blocklist.php?recieverid='.$userId.'" class="btn btn-primary" type="submit" name="unblock">Unblock</a>';?></td>
                </form>
                
          <?php  
             if(isset($_GET['recieverid'])){
                    $recieverid = $_GET['recieverid'];
                    $deletefromblock= "delete from block where blockerID='$userid' AND blockedID='$recieverid'";
                    $run = mysqli_query($con, $deletefromblock);
                    if($run){
                        echo'user is blocked successfully';
                        header('location: blocklist.php');
                    }else{
                        echo'not blocked';
                    }
                } ?>
        
            </tr>


            <?php } ?>

        </table>
        
                
                
                
                





    </div>

    <script>
        function goBack() {
            window.history.back();
        }

    </script>

</body>

</html>
