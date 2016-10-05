<?php
	
	Class Prepare{
		
		public $csvData;
		
		public $headersWithFirstRow;
		
		public function setCSVData($csvData){
			$this->csvData = $csvData;
			$this->setHeadersWithFirstRow();
		}
		
		public function setHeadersWithFirstRow(){
			$col = 0;
			foreach($this->csvData[0] as $name => $value){
				if(strlen($value) >= 100){$value = substr($value,0,50)."...";}
				$out[$col] = "[{$col}] {$name} ({$value})";
				$col++;
			}
			$this->headersWithFirstRow = $out;
		}
		
		public function getHeadersWithFirstRow(){
			return $this->headersWithFirstRow;
		}
		
		public function getFirstRow(){
		$col = 0;
		$out = array();
			foreach($this->csvData[0] as $name => $value){
				if(strlen($value) >= 100){$value = substr($value,0,50)."...";}
				$out[$col] = "{$value}";
				$col++;
			}
			return $out;
		}
		
		public function getHeaders(){
			$col = 0;
			foreach($this->csvData[0] as $name => $value){
				if(strlen($value) >= 100){$value = substr($value,0,50)."...";}
				$out[$col] = "{$name}";
				$col++;
			}
			return $out;
			}
		
	}			