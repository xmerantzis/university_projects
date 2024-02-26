<?php
	session_start(); //$_SESSION[]

	include 'Connector.php';

	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$username=$_POST["username"];
		$password=$_POST["password"];

		$res = mysqli_query($db, "SELECT * FROM users WHERE Usersusername = '$username'");

		if (mysqli_num_rows($res) === 1)
		{
			$row = mysqli_fetch_assoc($res);
			
			if(password_verify($password,$row['Userspwd']))
			{
				$_SESSION['client_id'] =$row['UsersId'];
				$_SESSION['name'] = $username;
				$_SESSION['loggedin'] = true;
				
				$client_id = $_SESSION['client_id'];

				$role_result = mysqli_query($db,"SELECT role_id FROM user_roles WHERE user_id = '$client_id' ");
				$role = mysqli_fetch_array($role_result);
				
				$_SESSION['role'] = $role['role_id'];
				
				if($role['role_id'] == 0)
					echo "user";
				else
					echo "admin";
			} 
			else
				echo "Wrong Password";
		} 
		else
			echo "Wrong Username";
	}
?>
