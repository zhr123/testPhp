<html>

<?php
	if(!empty($_GET["headaction"])){//是否点选了注销
		//clear cookies
		setcookie("userID", "", time()-3600*7);
		setcookie("password", "", time()-3600*7);
		setcookie("savePwd", "", time()-3600*7);
		
		
		echo "<a href=\"index.php\"> 主页 </a>";
		echo "<a href=\"register.php\"> 注册 </a>";
		echo "<a href=\"login.php\"> 登录 </a>";
	}
	else if (isset($_COOKIE["savePwd"])){//cookies是否有信息
		$userID=$_COOKIE['userID'];
		$permission=$_COOKIE['permission'];
		
		if($permission=="admin"){//权限处理
			echo '<a href="admin.php">'.$userID.'</a>';
			echo '<a href="foodAdmin.php"> 菜品管理 </a>';
			echo '<a href="orderAdmin.php"> 订单管理 </a>';
			echo '<a href="userAdmin.php"> 会员管理 </a>';
			echo '<a href="feedbackAdmin.php"> 留言管理 </a>';
			echo '<a href="statisticAdmin.php"> 统计信息 </a>';
			echo "<a href='".$_SERVER['PHP_SELF']."?headaction=\"logout\"'> 退出系统 </a>";//传url参数
		}
		else if($permission=="user"){
			echo "<a href=\"index.php\"> 主页 </a>";
			echo '<a href="user.php">'.$userID.'</a>';
			echo '<a href="cart.php"> 购物车 </a>';
			echo '<a href="show.php"> 意见反馈 </a>';
			echo "<a href='".$_SERVER['PHP_SELF']."?headaction=\"logout\"'> 注销 </a>";//传url参数
		}
	}
	else{//普通页面
		echo "<a href=\"index.php\"> 主页 </a>";
		echo "<a href=\"register.php\"> 注册 </a>";
		echo "<a href=\"login.php\"> 登录 </a>";
		
		if(!empty($_GET["headaction"])){
			setcookie("userID", "", time()-3600*7);//clear cookies
			setcookie("password", "", time()-3600*7);
			setcookie("savePwd", "", time()-3600*7);
		}
	}
?>

	
</html>