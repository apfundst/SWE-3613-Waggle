<?
ob_start();
session_start();
$error_message = null;
if ($_POST) {
  $con = mysql_connect("localhost","jsalvo_group8","waggle_password");
  $db = mysql_select_db('jsalvo_waggle');
  if (!$con || !$db ){
    die('Could not connect: ' . mysql_error());
  }
  else{

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "
      SELECT *
      FROM user
      WHERE email = '$email'
      AND password = '$password'
    ";

    $result = mysql_query($sql);
    if (!$result) {
      die('Could not connect: ' . mysql_error());
     
    }
    else {
      if (mysql_num_rows($result) == 0) {
        $error_message =  "Login failed.  Please check your userid and password.";
      }
      else {
        
        // Get the information from the result set
        $row = mysql_fetch_assoc($result);
        // Put information into temp variables
        //echo $row;
        $email = $row['email'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        //$error_message = $email . $first_name . $last_name;
        // Create session variables to use throughout login
        
        $_SESSION["email"] = $email;
        $_SESSION["first_name"] = $first_name;
        $_SESSION["last_name"] = $last_name;
        unset($_SESSION['current_group_id']);
        if($email == 'admin@spsu.edu')
        {
          header('Location: http://www.waggle.myskiprofile.com/admin.php');
          exit();
        }else{

        header('Location: http://www.waggle.myskiprofile.com/index.php');
  exit();
ob_flush();
}
      }
    }
  }
}

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
    <div class="row">
      
      <div class="col-lg-8" id="welcome">
        <div id="cf">
          <img class="bottom" src="LOGIN/beehive2.png"/>
          <img class="top" src="LOGIN/beehive1.png" />
        </div>
      </div>
      <!--Log in bar-->
      <div class="col-lg-4">
        <div class="panel">
          <div class="panel-heading">
            <center>Login Here</center>
          </div>
          <div class="panel-body">
            <center>
              <p><? echo $error_message; ?></p>
              <form action="login.php" method="post"enctype="multipart/form-data">
                <!--<label for="file">Email:</label>-->
                <input type="text" name="email" placeholder='SPSU Email' size="40" for="userid"><br>
                <!--<label for="file">Password:</label>-->
                <input type="password" name="password" placeholder='Password' size="40" for="pass"><br>
                <input type="submit" name="submit" value="Login">
              </form>
                <a href="http://www.waggle.myskiprofile.com/password_reset.php">
                <input type="button" value= "Forgot Password?"></a>
            </center>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>