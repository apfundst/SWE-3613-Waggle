<?
ob_start();
session_start();
if(!isset($_SESSION["created"])){
  header('Location: http://www.waggle.myskiprofile.com/login.php');
  exit();
}
session_destroy();
ob_flush();
?>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="LOGIN/css.css">
  </head>
  <body>
  <!-- Create Logo at the top of the screen -->
  <!--Black bar at the top of the screen.-->
    <div class="navbar">
      <img class="logoImg"src="LOGIN/LOGOWAGGLEv4.2.png" height="75">
    </div>
  <!-- Creates a new row to use -->
      <!--Log in bar-->
     <div class="col-lg-4">
        <div class="panel">
          <center>
            <div class="panel-heading">Account Created! Check your SPSU email for a message about login information.</div>
          </center>
            <div class="panel-body">
            <center>
                <a href = "http://www.waggle.myskiprofile.com/">
                <input type="button" value= "Back to Front Page"></a>
          </center>
          </div>
          </div>
        </div>
  </body>
</html>
