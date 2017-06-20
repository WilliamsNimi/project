<?php

	session_start();
	include 'db.php';
	/* Variables declaration*/
	$email=$_POST['email'];
	$key = "OpenRoom247";
	$timestamp = $_POST['timestamp'];
	$password1=$_POST['password'];
	$password2=$_POST['confirm_password'];
	$resetHash = $_POST['resetHash'];
	
	
	
	if($password1 !="" && $password2 != "")// checks if email or password was sent empty
	{
		/*Cleans up post data to avoid sql injections*/
		$email = mysqli_real_escape_string($connection, stripslashes($email));
		$password1 = mysqli_real_escape_string($connection, stripslashes($password1));
		$password2 = mysqli_real_escape_string($connection, stripslashes($password2));
		$timestamp = mysqli_real_escape_string($connection,stripslashes($timestamp));
		$resetHash = mysqli_real_escape_string($connection,stripslashes($resetHash));
		
		$hash = password_verify($key,$resetHash);
		
		$email = strtolower($email); //ensures email is always the same letter case
		
		if(filter_var($email,FILTER_VALIDATE_EMAIL))
		{
			if((date("dmyhis")-$timestamp) <= 10000000)
			{
				if($hash)
				{
					$query = mysqli_query($connection, "SELECT * FROM users WHERE email='$email'") or die("Failed to query database".mysqli_error($connection));
					$rows = mysqli_fetch_array($query);
					if($rows['email'] == $email)
					{
						if(strlen($password1)>=6)
						{
							if($password1 == $password2)
							{
								$password1 = password_hash($password1, PASSWORD_DEFAULT);
								//add email and password to database
								$sql = mysqli_query($connection,"UPDATE users SET password='$password1' WHERE email='$email'");
								$_SESSION['successMessage'] = "Password reset Successful. \n You can now login.";
								header("Location: /login.php"); //TODO add success message and prompt user to login
							}
							else{
								$_SESSION['errorMessage'] =  "passwords do not match";
								header("Location: /reset_password.php");
							}
							mysqli_close($connection); // Closing Connection
						}
						else 
						{
							$_SESSION['errorMessage']= "Password must be 6 or more characters";
							header("Location: /reset_password.php");
						}
					}
					else{
						$_SESSION['errorMessage'] = "Email Not found";
						header("Location: /reset_password.php");
					}
				}
				else{
						$_SESSION['errorMessage'] = "Invalid parameters\n Please request for a new password reset link";
						header("Location: /error.php");
					}
			}
			else{
						$_SESSION['errorMessage'] = "Link expired\n Please request for a new password reset link";
						header("Location: /error.php");
					}
		}
		else{
			$_SESSION['errorMessage'] = "Please Check email pattern";
			header("Location: /reset_password.php");
		}
	}
	else {
		die("Password field should not be empty");
	}
	
?>