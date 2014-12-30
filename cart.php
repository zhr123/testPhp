<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>购物车</title>
</head>
<?php include "head.php";
session_start();?>
<body>
<h1>购物车</h1>

<?php
$price=$cost=0;



//PDO对象
$dbh=new PDO("mysql:host=localhost;port=3306;dbname=ecshop","root","");

$cartlist=unserialize($_SESSION["cartlist"]);
$sum=array_count_values($cartlist);//统计菜品总数



if(!empty($_GET["whichfood"])){//删除某项
	$whichfood=$_GET["whichfood"];
	$delete=array();
	array_push($delete,$whichfood);
	
	$cartlist=unserialize($_SESSION["cartlist"]);
	$cartlist=array_diff($cartlist,$delete);
	$result=$dbh->query("SELECT * FROM food WHERE foodID='".$whichfood."'  ");
	$row=$result->fetch();
	$price-=$row['price']*$sum[$whichfood];
	$cost-=$row['cost']*$sum[$whichfood];
	
	
	
	if(count($cartlist)==0)	session_unset('cartlist');//如果购物车空了就删除掉session
	else  $_SESSION['cartlist']=serialize($cartlist);
}


if(!empty($_GET["action"])&&$_GET["action"]=="clear"){//清空
	session_unset('cartlist');
}











if(isset($_SESSION["cartlist"])){

	echo '<table width="600" height="500" border="0">';
		$cartlist=array_unique($cartlist);//去重
		$typeNumber=count($cartlist);//统计菜品种类
		foreach($cartlist as $foodID){
			
			$result=$dbh->query("SELECT * FROM food WHERE foodID='".$foodID."'  ");
			$row=$result->fetch();
			
			echo "<tr>";
			echo '<td width="226"><img src="'.$row['image'].'" alt="" width="226" height="142"/></td>';
			echo "<td>菜名： ".$row['name']." </td>";
			echo "<td>单价： ".$row['price']." 元</td>";
			echo "<td>介绍： ".$row['information']." </td>";
			echo "<td>数量： ".$sum[$foodID]." </td>";
			echo "<td><a href='cart.php?whichfood=".$row['foodID']."'> 删除 </a></td>";//传url参数
			echo "</tr>";
			
			$price+=$row['price']*$sum[$foodID];
			$cost+=$row['cost']*$sum[$foodID];
		}
	echo "</table>";
	echo "<h1>总价： ".$price." 元</h1>";
}	
else{
	echo "<h1>您的购物车是空的</h1>";
}
		



 //确认订单 ，保存到数据库
	if(isset($_SESSION["cartlist"])&&!empty($_GET["action"])&&$_GET["action"]=="confirm"){
		$foodlist=serialize($cartlist);

		
		$sql="INSERT INTO  `ecshop`.`order` (`orderID` ,`userID` ,`cartlist` ,`typeNumber` ,`cost` ,`price` ,`state` ,`complete` ,`dateTime` ,`sum`)
		VALUES (	NULL ,  '$userID','$foodlist' , '$typeNumber',  '$cost',  '$price',  'unpaid',  '0', CURRENT_TIMESTAMP ,  '0');
		Select @@identity as orderID;
		";

		$dbh->query($sql);
		$result=$dbh->query("Select @@identity as orderID;");

		$row=$result->fetch();
		 if($result->rowCount()>0){
			echo "<script language=\"javascript\">";
			echo "document.location='payment.php?orderID=".$row['orderID']."';";
			echo "</script>";
		 }
	}

	$dbh=NULL;

?>

<a href='cart.php?action=clear'> 清空购物车 </a>
<a href="index.php"> 继续购物 </a>
<a href='cart.php?action=confirm'> 确认订单 </a>

</body>
</html>