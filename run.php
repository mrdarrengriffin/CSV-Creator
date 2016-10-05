<?php
	
	require 'init.php';
	
	$ih->loadItem($_GET['item']);
	$data = $ih->getData();
	$csv->parse(FILE_PATH.$data['filename']);
	
	$cc = $data['importRows']['core'];
	$cf = $data['importRows']['features'];
	
	foreach($csv->data as $a){
		$v = array_values($a);
		$item = null;
		
		$item['make'] = $cc['make'];
		$item['model'] = $v[$cc['model']];
		$item['type'] = $v[$cc['type']];
		$item['nettPrice'] = $v[$cc['nettPrice']];
		$item['priceIncrease'] = $cc['priceIncrease'];
		$item['salesDescription'] = $cc['salesDescription'];
		$item['manufacturerId'] = $cc['manufacturerId'];
		
		$priceResale = ($item['nettPrice'] * (($item['priceIncrease'] / 100) + 1));
		$item['priceResale'] = $priceResale;

		
		$item['imageLibrary'] = $cc['imageLibrary'];
		$item['imageFilename'] = $v[$cc['imageFilename']];
		$item['width'] = $v[$cc['width']];
		$item['depth'] = $v[$cc['depth']];
		$item['height'] = $v[$cc['height']];
		
		$item['features'] = array();
		
		foreach($cf as $featureName=>$featureValue){
			if($v[$featureValue] == ""){continue;}
			$item['features'][$featureName] = $v[$featureValue];
		}
		
		$items[] = $item;
	}
	
		$itemLine = array();
	foreach($items as $item){
		$core = array();
		$features = array();
		
		$core[] = $item['make'];
		$core[] = $item['model'];
		$core[] = $item['type'];
		$core[] = $item['salesDescription'];
		$core[] = $item['priceResale'];
		$core[] = $item['imageLibrary'];
		$core[] = $item['imageFilename'];
		$core[] = $item['width'];
		$core[] = $item['depth'];
		$core[] = $item['height'];
		$core[] = $item['manufacturerId'];
		
		foreach($item['features'] as $feature=>$value){
			$features[] = "{$feature}:{$value}";
		}
		
		$itemLine[] = implode(";",$core).";".implode(",",$features);		
		
	}
	
	$output = implode("\r\n",$itemLine);
	
	$ih->output($output);
	
	$flash->set("success","The data has been successfully run. Click 'download' to get the output file for the PrestaShop Import tool.");
	
	header("Location: items.php");