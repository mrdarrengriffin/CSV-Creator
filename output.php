 <?php
	
	require 'init.php';
	
	$ih->loadItem($_GET['item']);
	$file = file_get_contents($ih->dataPath.$ih->getData()['outputFile']);
	echo $file;