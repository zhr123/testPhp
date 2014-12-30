



<?php 
include("conn.php");
$id = $_GET['id']; 
$query="DELETE FROM biaoge WHERE id=".$id; 
mysql_query($query); 
?> 

 <form action="bianji.php"  method="post" >
   <input type="submit" name="submit"   value="返回查看" />
   </form>