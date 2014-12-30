<?php 
include("conn.php");
$userID = $_GET['userID']; 
$query="UPDATE user SET permission='user' WHERE userID='".$userID."';";
mysql_query($query); 
?> 
<form action="userAdmin.php"  method="post" >
   <input type="submit" name="submit"   value="返回查看" />
   </form>