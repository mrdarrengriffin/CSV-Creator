<?php
	session_start();
	error_reporting(E_ALL);
	date_default_timezone_set('Europe/London'); 
	require 'classes/ParseCSV.class.php';
	require 'classes/ItemHandler.class.php';
	require 'classes/Prepare.class.php';
	require 'classes/HTMLHelper.class.php';
	require 'classes/Flash.class.php';
	require 'classes/API.class.php';
	

	define('ITEM_PATH','items/');
	define('FILE_PATH','files/');
	
	
	
	$flash = new Flash;
	$api = new API("http://shop.klsonline.co.uk/","E7SDRHYGVW4U2S1JNXXILAFQRG2GRXY6");
	$ih = new ItemHandler(ITEM_PATH);
	$csv = new ParseCSV();
	$prep = new Prepare();
	$htmlhelper = new HTMLHelper();
	