<?php
	
	Class ItemHandler{
		
		public $dataPath;
		public $filePath;
		public $extension = ".json";
		public $allItems;
		private $currentItem;
		private $currentItemData;
		
		public function __construct($dataPath = 'items/',$filePath = 'files/'){
			$this->dataPath = $dataPath;
			$this->filePath = $filePath;
			
			if(!is_dir($dataPath)){mkdir($dataPath);}
			if(!is_dir($filePath)){mkdir($filePath);}
			
			$items = scandir($this->dataPath);
			unset($items[0],$items[1]);
			foreach($items as $i){
				$fileParts = explode(".",$i);
				if($fileParts[1] == "json"){
					$this->allItems[$i] = json_decode(file_get_contents($this->dataPath.$i),true);
					$this->allItems[$i]['itemname'] = $i;
				}
			}
		}
		
		
		
		public function loadItem($itemName){
			$path = $this->dataPath.$itemName;
			if(!file_exists($path)){touch($path);}
			$this->currentItem = $itemName;
			$this->currentItemData = json_decode(file_get_contents($path),true);
		}
		
		public function createItem($itemName){
			$tmpData['name'] = $itemName;
			$tmpData['filename'] = null;
			$tmpData['prepared'] = false;
			$tmpData['run'] = false;
			$tmpData['importRows']['core'] = array();
			$tmpData['importRows']['features'] = array();
			$file = strtolower(str_replace(" ","_",$itemName)).$this->extension;
			$path = $this->dataPath.$file;
			file_put_contents($path,json_encode($tmpData));
			return $file;
		}
		
		public function setItemFilename($filename){
			$this->currentItemData['prepared'] = false;
			$this->currentItemData['run'] = false;
			$this->currentItemData['filename'] = $filename;
		}
		
		public function saveItem(){
			$path = $this->dataPath.$this->currentItem;
			file_put_contents($path,json_encode($this->currentItemData));
		}
		
		public function getData(){
			return $this->currentItemData;
		}
		
		public function edit($data){
			foreach($data as $index => $value){
				$this->currentItemData[$index] = $value;
			}
		}
		
		public function getAllItems(){
			return $this->allItems;	
		}
		
		public function setImportDataRows($core,$features = array()){
			
			$this->currentItemData['prepared'] = true;		
			$this->currentItemData['importRows']['core'] = $core;		
			$this->currentItemData['importRows']['features'] = $features;	
			$this->saveItem();
		}
		
		public function removeOldFile(){
			unlink($this->filePath.$this->currentItemData['filename']);
		}
		
		public function getImportDataRows(){
			return $this->currentItemData['importRows'];
		}
		
		public function output($string){
			$outputFilename = strtolower(str_replace(" ","_",$this->currentItemData['name']))."-output.csv";
			
			$path = $this->dataPath.$outputFilename;
			file_put_contents($path,$string);
			
			$this->currentItemData['outputFile'] = $outputFilename;
			$this->currentItemData['run'] = time();
			$this->saveItem();
			
		}
		
		public function cleanFile(){
			$data = file_get_contents($this->filePath.$this->currentItemData['filename']);
			$data = utf8_encode($data);
			file_put_contents($this->filePath.$this->currentItemData['filename'],$data);
		}
		
	}													