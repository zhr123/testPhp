<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
.error {color: #FF0000;}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加菜品</title>
</head>

<?php

// 定义变量并设置为空值
$foodIDErr=$nameErr =$priceErr= $costErr=$imageErr=$informationErr=$commentNumberErr= "";
$foodID=$name =$price= $cost=$commentNumber=$hot=$information=$submit="";

//判断输入是否合法
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["submit"])) {
		$submit ="";
	}else{
		$submit = test_input($_POST["submit"]); 
	}	
	
	if (empty($_FILES["imageFile"])) {
		$imageErr ="没有上传图片";
	}else{
		$imageErr = "";
	}
   
	if (empty($_POST["name"])) {
		$nameErr = "菜名是必填的";
	}else {
		$name = test_input($_POST["name"]); 
		if (!preg_match("/^[\x{4e00}-\x{9fa5}]+$/u",$name)) {
			$nameErr = "只允许中文"; 
		}  
	}
       
    if (empty($_POST["price"])) {
     $priceErr = "价格是必填的";
	} else {
		$price = test_input($_POST["price"]);
		if (!preg_match("/^[0-9]*[.][0-9]*$/",$price)) {
			$priceErr = "只允许实数"; 
		}  
	}
   
	if (empty($_POST["cost"])) {
		$costErr = "成本价是必填的";
	} else {
		$cost = test_input($_POST["cost"]);
	 if (!preg_match("/^[0-9]*[.][0-9]*$/",$cost)) {
			$costErr = "只允许实数"; 
		}  
	}
	if (empty($_POST["information"])) {
		$informationErr = "介绍信息是必填的";
	} else {
		$information = test_input($_POST["information"]);
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


<body>
<h1>添加菜品</h1>


 
<body>
<form action="foodAdd.php" method="post" enctype="multipart/form-data" name="upload">
<p>上传文件：<br> <Input type="file" name="imageFile">
 <span class="error"><?php echo $imageErr;?></span>
 </p>
<p>菜名<input type="text" name="name"/>
 <span class="error">* <?php echo $nameErr;?></span>
</p>
<p>价格<input type="text" name="price"/>
 <span class="error">* <?php echo $priceErr;?></span>
</p>
<p>成本价<input type="text" name="cost"/>
 <span class="error">* <?php echo $costErr;?></span>
</p>
<p>介绍<input type="text" name="information"/>
 <span class="error">* <?php echo $informationErr;?></span>
</p>
<p><input type="submit" name="submit" value="提交" /></p>
</form>

 <?php
 //保存到数据库
	header("content-type:text/html;charset=utf-8");
	if($submit!=""&&$informationErr==""&&$imageErr==""&&$nameErr==""&&$priceErr==""&&$costErr==""){
		
		$filepath=empty($_FILES["imageFile"]["tmp_name"]) ? "" : $_FILES["imageFile"]["tmp_name"];
		$imagepath=empty($_FILES["imageFile"]["name"]) ? "" : $_SERVER['DOCUMENT_ROOT'].'/testPhp/image/food/'.$_FILES["imageFile"]["name"];//似乎只能用绝对路径，所以用这种迂回的写法
		$image=empty($_FILES["imageFile"]["name"]) ? "" : 'image/food/'.$_FILES["imageFile"]["name"];
		
		
		
		if(file_exists($filepath)){
			move_uploaded_file($filepath,$imagepath);
		}


		$dbh=new PDO("mysql:host=localhost;port=3306;dbname=ecshop","root","");
		
		$result=$dbh->query("INSERT INTO food (image,name,price,cost,information) VALUES ('$image','$name','$price','$cost','$information');");
		
		if($result->rowCount()>0){
			echo "<script language=\"javascript\">";
			echo "document.location=\"./foodAddSuccess.html\"";
			echo "</script>";
		}

		$dbh=NULL;	
	}
// echo "<h2>您的输入：</h2>";
// echo $foodID;
// echo "<br>";
// echo $name;
// echo "<br>";
// echo $price;
// echo "<br>";
// echo $cost;
// echo "<br>";
// echo $submit;
?>


</body>
</html>