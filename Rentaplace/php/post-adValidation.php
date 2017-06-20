<?php
	session_start();
	include'db.php';
	$name = $_POST['name'];
	$phoneNumber = $_POST['mobile-num'];
	$town = $_POST['location'];
	$category = $_POST['category'];
	$adTitle = $_POST['title'];
	$adDescription = $_POST['description'];
	$price = $_POST['price'];
	$date = date("d.m.Y h:i:sa");
	
	if(isset($_SESSION['email']))
	{
		if($name != "" && $phoneNumber != "" && $town != "" && $category != "" && $adTitle !="" && $adDescription != "")
		{
			/*Cleans up post data to avoid sql injections*/
			$name = mysqli_real_escape_string($connection,stripslashes($name));
			$email = $_SESSION['email'];
			$phoneNumber = mysqli_real_escape_string($connection,stripslashes($phoneNumber));
			$town = mysqli_real_escape_string($connection,stripslashes($town));
			$adTitle = strtoupper(mysqli_real_escape_string($connection,stripslashes($adTitle)));
			$category = mysqli_real_escape_string($connection,stripslashes($category));
			$adDescription = mysqli_real_escape_string($connection,stripslashes($adDescription));
			$price = mysqli_real_escape_string($connection,stripslashes($price));
			
			$photo = $_FILES['fileselect']['name'];
			$imageFile = pathinfo($_FILES['fileselect']['name']);
			$imageFileType = strtolower($imageFile['extension']);
			$imagePath = "uploads/".basename($_FILES['fileselect']['name']);//gets and stores image path
			if($_FILES['fileselect']['size']<3000000)
			{
				if($imageFileType=="jpg" || $imageFileType=="jpeg" || $imageFileType=="gif" || $imageFileType=="png")
				{
					move_uploaded_file($_FILES['fileselect']['tmp_name'],$imagePath); //moves image to uploads folder.
					$photo = sha1(time().$imageFile['filename']);
					$photo = $photo.".".$imageFile['extension'];
					rename($imagePath, "uploads/".$photo);
					
					$insertQuery = mysqli_query($connection, "INSERT INTO ads(email,adTitle,adCategory,adDescription,Photos,name,MobileNum,Town,date,price) 
														VALUES('$email','$adTitle','$category','$adDescription','$photo','$name','$phoneNumber','$town','$date','$price')") or die(mysql_error());
					header("Location: /profile.php");
				}
				else
				{
					$_SESSION['errorMessage'] = "File format not supported";
					header("Location: /post-ad.php");
				}
			}
			else
			{
				$_SESSION['errorMessage'] = "File size too large";
				header("Location: /post-ad.php");
			}
		}
		else
		{
			$_SESSION['errorMessage'] = "Please input all the required details";
			header("Location: /post-ad.php");
		}
	}
	else
	{
		header("Location: /login.php");
	}
	
?>	