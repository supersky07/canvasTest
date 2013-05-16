<?php
	header("content-type:text/html; charset=utf-8");
	$name = $_REQUEST['name'];
	$jsonArr = array();
	$tempArr = array();

	$con = mysql_connect("localhost","supersky07","supersky07");
	if (!$con){
	  	die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("supersky07", $con);
	mysql_set_charset('utf8',$con);

	$temp_result = mysql_query("SELECT DISTINCT(cir) from place where  name = '".$name."'");

	while($temp_row = mysql_fetch_array($temp_result)){
	  	$cir = $temp_row['cir'];
	  	$tempArr = array();

	  	$result = mysql_query("SELECT * FROM place where name like '".$name."' and cir = '".$cir."'");
		while($row = mysql_fetch_array($result)){
		  	$lng = $row['lng'];
		  	$lat = $row['lat'];
		  	$been = $row['been'];
		  	$color = $row['color'];
		  	
		  	$temp_json_arr = array("lat"=>$lat,"lng"=>$lng);
		  	array_push($tempArr, $temp_json_arr);
		}

		$temp_cir_arr = array("been"=>$been,"color"=>$color,"coordinate"=>$tempArr);
		array_push($jsonArr, $temp_cir_arr);
	}

	mysql_close($con);
	echo json_encode($jsonArr);
?>