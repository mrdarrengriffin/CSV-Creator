<?php
	
	require 'init.php';
	
	
	$manufacturers = $api->makeRequest($api->getRequestUrl("manufacturers",array("display" => "full")));
	
	file_put_contents("api_data/manufacturers.json",json_encode($manufacturers['manufacturers']));

	$flash->set("success","The data has been successfully been retrieved from your PrestaShop store.");
	
header("Location:items.php");