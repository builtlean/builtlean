<?php error_reporting(E_ALL);
require('isdk.php');

$app = new iSDK;
echo "created object!<br/>";

if($app->cfgCon("amitind")){
	
	echo "app connected!<br/>"; 
}	
else {
	echo "connection failed!<br/>";
	
}






?>