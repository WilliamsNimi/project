<?php
	session_start();
	include 'db.php';
	/*Variable declaration*/
	$email=$_POST['email'];
	$password=$_POST['password'];
	if(!empty($email) || !empty($password))// checks if email or password was sent empty
	{
		/*Cleans up post data to avoid sql injections*/
		$email = mysqli_real_escape_string($connection, stripslashes($email));
		$password = mysqli_real_escape_string($connection, stripslashes($password));
		$email = strtolower($email);
		
		if(filter_var($email,FILTER_VALIDATE_EMAIL))
		{
			if(strlen($password)>=6)
			{
				// SQL query to fetch information of registered users and finds user match.
				$query = mysqli_query($connection, "select * from users WHERE email='$email'") or die("Failed to query database".mysqli_error($connection));
				$rows = mysqli_fetch_array($query);
				$password = password_verify($password,$rows['password']);
				if($password){
					$_SESSION['email'] = $email;
					header("Location: /profile.php");
				}
				else{
					$_SESSION['errorMessage'] =   "Email or Password incorrect";
					header("Location: /login.php");
				}
				mysqli_close($connection); // Closing Connection to database
			}
			else{
				$_SESSION['errorMessage'] = "Password should be more than 6 characters";
				header("Location: /login.php");
			}
		}
		else {
			$_SESSION['errorMessage'] =  "Please Check email pattern";
			header("Location: /login.php");
		}
		
	}
	else
		die("Please enter username or password");

?>