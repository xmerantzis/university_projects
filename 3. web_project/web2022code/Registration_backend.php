<?php
	session_start();

	include 'Connector.php';

	$username=$_POST["username"];
	$email=$_POST["email"];
	$password1=$_POST["password"];

	$user_check="SELECT Usersusername,Usersemail FROM users WHERE Usersusername = '$username' or Usersemail = '$email'" ;
	$query = mysqli_query($db,$user_check);


	if(mysqli_num_rows($query) != 0)
		echo 1;

	else 
	{
	
		$pwd= password_hash($password1,PASSWORD_DEFAULT);
		
		mysqli_query($db,"INSERT INTO users(Usersusername,Usersemail,Userspwd) VALUES ('$username','$email','$pwd')");

		$result_1 = mysqli_query($db,"SELECT UsersId from users WHERE Usersusername = '$username'");
		
		while($row = mysqli_fetch_array($result_1))
		{
			$id = $row['UsersId'];
			mysqli_query($db, "INSERT INTO user_roles VALUES('$id','0')");
		}
		
		echo 0;
	}


?>
