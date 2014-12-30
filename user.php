<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>个人信息</title>
</head>
<style>
.error {color: #FF0000;}
</style>
<?php include "./head.php";?>
<body>

<?php

//接受表单信息，存储图片和相关菜品信息
header("content-type:text/html;charset=utf-8");

if (isset($_COOKIE["savePwd"]))
	$userID=$_COOKIE['userID'];

//PDO对象
$dbh=new PDO("mysql:host=localhost;port=3306;dbname=ecshop","root","");

$result=$dbh->query("SELECT * FROM user WHERE userID='".$userID."';");

$row=$result->fetch();
	

	
	
	
// 定义变量并设置为空值
$userIDErr=$passwordErr=$passwordAgainErr=$nameErr =$phoneErr= $addressErr=$emailErr= "";
$password=$row['password'];
$passwordAgain=$row['password'];
$name=$row['name'];
$phone=$row['phone'];
$address=$row['address'];
$email=$row['email'];
$submit="";

//判断输入是否合法
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["submit"])) {
		$submit ="";
	}else{
		$submit = test_input($_POST["submit"]); 
	}	
  
	if (empty($_POST["name"])) {
     $nameErr = "";
	}else {
		$name = test_input($_POST["name"]); 
		if (!preg_match("/^[\x{4e00}-\x{9fa5}]+$/u",$name)) {
			$nameErr = "只允许中文"; 
		}  
	}
   
    if (empty($_POST["password"])) {
     $passwordErr = "";
	} else {
		$password = test_input($_POST["password"]);
		if (empty($_POST["passwordAgain"])) {
			$passwordAgainErr = "两次密码不一样";
		} else {
			$passwordAgain = test_input($_POST["passwordAgain"]);
			if($passwordAgain!=$password){
				$passwordAgainErr = "两次密码不一样";
			}
		}
	}
       
    if (empty($_POST["phone"])) {
     $phoneErr = "";
   } else {
		$phone = test_input($_POST["phone"]);
		if (!preg_match("/^[0-9]*$/",$phone)) {
			$phoneErr = "只允许数字"; 
		}  
   }
   
   if (empty($_POST["email"])) {
     $emailErr = "";
   } else {
		$email = test_input($_POST["email"]);
		if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
		   $emailErr = "无效的 email 格式"; 
		}
   }
     
   if (empty($_POST["address"])) {
     $addressErr = "";
   } else {
     $address = test_input($_POST["address"]);
   }
}
//过滤输入，为了安全
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<form name="userInformation" method="post" action="user.php">
<p>密码<input type="password" name="password"/>
<span class="error"><?php echo $passwordErr;?></span>
</p>
<p>重复输入密码<input type="password" name="passwordAgain"/>
 <span class="error"><?php echo $passwordAgainErr;?></span>
</p>
<?php echo "<p>姓名： ".$row['name']." </p>"; ?>
<p>姓名<input type="text" name="name"/>
 <span class="error"><?php echo $nameErr;?></span>
</p>
<?php echo "<p>电话： ".$row['phone']." </p>"; ?>
<p>电话<input type="text" name="phone"/>
 <span class="error"><?php echo $phoneErr;?></span>
</p>
<?php echo "<p>地址： ".$row['address']." </p>"; ?>
<p>地址<input type="text" name="address"/>
 <span class="error"><?php echo $addressErr;?></span>
</p>
<?php echo "<p>邮箱： ".$row['email']." </p>"; ?>
<p>邮箱<input type="text" name="email"/>
 <span class="error"><?php echo $emailErr;?></span>
</p>
<p><input type="submit" name="submit" value="保存修改" /></p>
</form>


<?php
if($submit!=""&&$passwordErr==""&&$passwordAgainErr==""&&$nameErr==""&&$phoneErr==""&&$addressErr==""&&$emailErr==""){
	
	$sql="UPDATE user SET password='$password',name='$name',phone='$phone',address='$address',email='$email'
	WHERE userID='".$userID."';";

	$result=$dbh->query($sql);
	
	if($result->rowCount()>0){
		echo "<script language=\"javascript\">";
		echo "document.location='operationSuccess.html'";
		echo "</script>";
	}
}
$dbh=NULL;
?>
</body>
</html>