<?php
require 'includes/init.php';
// IF USER MAKING SIGNUP REQUEST
if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['user_country']) && isset($_POST['user_gender'])){
  $result = $user_obj->singUpUser($_POST['username'],$_POST['email'],$_POST['password'], $_POST['user_country'],$_POST['user_gender']);
}
// IF USER ALREADY LOGGED IN
if(isset($_SESSION['email'])){
  header('Location: post.php');
}
?>





<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Sign up</title>
    <link rel="stylesheet" href="create.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">





</head>

<body>




    <div class="container ">
        <H1 class="text-white mt-4 text-center">Create an account</H1>


        <div class="row pt-3">

            <!-- 3 dives starts here -->

            <div class="col-md-2"> </div>

            <!-- main div starts here -->


            <div class="col-md-8">
                <div class="row">

                    <div class=" col-md-6">

                        <form method="POST" action="" enctype="multipart/form-data">
                            <ul>
                                <a href="login.php">already have an account? signin</a>

                            </ul>

                            <label class="label control-label">FULL NAME</label>
                            <input type="text" class="form-control" name="username" placeholder="ENTER YOUR FULL NAME">

                            <label class="label control-label">EMAIL</label>
                            <input type="email" class="form-control" name="email" placeholder="ENTER YOUR EMAIL">

                            <label class="label control-label">PASSWORD</label>
                            <input type="password" class="form-control" name="password" placeholder="enter user name">


                            <label class="label control-label">ENTER YOUR COUNTRY</label>
                            <input type="text" class="form-control" name="user_country" placeholder="Enter your country">

                            <label class="label control-label">GENDER</label>
                            <input type="rext" class="form-control" name="user_gender" placeholder="Enter your gender">

                    
                            <div> <input type="submit" name="submit" class="btn btn-success w-100" value=" Create an account ">
                            </div>

                            <!-- social icons in form-body -->


                            <div class="mt-3 social-icon">
                                <h3 class="text-center mb-3" style="font-size: 19px;
    color: white;
    font-style:bold;
">OR LOGIN WITH</h3>
                                <a href="#" class="fb btn">
                                    <i class="fa fa-facebook fa-fw"></i> Login with Facebook
                                </a>
                                <a href="#" class="google btn" id="google-btn">
                                    <i class="fa fa-google fa-fw"></i> Login with Google+
                                </a>
                            </div>

                        </form>
    

                    </div>
                    <div class="col-md-6 image">
                        <img class="img" src="
										https://images.unsplash.com/photo-1476081718509-d5d0b661a376?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjF9&auto=format&fit=crop&w=1866&q=80">
                    </div>
                </div>

            </div>
            <div class="col-md-2"></div>
 <div>  
      <?php
        if(isset($result['errorMessage'])){
          echo '<p class="errorMsg">'.$result['errorMessage'].'</p>';
        }
        if(isset($result['successMessage'])){
          echo '<p class="successMsg">'.$result['successMessage'].'</p>';
        }
      ?>    
    </div>

        </div>
        <p class="text pt-4 mt-4 text-center">Hey user! All the information will kept confidential do not hesitate to fill the details, this is for the future notification and your working records</p>
    

    </div>
    </body>
    </html>
