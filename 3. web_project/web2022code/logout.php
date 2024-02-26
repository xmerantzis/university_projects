<?php
	session_destroy();
	unset($_SESSION['username']);
	unset($_SESSION['loggedin']);
	$_SESSION['message']="You are now logged out";
	header("location:Login_form.php");
?>
