<?php
	
	require 'init.php';

	$name = $_POST['itemName'];
	
	$file = $ih->createItem($name);

	$flash->set("success","{$name} has been created successfully.");
	
	if(isset($_POST['saveOnly'])){
	header("Location: items.php?item=".$file);
	}elseif(isset($_POST['saveAndUpload'])){
	header("Location: upload.php?item=".$file);
	}