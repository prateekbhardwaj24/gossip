 <?php
require 'includes/init.php';
// IF USER MAKING LOGIN REQUEST
if(isset($_POST['email']) && isset($_POST['password'])){
  $result = $user_obj->loginUser($_POST['email'],$_POST['password']);
}
// IF USER ALREADY LOGGED IN
if(isset($_SESSION['email'])){
  header("Location: post.php");
  exit;
}
?>
 
 <!DOCTYPE html>
<html>
<head>
	<title>paraslogin</title>
</head>
<body>

	<!DOCTYPE html>
<html>
<head>
	<title>login form</title>
	<link rel="stylesheet" type="text/css" href="PARASLOGIN.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<!-- //container starts from here.... -->
	<div class="container">

		<!-- //first row..... -->

		<div class="row ">

			 <!-- //3 div in first row... -->

			<div class="col-md-2"></div>                 
			<div class="col-md-8 align-items-center justify-centent-center ">

				<!-- main form's div -->

				<!-- second row -->

				<div class="row">

					<div class="col-md-6 form-body">

						
						<form  action="" method="POST">
							<ul class="text-center">

							  <a href="#">PLEASE LOGIN  HERE</a>
							
						    </ul>

							<label class="label control-label">E-MAIL ID</label>

							<input type="text" class="input form-control" name="email" placeholder="ENTER ID"  required>


							


							<label class="label control-label">YOUR PASSWORD</label>

							<input type="password" class="input form-control" name="password" placeholder="ENTER PASSWORD" required>


							<label class="text-white mr-3">Remember me ?</label>

							<input style="height: 15px;width: 15px; margin-top:20px;" class="checkbox" type="checkbox" name="checkbox">


							<div class="btn">
								<input type="submit" name="submit" value="login" class="btn btn-success w-100">
							</div>
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
							<div class="text-center">
							  	<a href="recover.php" class="text-white text-center">forgotten password?</a>
							</div>

							<!-- social icons in form-body -->


							<div class="mt-3 social-icon">
							  <a href="#" class="fb btn">
						          <i class="fa fa-facebook fa-fw"></i> Login with Facebook
						      </a>
						      <a href="#" class="google btn" style="background-color: #E32C30; " >
						          <i class="fa fa-google fa-fw"></i> Login with Google+
						       </a>
						    </div>
						</form>
					 </div>

					<div class="col-md-6 image">
				    	<img src="https://images.pexels.com/photos/2681319/pexels-photo-2681319.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260">
					</div>

				</div>


			</div>

			<div class="col-md-2"></div>


		</div>

	</div>	


	

</body>
</html>


</body>
</html>