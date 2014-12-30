


<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
     <title>留言板</title>
<meta http-equiv="Content-Type" content="text-html;chaset=utf-8"/>
<meta name="description" content="" />
<meta name="keywords" content="" />
 
 
<style type="text/css">

#header {
	width:1024px;
	height:60px;
	background:#0099FF;
}
#main {
	width:1024px;
	height:464px;
	background:pink;
}

#footer {
	width:1024px;
	height:53px;
	background:gray;
}
</style>
</head>
<?php include "head.php";?>
<body>
     <div  id="header">
              <h1>留言板</h1>
     </div>
     <div id="main">
              <div id="ly">
                 <form action="transmit.php"  method="post" >
                  <label>用户姓名<input type="text" class="tk" name="user"  /></label> <br /><br />
                  <label>留言标题<input type="text"  class="tk" name="title"  /> </label><br /><br />
                  <label>留言内容<textarea  cols="30"  rows="5"  name="nav"></textarea></label><br />
                         <div id="tj">
                           <input type="submit" name="submit"   value="提交留言" />
                         </div>
                   </form>
              </div>
     </div>
     <div id="footer">
     </div>


</body>