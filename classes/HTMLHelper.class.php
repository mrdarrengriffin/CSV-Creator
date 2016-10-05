<?php
	
	Class HTMLHelper{
		
		public function formatSelect($data,$name = "input1",$classes = ""){
			$elem = '<select class="form-control" name="'.$name.'">';
			foreach($data as $index => $value){
				$elem .= '<option value="'.$index.'">'.$value.'</option>';
			}
			$elem .= '</select>';
			return $this->strip($elem);
		}
		
		public function formatOptions($data,$selectedValue = ""){
			$elem = '';
			foreach($data as $index => $value){
				if($index == $selectedValue){$selected = "selected";}
				$elem .= '<option value="'.$index.'" '.$selected.'>'.$value.'</option>';
				$selected = "";
			}
			return $this->strip($elem);
		}
		
		public function formatManufacturers($data,$selectedValue = ""){
			foreach($data as $manufacturer){
				if($manufacturer['id'] == $selectedValue){$selected = "selected";}
				$elem .= '<option value="'.$manufacturer['id'].'" '.$selected.'>['.$manufacturer['id'].'] '.$manufacturer['name'].'</option>';
				$selected = "";
			}
			return $this->strip($elem);
		}
		
		public function strip($string){
			return str_replace(array("'"),"",$string);
			}
	}				