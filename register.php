<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
.error {color: #FF0000;}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>注册页面</title>
</head>
<?php

// 定义变量并设置为空值
$userIDErr=$passwordErr=$passwordAgainErr=$nameErr =$phoneErr= $addressErr=$emailErr= "";
$userID=$password=$passwordAgain=$name =$phone= $address=$email=$submit="";

//判断输入是否合法
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["submit"])) {
		$submit ="";
	}else{
		$submit = test_input($_POST["submit"]); 
	}
   
	if (empty($_POST["name"])) {
     $nameErr = "姓名是必填的";
	}else {
		$name = test_input($_POST["name"]); 
		if (!preg_match("/^[\x{4e00}-\x{9fa5}]+$/u",$name)) {
			$nameErr = "只允许中文"; 
		}  
	}
   
    if (empty($_POST["password"])) {
     $passwordErr = "密码是必填的";
	} else {
     $password = test_input($_POST["password"]);
	}
      
    if (empty($_POST["passwordAgain"])) {
		$passwordAgainErr = "重复输入密码是必填的";
	} else {
		$passwordAgain = test_input($_POST["passwordAgain"]);
		if($passwordAgain!=$password){
			$passwordAgainErr = "两次密码不一样";
		}
   }
       
    if (empty($_POST["userID"])) {
     $userIDErr = "用户名是必填的";
   } else {
		$userID = test_input($_POST["userID"]);
		if (!preg_match("/^[a-zA-Z_][a-zA-Z0-9_]*$/",$userID)) {
			$userIDErr = "只允许字母和下划线开头"; 
		}  
   }
       
    if (empty($_POST["phone"])) {
     $phoneErr = "电话是必填的";
   } else {
		$phone = test_input($_POST["phone"]);
		if (!preg_match("/^[0-9]*$/",$phone)) {
			$phoneErr = "只允许数字"; 
		}  
   }
   
   if (empty($_POST["email"])) {
     $emailErr = "邮件地址是必填的";
   } else {
		$email = test_input($_POST["email"]);
		if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
		   $emailErr = "无效的 email 格式"; 
		}
   }
     
   if (empty($_POST["address"])) {
     $addressErr = "地址是必填的";
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

//global $userIDErr,$passwordErr,$passwordAgainErr,$nameErr,$phoneErr,$addressErr,$emailErr,$userID,$password,$passwordAgain,$name,$phone,$address,$email;
?>


<body>
<h1>注册页面</h1>

<form name="register" method="post" action="register.php">
<p>用户名<input type="text" name="userID"/>
<span class="error">* <?php echo $userIDErr;?></span>
</p>
<p>密码<input type="password" name="password"/>
<span class="error">* <?php echo $passwordErr;?></span>
</p>
<p>重复输入密码<input type="password" name="passwordAgain"/>
 <span class="error">* <?php echo $passwordAgainErr;?></span>
</p>
<p>姓名<input type="text" name="name"/>
 <span class="error">* <?php echo $nameErr;?></span>
</p>
<p>电话<input type="text" name="phone"/>
 <span class="error">* <?php echo $phoneErr;?></span>
</p>
<p>地址<input type="text" name="address"/>
 <span class="error">* <?php echo $addressErr;?></span>
</p>
<p>邮箱<input type="text" name="email"/>
 <span class="error">* <?php echo $emailErr;?></span>
</p>
<p><input type="submit" name="submit" value="提交" /></p>
</form>

<?php	
//数据库操作
if($submit!=""&&$userIDErr==""&&$passwordErr==""&&$passwordAgainErr==""&&$nameErr==""&&$phoneErr==""&&$addressErr==""&&$emailErr==""){
	// 连接数据库
	$con=mysql_connect("localhost","root","");
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
	if(!mysql_select_db("ecshop", $con)){
		die('Could not select database: ' . mysql_error());
	}
	//存储到数据库
	$sql="INSERT INTO User (userID, password, name,phone,address,email,permission)
	VALUES
	('$userID','$password','$name','$phone','$address','$email','user');";

	if (!mysql_query($sql,$con))
	  {
	  die('Error: ' . mysql_error());
	  }
	echo "注册成功";
	
	setcookie("userID",$userID,time()+3600);
	setcookie("password",$password,time()+3600);
	setcookie("savePwd",false,time()+3600);
	
	mysql_close($con);
	// 跳转页面
	echo "<script language='javascript'>";
	echo "document.location='registerSuccess.html'";
	echo "</script>";

}

// echo "<h2>您的输入：</h2>";
// echo $userID;
// echo "<br>";
// echo $password;
// echo "<br>";
// echo $passwordAgain;
// echo "<br>";
// echo $name;
// echo "<br>";
// echo $phone;
// echo "<br>";
// echo $address;
// echo "<br>";
// echo $email;
// echo $submit;

?>
<p>&nbsp;</p>
</body>
</html>