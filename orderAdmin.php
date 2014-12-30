<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>订单管理</title>
</head>


<body>

<?php
//接受表单信息，存储图片和相关菜品信息
	
	
	//PDO对象
	$dbh=new PDO("mysql:host=localhost;port=3306;dbname=ecshop","root","root");
	
	//插入图片记录
	$result=$dbh->query("SELECT * FROM  `order` ;");


	echo '<table width="600" height="500" border="0">';

	while($row=$result->fetch()){

		
		echo "<tr>";
		echo "<td> 订单号: ".$row['orderID']."</td>";
		echo "<td> 用户： ".$row['userID']."</td>";
		echo "<td> 时间: ".$row['dateTime']."</td>";
		switch($row['state']){
			case 0:$state="未付款";break;
			case 1:$state="已付款";break;
			case 2:$state="烹饪中";break;
			case 3:$state="送餐中";break;
			case 4:$state="已签收";break;
			case 5:$state="已结束";break;
			default:$state="订单错误";
		}
		echo "<td> 目前状态: ".$state."</td>";
		echo "<td> 完成进度: ".$row['complete']."/".$row['sum']."</td>";
		echo "</tr>";
	}
echo "</table>";
echo "<p>首页 上一页 1 下一页 尾页</p>";

echo '<a href="admin.php">返回菜单</a>';

$dbh=NULL;

?>
</body>
</html>