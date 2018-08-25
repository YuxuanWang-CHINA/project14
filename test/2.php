<?php
	$json_file = "../information/flights.json";
	$json_string = file_get_contents($json_file);
	$json_result = json_decode($json_string);
	//读取解码json文件
	//var_dump($json_result);

	
?>