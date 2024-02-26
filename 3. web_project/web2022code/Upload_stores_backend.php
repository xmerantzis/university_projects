<?php
	session_start();//$_SESSION[]

	include 'Connector.php';

	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$all_stores = $_POST['data'];

		$all_stores = json_decode($all_stores,true);
		
		$datetime = date('Y-m-d H:i:s');
		
		$count = 0;

		for($i=0;$i<sizeof($all_stores);$i++)
		{
			$data_id = "null";
			$data_name = "null";
			$data_address = "null";
			$data_rating = "null";
			$data_rating_n = "null";
			$data_types = "null";
			$data_lat = "null";
			$data_lng = "null";

			if(isset($all_stores[$i]['id']))
				$data_id = $all_stores[$i]['id'];
			
			if(isset($all_stores[$i]['name']))
				$data_name = $all_stores[$i]['name'];
    
			if(isset($all_stores[$i]['address']))
				$data_address = $all_stores[$i]['address'];
	
			if(isset($all_stores[$i]['rating']))
				$data_rating = $all_stores[$i]['rating'];
			
			if(isset($all_stores[$i]['rating_n']))
				$data_rating_n = $all_stores[$i]['rating_n'];
    
			if(isset($all_stores[$i]['types']))
				$data_types = $all_stores[$i]['types'];
    
			if(isset($all_stores[$i]['lat']))
				$data_lat = $all_stores[$i]['lat'];
    
			if(isset($all_stores[$i]['lng']))
				$data_lng = $all_stores[$i]['lng'];

			$sql = "INSERT INTO stores (id, Name, Address,Rating,Rating_number,lat,lng,types,DATES) VALUES ('$data_id', '$data_name', '$data_address', '$data_rating', '$data_rating_n', '$data_lat',  '$data_lng','$data_types','$datetime')";
			mysqli_query($db,$sql);

			for($j=0; $j<sizeof($all_stores[$i]['days_name']); $j++)
			{
				  $day_name = $all_stores[$i]['days_name'][$j];
				  
				  $day0 = $all_stores[$i]['days_data'][$j][0];
				  $day1 = $all_stores[$i]['days_data'][$j][1];
				  $day2 = $all_stores[$i]['days_data'][$j][2];
				  $day3 = $all_stores[$i]['days_data'][$j][3];
				  $day4 = $all_stores[$i]['days_data'][$j][4];
				  $day5 = $all_stores[$i]['days_data'][$j][5];
				  $day6 = $all_stores[$i]['days_data'][$j][6];
				  $day7 = $all_stores[$i]['days_data'][$j][7];
				  $day8 = $all_stores[$i]['days_data'][$j][8];
				  $day9 = $all_stores[$i]['days_data'][$j][9];
				  $day10 = $all_stores[$i]['days_data'][$j][10];
				  $day11 = $all_stores[$i]['days_data'][$j][11];
				  $day12 = $all_stores[$i]['days_data'][$j][12];
				  $day13 = $all_stores[$i]['days_data'][$j][13];
				  $day14 = $all_stores[$i]['days_data'][$j][14];
				  $day15 = $all_stores[$i]['days_data'][$j][15];
				  $day16 = $all_stores[$i]['days_data'][$j][16];
				  $day17 = $all_stores[$i]['days_data'][$j][17];
				  $day18 = $all_stores[$i]['days_data'][$j][18];
				  $day19 = $all_stores[$i]['days_data'][$j][19];
				  $day20 = $all_stores[$i]['days_data'][$j][20];
				  $day21 = $all_stores[$i]['days_data'][$j][21];
				  $day22 = $all_stores[$i]['days_data'][$j][22];
				  $day23 = $all_stores[$i]['days_data'][$j][23];

				  $result = "INSERT INTO data_pop(id,day,data_0,data_1,data_2,data_3,data_4,data_5,data_6,data_7,data_8,data_9,data_10,data_11,data_12,data_13,data_14,data_15,data_16,data_17,data_18,data_19,data_20,data_21,data_22,data_23) VALUES ('".$all_stores[$i]['id']."', '$day_name', '$day0', '$day1', '$day2', '$day3','$day4','$day5', '$day6', '$day7', '$day8', '$day9', '$day10', '$day11', '$day12', '$day13', '$day14', '$day15', '$day16', '$day17', '$day18', '$day19', '$day20', '$day21', '$day22', '$day23')";
				  
				  if (mysqli_query($db,$result)) 
					echo "New record created successfully";
				  
				  else 
					  //echo "Error: " . $result . "<br>" . mysqli_error($result). "<br>";
			}
		}
}




?>
