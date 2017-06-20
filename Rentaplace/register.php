<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php session_start()?>
<!DOCTYPE html>
<html>
<head>
<title>OpenRoom | Register</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-select.css">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<!--fonts-->
<link href='//fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!--//fonts-->	
<!-- js -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<!-- js -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-select.js"></script>
<script>
  $(document).ready(function () {
    var mySelect = $('#first-disabled2');

    $('#special').on('click', function () {
      mySelect.find('option:selected').prop('disabled', true);
      mySelect.selectpicker('refresh');
    });

    $('#special2').on('click', function () {
      mySelect.find('option:disabled').prop('disabled', false);
      mySelect.selectpicker('refresh');
    });

    $('#basic2').selectpicker({
      liveSearch: true,
      maxOptions: 1
    });
  });
</script>
<script type="text/javascript" src="js/jquery.leanModal.min.js"></script>
<link href="css/jquery.uls.css" rel="stylesheet"/>
<link href="css/jquery.uls.grid.css" rel="stylesheet"/>
<link href="css/jquery.uls.lcd.css" rel="stylesheet"/>
<!-- Source -->
<script src="js/jquery.uls.data.js"></script>
<script src="js/jquery.uls.data.utils.js"></script>
<script src="js/jquery.uls.lcd.js"></script>
<script src="js/jquery.uls.languagefilter.js"></script>
<script src="js/jquery.uls.regionfilter.js"></script>
<script src="js/jquery.uls.core.js"></script>
<script type="text/javascript" src="js/validationScript.js"></script> <!--validates forms-->

</head>
<body>
<div class="header">
		<div class="container">
			<div class="logo">
				<a href="index.php"><span>Open</span>Room</a>
			</div>
			<div class="header-right">
			<a class="account" href="login.php" style="background-color: white; color:#4db6ac;">Login</a>
			<a class="account" href="register.php">Sign-up</a>
			</div>
		</div>
		</div>
	</div>
	 <section>
			<div id="page-wrapper" class="sign-in-wrapper">
				<div class="graphs">
					<div class="sign-up">
						
							<h1>Create an account</h1>
							<h2>Personal Information</h2>
							<div class="sign-u">
								<div class="sign-up1">
									<h4>Email Address* :</h4>
								</div>
							<form action="php/registerFormValidation.php" method="POST">
								<div class="sign-up2 form-group has-feedback">
									<input type="text" name="email" placeholder="Your email" required="" class="form-control" id="email" onkeyup="validate();"/>
									<p id="message"></p>
								</div>
								<div class="clearfix"> </div>
							</div>
							<div class="sign-u">
								<div class="sign-up1">
									<h4>Password* :</h4>
								</div>
								<div class="sign-up2 form-group has-feedback">
									<input type="password" name="password" placeholder=" " required="" class="form-control" id="password" onkeyup="validatePassword();"/>
								</div>
								<div class="clearfix"> </div>
							</div>
							<div class="sign-u">
								<div class="sign-up1">
									<h4>Confirm Password* :</h4>
								</div>
								<div class="sign-up2 form-group has-feedback">
										<input type="password" name="password2" placeholder=" " required="" class="form-control" id="password2" onkeyup="registerValidatePassword();"/>
										<p id="message2" ></p>
								</div>
								<div class="clearfix"> </div>
							</div>
							<div class="sub_home">
								<div class="sub_home_left">
									<input type="submit" value="Create" name="submit">
								</div>
								<div >
									<p id="errorMessage">
										<?php 
											if(!empty($_SESSION['errorMessage'])) { echo $_SESSION['errorMessage']; } 
											
											unset($_SESSION['errorMessage']); 
										?>
									</p>
								</div>
								
							</form>
								<div class="sub_home_right">
									<p>Go Back to <a href="index.php">Home</a></p>
								</div>
								<div class="clearfix"> </div>
							</div>
							
					</div>
				</div>
			</div>
		<!--footer section start-->
			<footer class="diff">
			   <p class="text-center">© 2017 OpenRoom. All Rights Reserved | Design by  <a href="williamsnimi.github.io" target="_blank">NEGUSLABS</a> using<a href="http://w3layouts.com/" target="_blank"> W3layouts</a></p>
			</footer>
        <!--footer section end-->
	</section>
	<script type="text/javascript" src="js/script.js"></script>
</body>
</html>