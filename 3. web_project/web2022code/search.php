<?php

include 'Connector.php';

$data = array();
$today = date("l");//Current day

if(!isset($_GET['q']) or empty($_GET['q']))
	die( json_encode(array('ok'=>0, 'errmsg'=>'specify q parameter') ) );

$query = mysqli_query($db,"SELECT s.id,s.lat,s.lng,s.Name,s.types,s.Address,d.data_0,d.data_1,d.data_2,d.data_3,d.data_4,d.data_5,d.data_6,d.data_7,d.data_8,d.data_9,d.data_10,d.data_11,d.data_12,d.data_13,d.data_14,d.data_15,d.data_16,d.data_17,d.data_18,d.data_19,d.data_20,d.data_21,d.data_22,d.data_23,d.day FROM stores AS s INNER JOIN data_pop AS d WHERE s.id=d.id && d.day = '$today' ");

while($row = mysqli_fetch_assoc($query)){
	array_push($data, array('loc'=>[$row['lat'], $row['lng']], 'title'=>$row['Name'],'id'=>$row['id'], 'address'=>$row['Address'], 'popular_times'=>[$row['data_0'], $row['data_1'], $row['data_2'], $row['data_3'], $row['data_4'], $row['data_5'], $row['data_6'], $row['data_7'], $row['data_8'], $row['data_9'], $row['data_10'], $row['data_11'], $row['data_12'], $row['data_13'], $row['data_14'], $row['data_15'], $row['data_16'], $row['data_17'], $row['data_18'], $row['data_19'], $row['data_20'], $row['data_21'], $row['data_22'], $row['data_23']]));
}

function searchInit($text)	//search initial text in titles
{
	$reg = "/^".$_GET['q']."/i";	//initial case insensitive searching
	return (bool)@preg_match($reg, $text['title']);
}

$fdata = array_filter($data, 'searchInit');	//filter data
$fdata = array_values($fdata);	//reset $fdata indexs

$JSON = json_encode($fdata,true);

@header("Content-type: application/json; charset=utf-8");

if(isset($_GET['callback']) and !empty($_GET['callback']))	//support for JSONP request
	echo $_GET['callback']."($JSON)";
else
	echo $JSON;	//AJAX request



?>
