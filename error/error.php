<?
session_start();
include '../other_funcs.php';
if(!isset($_SESSION["email"])) {
  header('Location: http://www.waggle.myskiprofile.com/login.php');
  exit();
}
else{
if($_GET['err']){
	$err_mes = $_GET['err'];
}
else{
	$err_mes = 'Its broken Aye, Whatever you just did failed!';
}
}


?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WOAH!!</title>
<link rel="stylesheet" type="text/css" href="../css.css">
<style>
.error-block{
  color: #ffffff;
  font-size: 100px;
  font-style: bold;
  background-color: #0cb270;
  border-color: #ddd;
  padding: 15px;
  min-width:300px;
  float:center;
  width:100%;
}
.error-here{
  color: #ffffff;
  font-size: 20px;
  font-style: bold;
  background-color: #E9967A;
  padding: 15px;
  min-width:300px;
  float:center;
  width:100%;
  margin-top:15px;
}
.panel-click{
  color: #ffffff;
  font-size: 20px;
  font-style: bold;
  background-color: #0cb270;
  border-color: #ddd;
  padding: 15px;
  min-width:300px;
  float:center;
  width:100%;
}
</style>
</head>
<body>
<nav class="navbar-default navbar" role="navigation">
	<a href="../index.php">
	<img class="logoImg"src="LOGOWAGGLEv3.3.png" height="75"></a>

	<div style="float: right;">
	  <ul>
	    <li><a href="../group.php">Group Home</a></li>
	    <li><a href="../index.php">Home</a></li>
	    <li><a href="../logout.php">Log Out</a></li>
	  </ul>
	  <span style="color: white;">Logged in: </span><a href="#" style="color:white;"><?=do_get_name($_SESSION['email'])?></a>
	</div>
</nav>
	<div class="error-block">
		<center>OOPS!</center>
	</div>
	<div class="error-here">
		<center><?=$err_mes ?>!</center>
	</div>
	<div class="IMG">
		<center>
			<img class="img-broken"height="234px"width="272px"src="broken.png">
		</center>
	</div>
	<div class="panel-click">
		<center>
			<a href="../index.php">Click here to return Home</a>
		</center>
	</div>
</body>
</html>
