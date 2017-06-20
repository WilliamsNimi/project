<?php
	session_start();
	include 'db.php';
	
	$email = $_POST['email'];
	$name = $_POST['name'];
	$message = $_POST['message'];
	$mobileNum = $_POST['mobileNum'];
	$emailMessage ="";
	
	if($email != "" && $name != "" && $message != "" && $mobileNum != "")
	{
		/*Cleans up post data to avoid sql injections*/
		$email = mysqli_real_escape_string($connection, stripslashes($email));
		$name = mysqli_real_escape_string($connection, stripslashes($name));
		$message = mysqli_real_escape_string($connection, stripslashes($message));
		$mobileNum = mysqli_real_escape_string($connection, stripslashes($mobileNum));
		
		if(filter_var($email,FILTER_VALIDATE_EMAIL))
		{
			$emailMessage = "Email: ".$email."\n". "Name: ".$name. "\n"."Phone Number: ". $mobileNum. "\n"."Message: ". $message;
			$emailMessage = wordwrap($emailMessage,100);
			mail("williamson.nimi@gmail.com", "OpenRoom Client", $emailMessage); //Sends email to admin with contact form detail as content
			$_SESSION['successMessage'] = "Email sent successfully";
			header("Location: /contact.php");
		}
		else {
			$_SESSION['errorMessage'] = "Email is invalid";
			header("Location: /contact.php");
		}
	}
	else{
		$_SESSION['errorMessage'] = "All fields should be filled";
		header("Location: /contact.php");
	}
	
?>