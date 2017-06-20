<?php
	session_start();
	include 'db.php';
	/* Variables declaration*/
	$email = $_POST['email'];
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$message = $_POST['message'];
	$mobileNum = $_POST['phoneNumber'];
	$emailMessage ="";
	
	if($email != "" && $firstName != "" && $message != "" && $mobileNum != "" && $lastName != "")
	{
		/*Cleans up post data to avoid sql injections*/
		$email = mysqli_real_escape_string($connection, stripslashes($email));
		$firstName = mysqli_real_escape_string($connection, stripslashes($firstName));
		$lastName = mysqli_real_escape_string($connection, stripslashes($lastName));
		$message = mysqli_real_escape_string($connection, stripslashes($message));
		$mobileNum = mysqli_real_escape_string($connection, stripslashes($mobileNum));
		
		if(filter_var($email,FILTER_VALIDATE_EMAIL))
		{
			$emailMessage = "EMAIL: ".$email."\n". "First Name: ".$firstName. "\n"."Last Name: ". $lastName."\n". "Mobile Number: ". $mobileNum. "\n"."Message: ".$message;
			$emailMessage = wordwrap($emailMessage,100);
			mail("williamson.nimi@gmail.com", "OpenRoom Client", $emailMessage); //PHP mail function sends email to admin with feedback form details
			$_SESSION['successMessage'] = "Thank you for your feedback. We will get back to you shortly";
			header("Location: /feedback.php");
		}
		else {
			$_SESSION['errorMessage'] = "Email is invalid";
			header("Location: /feedback.php");
		}
	}
	else{
		$_SESSION['errorMessage'] = "All fields should be filled";
		header("Location: /feedback.php");
	}
	
?>