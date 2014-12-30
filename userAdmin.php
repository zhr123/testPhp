<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员管理</title>
</head>

<body>

     <table border="1">
                  <tr>
                  <th>序号</th>
                  <th>会员姓名</th>
                  <th>会员权限</th>
                  <th>添加管理员</th>
                  <th>删除管理员</th>
                  <th>删除会员</th>
                  </tr>
                  
                  <?php
                  include('conn.php');
                  $query="select * from user";
                  $result=mysql_query($query); 
                  if (!$result){
                  	die ("could not query the databases: <br />". mysql_error());
                  }
                  while ($row=mysql_fetch_array($result,MYSQL_ASSOC)){
                  	$userID= $row["userID"];
                  	$name= $row["name"];
                  	$permission= $row["permission"];
                 
                  	
                
                  	echo "<tr>";
                  	echo "<td>$userID</td>";
                  	echo "<td>$name</td>";
                  	echo "<td>$permission</td>";
                  
                  	echo "<td><a href=userAdmin-addAdmin.php?userID=".$userID.">添加管理员</a></td>";
                  	echo "<td><a href=userAdmin-deleteAdmin.php?userID= ".$userID.">删除管理员</a></td>";
                  	echo "<td><a href=userAdmin-deleteuser.php?userID=".$userID.">删除会员</a></td>";
             
                  	
                  	
                  	echo "</tr>";
                  }
                  mysql_close($conn)
        
               
                  ?>
                  </table>         
</body>
</html>