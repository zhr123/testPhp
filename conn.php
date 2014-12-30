<?php
$conn=@ mysql_connect("localhost","root","root")  or die("数据库连接失败"); 
mysql_select_db("ecshop",$conn); 
mysql_query("SET  NAMES  'UTF8'"); 	
?>