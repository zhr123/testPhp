<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理页面</title>
</head>
<body>
<?php
if (isset($_COOKIE["savePwd"])){
	$userID=$_COOKIE['userID'];
}

		echo '<h1>向你致意，'.$userID.'</h1><br>';
		echo '<a href="foodAdmin.php"> 菜品管理 </a><br>';
		echo '<a href="orderAdmin.php"> 订单管理 </a><br>';
		echo '<a href="userAdmin.php"> 会员管理 </a><br>';
		echo '<a href="show.php"> 留言管理 </a><br>';
		// echo '<a href="statisticAdmin.php"> 统计信息 </a><br>';
		echo "<a href='index.php?headaction=\"logout\"'> 退出系统 </a><br>";//传url参数
?>

</body>
</html>