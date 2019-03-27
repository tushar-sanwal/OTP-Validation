<!DOCTYPE html>
<html>
<head>
	<title>OTP Validation : Validate number through OTP</title>
	<link rel="stylesheet" type="text/css" href="index.css">
	<link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>
<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>
</head>
<body>
	<div class="container">
		<h1 class="text text-center">OTP validation : <small>Authenticate user by sending OTP</small></h1>
	</div>
	<div class="container col-8 form-container">
		<h3 class="text text-center">Signup Form</h3>
		<div class="container">

			<!--PHP code to sent message to the number-->
		<?php
		if(isset($_POST['sub'])){
			require('textlocal.class.php'); // this is the wrapper class provided by text local which is used to interface with the Textlocal API2 to send messages and many more. 
			$textlocal = new Textlocal(false, false, 'i64I7l3/7oE-jPmiS3lNa5Oh9WgYaogcMNjYGMmiCW'); //this is api key which is given by textlocal.

			$numbers = array($_POST['mno']);
			$sender = 'TXTLCL';
			$otp = mt_rand(10000,99999);
			$message = "Hello ".$_POST['email']. " your otp is".$otp;

			try {
			    $result = $textlocal->sendSms($numbers, $message, $sender);
			    setcookie('otp',$otp);  // I use cookie to store otp you can use database to store your otp.
			    echo "<p class='alert alert-success'>OTP is just sent to your mobile please verify it.</p>";
			   
			} catch (Exception $e) {
			    die('Error: ' . $e->getMessage());
			}
		}

      // Check whether otp is same or not		
          if(isset($_POST['subotp'])){
			$otp = $_POST['otp'];
			if($_COOKIE['otp'] == $otp){
				echo "<p class='alert alert-success'>Congratulations! Now you can logged in</p>";
				// Now here you can place the link of your login page or send control ons next page where login is there
			}
			else{
				echo "<p class='alert alert-danger'>Please enter correct OTP</p>";
				?>
				<?php
			}
		}
?>
	</div>
	<fieldset class="border">
		<h5 class="text mt-5 ml-5">Create your account</h5>
	  <form class="form" method="post" action="index.php">
	  	  <div class="container input-container">
		  <div class="form-group col-5">
		  	<div class="row">
		    <label for="Email1" class="bmd-label-floating">Email address</label>
		    <input type="email" class="form-control" id="email" name="email" required>
		</div>
	</div>
	<div class="col-5 float-right">
	  	  		<img class="img-fluid" src="images/acc.png" style="border-radius: 100%;">
	  	  	</div>
		<div class="form-group col-5">
		  	<div class="row">
		    <label for="Email1" class="bmd-label-floating">Mobile Number</label>
		    <input type="text" class="form-control" id="number" name="mno" required>
		</div>
		  </div>
		  <div class="form-group col-5">
		  	<div class="row">
		    <label for="Password1" class="bmd-label-floating">Password</label>
		    <input type="password" class="form-control" id="password" name="pass" required>
		</div>
	</div>
		<div class="form-group col-5">
		  	<div class="row">
		    <label for="Cpassword" class="bmd-label-floating">Confirm Password</label>
		    <input type="password" class="form-control" id="password" name="cpass" required>
		</div>
	</div>
		<div class="form-group col-5">
		  	<div class="row">
		    <input type="submit" class="btn btn-success btn-raised" value="Signup" name="sub"/>
		</div>
		  </div> 
		</div>
      </form>
        </fieldset> 
    </div>

    <div class="row mt-5">
    <div class="container col-6">
    <fieldset class="border">
    	<h5 class="text mt-5 ml-4">Verify your mobile number</h5>
    	<form method="post">
    		<div class="container">
    			<div class="container col-5 float-right mb-5">
    		<img class="img-fluid" src="images/verify.png" style="border-radius: 100%;width: 500px;height: 250px;">
    	</div>
    		<div class="form-group col-5">
    		<label for="otp" class="bmd-label-floating">Enter your OTP</label>
    		<input id="otp-input" class="form-control" type="text" name="otp"/>
    	</div>
    	<div class="form-group col-6">
    		<input class="btn btn-success btn-raised sub-otp" type="submit" name="subotp" value="Verify">
    	</div>
    </div>
    	</form>
    </fieldset>
</div>
</div>
</body>
</html>