<nav class="navbar-default navbar" role="navigation">
<a href="admin.php">
<img class="logoImg"src="LOGOWAGGLEv3.3.png" height="75"></a>

<div style="float: right;">
  <ul>
    <? if( ($_SERVER['REQUEST_URI'] != '/index.php') && ($_SERVER['REQUEST_URI'] != '/group.php')){
  		echo '<li><a href="group.php">Group Home</a></li>';
  		}
	?>
    <li><a href="admin.php">Admin Control Panel</a></li>
    <li><a href="index.php">Home</a></li>
    <li><a href="logout.php">Log Out</a></li>
    
  </ul>
</div>
</nav>