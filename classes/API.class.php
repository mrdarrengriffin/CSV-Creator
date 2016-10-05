	<?php
	
	Class API{
		
		public $shopUrl;
		public $apiKey;
		
		public function __construct($shopUrl,$key){
			$this->shopUrl = $shopUrl;
			$this->apiKey = $key;
			
			if(!is_dir("api_data")){mkdir("api_data");}
		}
		
		public function getRequestUrl($module,$params){
			$url = rtrim($this->shopUrl,"/")."/api/";
			$url .= $module."?ws_key=".$this->apiKey;
			$url .= "&".http_build_query($params);
			$url .= "&output_format=JSON";
			return $url;
		}
		
		public function getManufacturers(){
			return json_decode(file_get_contents("api_data/manufacturers.json"),true);
		}
		
		public function makeRequest($url){
			return json_decode(file_get_contents($url),true);
		}
		
	}
