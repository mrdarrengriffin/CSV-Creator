<?php
	
	Class Flash{
		
		public $flash;
		
		public function __construct(){
			$this->flash = $_SESSION['flash'] ?: null;	
			unset($_SESSION['flash']);
		}
		
		public function set($type,$message){
			$_SESSION['flash']['type'] = $type;
			$_SESSION['flash']['message'] = $message;
			return true;
		}
		
		public function get(){
			return $this->flash;
		}
		
		public function willShow(){
			if(isset($this->flash)){
				return true;
			}
			return false;
		}
		
	}
