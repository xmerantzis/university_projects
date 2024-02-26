<?php
	session_start();
	
	include 'Connector.php';

	function check_difference($differenc)
	{
	  if($differenc<14 && $differenc >=0 )
		return 0;
	  else
		return 1;
	}

	if($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['loggedin'] == true)
	{

	  $count=array();
	  $for_loops=1;

	  $covid_case = $_POST['positive'];
	  $real_date = $_POST['date'];
	  $client_id = $_SESSION['client_id'];
	  
	 
	  date_default_timezone_set('Europe/Athens');

	  $datetime = date('Y-m-d H:i:s');
	  $datetime = new Datetime($datetime);

	  $real_date = strtotime($real_date);
	  $real_date_string = date('Y-m-d H:i:s', $real_date);
	  $real_date = new Datetime($real_date_string);


	  $diff = date_diff($real_date, $datetime);


	  if($diff->invert==1)
	  {
		echo 2;
	  }
	  else 
	  {
	
		$date = mysqli_query($db,"SELECT Covid_date FROM covid_cases WHERE id='$client_id' ");

		if(mysqli_num_rows($date) == 0)
		{
		  mysqli_query($db,"INSERT INTO covid_cases(id,covid_case,Covid_date) VALUES('$client_id',1,'$real_date_string')");
		  echo $client_id;
		}
		
		
		elseif(mysqli_num_rows($date) == 1)
		{

		  $date1 = mysqli_fetch_assoc($date);

		  $dt1 = new Datetime($date1['Covid_date']);
		  $date1 = $dt1->format('Y-m-d H:i:s');
		  $date1 = new Datetime($date1);

		  $interval =date_diff($date1, $real_date);
		  $days =$interval->days;

		  if($days<14 && $days>=0)
		  {
			echo 1;
		  } 
		  else
		  {
			$result = mysqli_query($db,"INSERT INTO covid_cases(id,covid_case,Covid_date) VALUES('$client_id',1,'$real_date_string')");
			echo $client_id;

		  }
	  }
	
	  else
	  {
		$multiple_dates = array();

		while($row = mysqli_fetch_assoc($date))
		{
		  array_push($multiple_dates, $row);
		}


		for($i=0;$i<sizeof($multiple_dates);$i++)
		{

		  $mul_date = new Datetime($multiple_dates[$i]['Covid_date']);
		  $diff = date_diff($mul_date, $real_date);
		  $difference = $diff->days;

		  array_push($count,check_difference($difference));


			  if($for_loops == sizeof($multiple_dates) && in_array(0,$count))
			  {
				echo 1;
			  }
			  else
			  {
				if($for_loops == sizeof($multiple_dates))
				{
				  mysqli_query($db,"INSERT INTO covid_cases(id,covid_case,Covid_date) VALUES ('$client_id',1,'$real_date_string')");
				  echo $client_id;
				}
			  }
				$for_loops=$for_loops + 1;
		}
	  }
	  }

	}

?>
