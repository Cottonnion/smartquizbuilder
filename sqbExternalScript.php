<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");


$loadFile = explode('/wp-content', $_REQUEST['path']);

$wpLoadFile = $loadFile[0].'/wp-load.php';
try{
	require($wpLoadFile);
	echo SQBDisplayQuizById($_REQUEST['id']);die;

}catch(Exception $e){
	echo $e->getMessage();die;
} 
