<?php
	
	require 'init.php';
	
	$ih->loadItem($_GET['item']);
	
	$data['name'] = $_GET['itemName'];
	
	
	//$ih->edit($data);
	$ih->saveItem();
	
	