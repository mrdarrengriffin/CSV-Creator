<?php
	
	require 'init.php';
	
	$ih->loadItem($_POST['item']);
	$features = array();
	if(isset($_POST['feature'])){
		foreach($_POST['feature'] as $f){
			$features[$f['name']] = $f['colNum'];
		}
	}
	
	$ih->setImportDataRows($_POST['data'],$features);
	
	$ih->saveItem();
	
	$flash->set("success","This item has been successfully saved.");	
	
	if(isset($_POST['save'])){
		header("Location: prepare.php?item=".$_POST['item']);
		}elseif(isset($_POST['saveAndRun'])){
		header("Location: run.php?item=".$_POST['item']);
	}		