<nav class="navbar-default navbar" role="navigation">
<a href="index.php">
<img class="logoImg"src="LOGOWAGGLEv3.3.png" height="75"></a>

<div style="float: right;">
  <ul>
  <? if(($_SERVER['REQUEST_URI'] != '/' && ($_SERVER['REQUEST_URI'] != '/index.php') && ($_SERVER['REQUEST_URI'] != '/group.php') && ($_SERVER['REQUEST_URI'] != '/admin.php')){
  		echo '<li><a href="group.php">Group Home</a></li>';
  		}
	?>
    <li><a href="index.php">Home</a></li>
    <li><a href="logout.php">Log Out</a></li>
  </ul>
  <span style="color: white;">Loged in: </span><a href="#" style="color:white;"><?=$_SESSION['email']?></a>
</div>
</nav>