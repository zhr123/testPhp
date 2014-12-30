
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
     <title>留言板</title>
<meta http-equiv="Content-Type" content="text-html;chaset=utf-8"/>
<meta name="description" content="" />
<meta name="keywords" content="" />

<style type=text/css>
#main 
{width:1024px;
 height:464px;
background:pink}
</style>



</head>
<?php include "head.php";?>
<body>
<div id="main">

<?php
include("conn.php");
if(@$_POST['submit']){
	$sql="insert into  biaoge (id,user,title,content)values('','$_POST[user]','$_POST[title]','$_POST[nav]')";

	mysql_query($sql);
	echo  "留言成功";
}
?>

               <form action="bianji.php"  method="post" >
               <input type="submit" value="查看留言" />
               </form>
 
</div>
</body>