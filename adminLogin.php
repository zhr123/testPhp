<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
.error {color: #FF0000;}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台登录</title>
</head>

<?php

// 定义变量并设置为空值
$userIDErr=$passwordErr="";
$userID=$password=$submit="";
$savePwd=false;

//判断输入是否合法
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (!empty($_POST["userID"])) {
		$userID = test_input($_POST["userID"]); 
   }
   
    if (!empty($_POST["password"])) {
		$password = test_input($_POST["password"]);
   }
   
   if (!empty($_POST["submit"])) {
		$submit = test_input($_POST["submit"]);
   }

   
   if (empty($_POST["savePwd"])) {
		$savePwd=false;
   } else {
		$savePwd=true;
   }
}
//过滤输入，为了安全
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
if (isset($_COOKIE["savePwd"])){
	$userID=$_COOKIE['userID'];
	$password=$_COOKIE['password'];
}
?>


<body>
<h1>后台登录</h1>

<form name="adminLogin" method="post" action="adminLogin.php">
<?php echo '<p>用户名：<input type="text" name="userID" value='.$userID.'>';?>
</p>
<?php echo '<p>密码：<input type="password" name="password" value='.$password.'>';?>
忘记密码
</p>
<p><input type="checkbox" name="savePwd" value="true" />
记住密码
</p>
<p><input type="submit" name="submit" value="登录" />
</p>
</form>


<?php	
	//数据库操作
if($submit!=""){
	//连接数据库
	$con=mysql_connect("localhost","root","");
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
	if(!mysql_select_db("ecshop", $con)){
		die('Could not select database: ' . mysql_error());
	}

	$sql="SELECT * FROM user WHERE userID = '$userID' and permission='admin';";

	$result = mysql_query($sql,$con);
	if(mysql_num_rows($result)==1){
		setcookie("userID",$userID,time()+3600);
		if($savePwd) setcookie("userID",$userID,time()+3600*24*7);
		
		$sql="SELECT * FROM user WHERE userID = '$userID' and password='$password';";

		$result = mysql_query($sql,$con);
		if(mysql_num_rows($result)==1){
			setcookie("password",$password,time()+3600);
			if($savePwd) setcookie("password",$password,time()+3600*24*7);	
			setcookie("savePwd",$savePwd,time()+3600);
			if($savePwd) setcookie("savePwd",$savePwd,time()+3600*24*7);
			setcookie("permission","admin",time()+3600);
			if($savePwd) setcookie("permission","admin",time()+3600*24*7);			
			//跳转页面
			echo "<script language='javascript'>";
			echo "document.location='admin.php'";
			echo "</script>";
		}
		else {
			echo "<span class='error'>密码不正确</span>";
		}
	}
	else{
		echo "<span class='error'>没有此管理员</span>";
	}
	
	mysql_close($con);
}
?>
<a href="index.php">返回主页</a>
</body>
</html>