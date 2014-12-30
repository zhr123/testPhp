<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>菜品管理</title>
</head>

<?php 
	$permission="";
	if (isset($_COOKIE["savePwd"])){
		$permission=$_COOKIE["permission"];
	}
	
	
	//购物信息
	session_start();
	if(isset($_SESSION["cartlist"])) 
		$cartlist=unserialize($_SESSION["cartlist"]);
	else $cartlist=array();
	// foreach($cartlist as $value){
		// echo $value;
		// echo "<br>";
	// }
?>
<body>

<?php
//接受表单信息，存储图片和相关菜品信息
	
	
	//PDO对象
	$dbh=new PDO("mysql:host=localhost;port=3306;dbname=ecshop","root","root");
	
	//插入图片记录
	$result=$dbh->query("SELECT * FROM food  ");
	
	//使用url参数，删除记录
	if(!empty($_GET['whichfood'])){
		$dbh->query("DELETE FROM food WHERE foodID=".$_GET['whichfood'].";");
	}

		

if ($permission=="admin"){
	echo '<a href="foodAdd.php">添加菜品</a>';
}
	echo '<table width="1000" height="500" border="0">';

	while($row=$result->fetch()){
		echo "<tr>";
		echo '<td width="226"><img src="'.$row['image'].'" alt="" width="226" height="142"/></td>';
		echo "<td>菜名： ".$row['name']." </td>";
		echo "<td>单价： ".$row['price']." </td>";
		echo "<td>介绍： ".$row['information']." </td>";
		if (empty($_GET["headaction"])&&$permission=="admin"){//只有未注销的管理员才可以查看到
			echo "<td> 成本：".$row['cost']." </td>";
			echo "<td><a href='food.php?whichfood=".$row['foodID']."'> 编辑 </a></td>";//传url参数
			echo "<td><a href='foodAdmin.php?whichfood=".$row['foodID']."'> 删除 </a></td>";//传url参数

		}
		else{
			echo "<td><a href='javascript:pass(".$row['foodID'].")'> 加入购物车 </a></td>";//传参数			
		}
		echo "</tr>";
	}
echo "</table>";
echo "<p>首页 上一页 1 下一页 尾页</p>";
echo '<a href="adminLogin.php">后台管理</a>';
if (empty($_GET["headaction"])&&$permission=="admin") {
	echo '<a href="admin.php">返回菜单</a>';
}	
	$dbh=NULL;

?>
<!-- ajax 实现保存session,保存函数在cartajax.php-->

<script type="text/javascript">
function pass(str)
{

var xmlhttp;

if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

xmlhttp.open("GET","cartajax.php?q="+str,true);
xmlhttp.send();
}
</script>


</body>
</html>