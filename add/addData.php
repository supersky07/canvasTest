<?php
	header("content-type:text/html; charset=utf-8");
	$data = $_REQUEST['data'];
	$name = $_REQUEST['name'];
	$cir = $_REQUEST['cir'];
	$been = $_REQUEST['been'];
	$id = $_REQUEST['id'];

	$con = mysql_connect("localhost","supersky07","supersky07");
	if (!$con){
	  	die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("supersky07", $con);
	mysql_set_charset('utf8',$con);

	foreach ($data as $temp){
		$sql = "insert into place (id,name,lng,lat,cir,been) values ('".$id."', '".$name."', '".$temp['lng']."','".$temp['lat']."','".$cir."','".$been."')";
		if (!mysql_query($sql,$con)){
		  	die('Error: ' . mysql_error());
		}
	}


	mysql_close($con);

	echo 'Success';
?>