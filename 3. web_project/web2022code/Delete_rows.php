<?php
	session_start();

	include 'Connector.php';

	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
	  $bool_val = $_POST['bool_value'];

	  if($bool_val == true)
	  {
		if (mysqli_query($db,"DELETE from stores")) 
		    echo "stores deleted successfully";
		else
			echo "Error";
	  }
	}
?>
