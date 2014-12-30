

<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
     <title>留言板</title>
<meta http-equiv="Content-Type" content="text-html;chaset=utf-8"/>
<meta name="description" content="" />
<meta name="keywords" content="" />
 
 <style type=text/css>
#header
{width:1024px;
 height:50px;
background:#0099FF}

#main
{width:1024px;
 height:500px;
background:pink}

</style>


</head>
<?php include "head.php";?>
<body>
     <div  id="header">
              <h1>查看留言</h1>
     </div>
     <div id="main">
              <div id="chakan">
                
                  <table border="1">
                  <tr>
                  <th>序号</th>
                  <th>用户姓名</th>
                  <th>留言标题</th>
                  <th>留言内容</th>
                  <th>删除</th>
                  <th>修改</th>
                  </tr>
                  
                  <?php
                  include('conn.php');
                  $query="select * from biaoge";
                  $result=mysql_query($query); 
                  if (!$result){
                  	die ("could not query the databases: <br />". mysql_error());
                  }
                  while ($row=mysql_fetch_array($result,MYSQL_ASSOC)){
                  	$id= $row["id"];
                  	$user= $row["user"];
                  	$title= $row["title"];
                  	$content= $row["content"];
                  	
                
                  	echo "<tr>";
                  	echo "<td>$id</td>";
                  	echo "<td>$user</td>";
                  	echo "<td>$title</td>";
                  	echo "<td>$content</td>";
                  
                  	echo "<td><a href=shanchu.php?id=$id>删除</a></td>";
                  	echo "<td><a href=xiugai.php?id=$id>修改</a></td>";
                  	
                  	
                  	
                  	echo "</tr>";
                  }
                  mysql_close($conn)
        
               
                  ?>
                
                
                                  
                 
                  </table>                                
                                   
               </div>
      </div>
    
     <div id="footer">
     </div>
</body>