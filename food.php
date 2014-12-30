<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
.error {color: #FF0000;}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>编辑页面</title>
</head>
<?php include "./head.php";?>
<body>

<?php

//接受表单信息，存储图片和相关菜品信息
header("content-type:text/html;charset=utf-8");

//PDO对象
$dbh=new PDO("mysql:host=localhost;port=3306;dbname=ecshop","root","");
//插入图片记录
$result=$dbh->query("SELECT * FROM food WHERE foodID=".$_GET['whichfood'].";");

$row=$result->fetch();
	

	
	
	
// 定义变量并设置为空值
$nameErr =$priceErr= $costErr=$imageErr=$informationErr=$commentNumberErr= "";
$name =$row['name'];
$price =$row['price'];
$cost =$row['cost'];
$information =$row['information'];

$submit="";

//判断输入是否合法
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["submit"])) {
		$submit ="";
	}else{
		$submit = test_input($_POST["submit"]); 
	}	
	
	if (empty($_FILES["imageFile"])) {
		$imageErr ="";
	}else{
		$imageErr = "";
	}
   
	if (empty($_POST["name"])) {
		$nameErr = "";
	}else {
		$name = test_input($_POST["name"]); 
		if (!preg_match("/^[\x{4e00}-\x{9fa5}]+$/u",$name)) {
			$nameErr = "只允许中文"; 
		}  
	}
       
    if (empty($_POST["price"])) {
     $priceErr = "";
	} else {
		$price = test_input($_POST["price"]);
		if (!preg_match("/^[0-9]*[.][0-9]*$/",$price)) {
			$priceErr = "只允许实数"; 
		}  
	}
   
	if (empty($_POST["cost"])) {
		$costErr = "";
	} else {
		$cost = test_input($_POST["cost"]);
	 if (!preg_match("/^[0-9]*[.][0-9]*$/",$cost)) {
			$costErr = "只允许实数"; 
		}  
	}
	if (empty($_POST["information"])) {
		$informationErr = "";
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

echo "<form action='food.php?whichfood=".$row['foodID']."' method='post' enctype='multipart/form-data' name='upload'>";
echo '<p><img src="'.$row['image'].'" alt="" width="500" height="300"/></p>';
echo '<p>修改图片：<br> <Input type="file" name="imageFile">';
echo '<span class="error">'.$imageErr.'</span>';
echo '</p>'; 
?>
<?php echo "<p>菜名： ".$row['name']." </p>"; ?>
<p>菜名<input type="text" name="name"/>
 <span class="error"><?php echo $nameErr;?></span>
</p>
<?php echo "<p>价格： ".$row['price']." </p>"; ?>
<p>价格<input type="text" name="price"/>
 <span class="error"><?php echo $priceErr;?></span>
</p>
<?php echo "<p>成本： ".$row['cost']." </p>"; ?>
<p>成本价<input type="text" name="cost"/>
 <span class="error"><?php echo $costErr;?></span>
</p>
<?php echo "<p>介绍： ".$row['information']." </p>"; ?>
<p>介绍<input type="text" name="information"/>
 <span class="error"><?php echo $informationErr;?></span>
</p>
<p><input type="submit" name="submit" value="保存修改" /></p>
</form>


<?php
if($submit!=""&&$informationErr==""&&$imageErr==""&&$nameErr==""&&$priceErr==""&&$costErr==""){
	
	if(!empty($_FILES["imageFile"]["tmp_name"])){
		$filepath=$_FILES["imageFile"]["tmp_name"];		
		$imagepath=$_SERVER['DOCUMENT_ROOT'].'/testPhp/image/food/'.$_FILES["imageFile"]["name"];//似乎只能用绝对路径，所以用这种迂回的写法
		if(file_exists($filepath)){
			move_uploaded_file($filepath,$imagepath);
		}
		$image='image/food/'.$_FILES["imageFile"]["name"];
	}
	else $image =$row['image'];
	
	
	$sql="UPDATE food SET image = '$image',name='$name',price='$price',cost='$cost',information='$information'
	WHERE foodID=".$row['foodID'].";";

	$result=$dbh->query($sql);
	
	if($result->rowCount()>0){
		echo "<script language=\"javascript\">";
		echo "document.location='foodAdmin.php'";
		echo "</script>";
	}
}
$dbh=NULL;
?>
</body>
</html>