<?php 
include("conn.php");
$userID = $_GET['userID']; 
$query="UPDATE `ecshop`.`user` SET `permission`='admin' WHERE  `user`.`userID`=$userID"; 
mysql_query($query); 
?> 
<form action="userAdmin.php"  method="post" >
   <input type="submit" name="submit"   value="返回查看" />
   </form>