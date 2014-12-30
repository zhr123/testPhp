


<?php
include("conn.php");
if (!empty($_POST))
{
	mysql_query("UPDATE biaoge SET user = '$_POST[user]', title = '$_POST[title]', content = '$_POST[content]' WHERE id = '$_POST[id]'");
}
if (isset($_GET['id']))
{
	$result = mysql_query("SELECT * FROM biaoge WHERE id = ". $_GET['id'] );
	$row = mysql_fetch_array($result);
	

	?>

	
	
<form action="xiugai.php" method="POST">
<input type="hidden" name="id" value="<?php echo $row['id']; ?>" />

用户姓名：<input type="text" class="tk" name="user" value="<?php echo $row['user']; ?>" /> <br /><br />
留言标题：<input type="text" class="tk" name="title" value="<?php echo $row['title']; ?>" /> <br /><br />
留言内容：<textarea  cols="30"  rows="5" name="content"><?php echo $row['content']; ?></textarea><br /><br />
<input type="submit" />
</form>
<?php
  }
?>

 <form action="bianji.php"  method="post" >
   <input type="submit" name="submit"   value="返回查看" />
   </form>




	