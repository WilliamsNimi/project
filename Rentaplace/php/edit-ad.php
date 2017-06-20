<?php
	session_start();
	include 'db.php';
	$name = $_POST['name'];
	$phoneNumber = $_POST['mobileNum'];
	$town = $_POST['location'];
	$category = $_POST['category'];
	$adTitle = $_POST['title'];
	$adDescription = $_POST['description'];
	$price = $_POST['price'];
	$id = $_POST['id'];
	$fileSize = 3000000;
	
	if(isset($_SESSION['email']))
	{
		if($name != "" && $phoneNumber != "" && $adTitle !="" && $adDescription != "")
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
			$id - mysqli_real_escape_string($connection, stripslashes($id));
			$date = date("d.m.Y h:i:sa");
			
			
			$imagePath = "uploads/".basename($_FILES['fileselect']['name']);//gets and stores image path
			$photo = $_FILES['fileselect']['name'];
			$imageFile = pathinfo($_FILES['fileselect']['name']);//gets file extension
			$imageFileType = strtolower($imageFile['extension']);
			if($_FILES['fileselect']['size']<3000000)
			{
				if($imageFileType=="jpg" || $imageFileType=="jpeg" || $imageFileType=="gif" || $imageFileType=="png")
				{
					move_uploaded_file($_FILES['fileselect']['tmp_name'],$imagePath); //moves image to uploads folder.
					$photo = sha1(time().$imageFile['filename']);
					$photo = $photo.".".$imageFile['extension'];
					rename($imagePath, "uploads/".$photo);
					
					$updateQuery = mysqli_query($connection, "UPDATE ads SET id='$id',email='$email',adTitle='$adTitle',adCategory='$category',adDescription='$adDescription',MobileNum='$phoneNumber',
																Photos='$photo',Town='$town',name='$name',date='$date',price='$price' WHERE id='$id' ");
					header("Location: /profile.php");
				}
				else
				{
					$_SESSION['errorMessage'] = "File format not supported (Supported formats: jpg, jpeg, gif, png)";
					header("Location: /edit-ad.php?edit_id=$id");
				}
			}
			else
			{
				$_SESSION['errorMessage'] = "File size too large";
				header("Location: /edit-ad.php?edit_id=$id");
			}
		}
		else
		{
			$_SESSION['errorMessage'] = "Please input all the required details";
			header("Location: /edit-ad.php");
		}
	}
	else
	{
		header("Location: /login.php");
	}
	
?>	