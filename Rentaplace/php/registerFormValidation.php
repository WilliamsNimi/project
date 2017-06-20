<?php

	session_start();
	include 'db.php';
	/*Variables declaration*/
	$email=$_POST['email'];
	$password1=$_POST['password'];
	$password2=$_POST['password2'];
	
	if($email!="" && $password1 !="" && $password2 != "")// checks if email or password was sent empty
	{
		/*Cleans up post data to avoid sql injections*/
		$email = mysqli_real_escape_string($connection, stripslashes($email));
		$password1 = mysqli_real_escape_string($connection, stripslashes($password1));
		$password2 = mysqli_real_escape_string($connection, stripslashes($password2));
		
		$email = strtolower($email);
		
		if(filter_var($email,FILTER_VALIDATE_EMAIL))
		{
			$query = mysqli_query($connection, "SELECT * FROM users WHERE email='$email'") or die("Failed to query database".mysqli_error($connection));
			$rows = mysqli_fetch_array($query);
			if($rows['email'] != $email)
			{
				if(strlen($password1)>=6)
				{
					if($password1 == $password2)
					{
						$password1 = password_hash($password1, PASSWORD_DEFAULT);
						//adds email and password to database
						$sql = mysqli_query($connection,"INSERT INTO users(email,password) VALUES('$email','$password1')");
						$_SESSION['successMessage'] = "Your account have been registered. \n You can now login";
						header("Location: /login.php"); //TODO add success message and prompt user to go to email and verify signup
					}
					else{
						$_SESSION['errorMessage'] =  "passwords do not match";
						header("Location: /register.php");
					}
					mysqli_close($connection); // Closing Connection to database
				}
				else 
				{
					$_SESSION['errorMessage']= "Password must be 6 or more characters";
					header("Location: /register.php");
				}
			}
			else{
			$_SESSION['errorMessage'] = "Email already exist";
			header("Location: /register.php");
			}
			
		}
		else{
			$_SESSION['errorMessage'] = "Please Check email pattern";
			header("Location: /register.php");
		}
	}
	else {
		die("Email or Pasword invalid");
	}
		
	

?>