<?php


session_start();
//获得来自 URL 的 foodID 参数

$q=$_GET["q"];

if(isset($_SESSION["cartlist"])) 
	$cartlist=unserialize($_SESSION["cartlist"]);
else $cartlist=array();


array_push($cartlist,$q);

$_SESSION['cartlist']=serialize($cartlist);




?>