<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>订单已接受</title>
</head>
<?php include "head.php";?>
<body>
<h1>订单已接受</h1>

<?php 
	$orderID= (empty($_GET["orderID"])) ? "" : $_GET["orderID"];


	
	
//接受表单信息，存储图片和相关菜品信息
	
	
	//PDO对象
	$dbh=new PDO("mysql:host=localhost;port=3306;dbname=ecshop","root","root");
	
	//插入图片记录
	

	

	echo "<p> 订单号: ".$orderID."</p>";
	echo "<p> 时间: ".$row['dateTime']."</p>";
	switch($row['state']){
		case 0:$state="未付款";break;
		case 1:$state="已付款";break;
		case 2:$state="烹饪中";break;
		case 3:$state="送餐中";break;
		case 4:$state="已签收";break;
		case 5:$state="已结束";break;
		default:$state="订单错误";
	}
	echo "<p> 目前状态: ".$state."</p>";
	echo "<p> 完成进度: ".$row['complete']."/".$row['sum']."</p>";
	echo "<br>";
	echo "<a href='https://auth.alipay.com/login/index.htm'> 立即付款 </a>";
	echo "<br>";
	echo "<a href='index.php'> 返回商城 </a>";


	$dbh=NULL;

?>
</body>
</html>