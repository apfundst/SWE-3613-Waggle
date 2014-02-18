<?
session_start();
include 'admin_funcs.php';
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



?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WOAH!!</title>
<link rel="stylesheet" type="text/css" href="LOGIN/css.css">
</head>
<body>
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
			<a href="admin.php">Click here to return Home</a>
		</center>
	</div>
</body>
</html>
