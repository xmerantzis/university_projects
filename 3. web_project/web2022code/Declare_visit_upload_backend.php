<?php
	session_start();
	
	include "Connector.php";

	if($_SERVER["REQUEST_METHOD"]=="POST" && $_SESSION['loggedin'] == true)
	{
	  $katast_episk = $_POST['giorgos'];

	  date_default_timezone_set('Europe/Athens');
	  
	  $today_datetime = date('Y-m-d H:i:s');
	  
	  $store_latitude = $katast_episk['loc'][0];
	  
	  $store_longitude = $katast_episk['loc'][1];
	  
	  $store_name = $katast_episk['name'];
	  
	  $store_address = $katast_episk['address'];
	  
	  $store_id = $katast_episk['id'];
	  
	  $estimation = $katast_episk['estimation'];

	  $client_id = $_SESSION['client_id'];

	   mysqli_query($db,"INSERT INTO user_visits(User_id,id_store,Address,Name,lat,lng,Date_of_upload,estimation) VALUES('$client_id','$store_id','$store_address','$store_name','$store_latitude','$store_longitude','$today_datetime','$estimation')");
	}
 ?>
