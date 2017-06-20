<?php
	$connection = mysqli_connect("localhost", "root", "");// Establishing Connection with Server by passing server_name, user_id and password as a parameter
	$db = mysqli_select_db($connection, "rentaplace"); //select database
?>