<?php
	session_start();
	include 'db.php';
	
	$email = $_POST['email'];
	$key = "OpenRoom247";
	$timestamp = date("dmyhis");
	if($email!= "")
	{
		$email = mysqli_real_escape_string($connection, stripslashes($email)); // cleans up email data gotten from post
		$hash = password_hash($key,PASSWORD_DEFAULT);
		if(filter_var($email,FILTER_VALIDATE_EMAIL))
		{
				$query = mysqli_query($connection, "SELECT * FROM users WHERE email='$email'") or die("Failed to query database".mysqli_error($connection));
				$rows = mysqli_fetch_array($query);
				if($rows['email']==$email){
					$message = "Please click this link to reset email \n". "http://rentaplace/reset_password.php?email=$email&val=$timestamp&value=".$hash."\nThis link expires in 24 hours.\nIgnore this message if you did not request for a password reset.";
					mail($email, "Reset email", $message);
					
					$_SESSION['successMessage'] = "Email sent successfully. Please check your mailbox for reset link";
					header("Location: /forgot_password.php");
				}
				else{
					$_SESSION['errorMessage'] = "email not found in database";
					header("Location: /forgot_password.php");
				}
		}
		else{
				$_SESSION['errorMessage'] = "invalid email pattern";
				header("Location: /forgot_password.php");
			}
	}
	else{
			$_SESSION['errorMessage'] = "Email field must not be empty";
			header("Location: /forgot_password.php");
		}
?>