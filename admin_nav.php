<nav class="navbar-default navbar" style="min-width:700px;" role="navigation">
<a href="admin.php">
<img class="logoImg"src="LOGIN/LOGOWAGGLEv4.2.png" height="75"></a>

<div style="float: right;">
  <ul>
    <? if(($_SERVER['REQUEST_URI'] != '/') && ($_SERVER['REQUEST_URI'] != '/index.php') && ($_SERVER['REQUEST_URI'] != '/group.php') && ($_SERVER['REQUEST_URI'] != '/admin.php')){
  		echo '<li><a href="group.php">Group Home</a></li>';
  		}
	 ?>
    <li><a href="admin.php">Admin Control Panel</a></li>
    <li><a href="index.php">Home</a></li>
    <li><a href="logout.php">Log Out</a></li>
  </ul>
  <span style="color: white;">Logged in: </span><a href="#" style="color:white;"><?=do_get_name($_SESSION['email'])?></a>
</div>
</nav>