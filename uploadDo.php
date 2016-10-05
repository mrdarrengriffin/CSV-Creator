<?php
	
	require 'init.php';
	$ih->loadItem($_POST['itemName']);
	
	$fileInputName = "inputFile";
	$destination = "files/";
	
	if ( isset($_POST["upload"]) OR isset($_POST['uploadAndPrepare'])) {
		
		if ( isset($_FILES[$fileInputName])) {
			
            //if there was an error uploading the file
			if ($_FILES[$fileInputName]["error"] > 0) {
				echo "Return Code: " . $_FILES[$fileInputName]["error"] . "<br />";
				
			}
			else {
				//Print file details
				echo "Upload: " . $_FILES[$fileInputName]["name"] . "<br />";
				echo "Type: " . $_FILES[$fileInputName]["type"] . "<br />";
				echo "Size: " . ($_FILES[$fileInputName]["size"] / 1024) . " Kb<br />";
				echo "Temp file: " . $_FILES[$fileInputName]["tmp_name"] . "<br />";
				
				//if file already exists
				if (file_exists($destination . $_FILES[$fileInputName]["name"])) {
					echo $_FILES[$fileInputName]["name"] . " already exists. ";
				}
				else {
					$newFilename = md5(date('Y-m-d H:i:s:u')).".".end((explode(".", $_FILES[$fileInputName]["name"])));
					move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $destination . $newFilename);
					echo "Stored in: " . $destination . $_FILES[$fileInputName]["name"] . "<br />";
					$ih->removeOldFile();
					$ih->setItemFilename($newFilename);
					$ih->saveItem();
					$ih->cleanFile();
					
					
					$flash->set("success","Data file has been uploaded successfully. The old file associated has been removed.");
					
					if(isset($_POST['upload'])){
						header("Location: items.php?item=".$_POST['itemName']);
						}elseif(isset($_POST['uploadAndPrepare'])){
						header("Location: prepare.php?item=".$_POST['itemName']);
					}
					
				}
				//header("Location: items.php");
			}
			} else {
			echo "No file selected <br />";
		}
	}						