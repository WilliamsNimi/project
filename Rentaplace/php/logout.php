<?php
	session_start();
	session_destroy(); //destroys session and sends user back to index page
	header("Location: /index.php");
?>