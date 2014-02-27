<?
ob_start();
session_start();
include("other_funcs.php");
if($_POST){
$email = mysql_real_escape_string( trim($_POST["email"]) );
$student_id = mysql_real_escape_string( trim($_POST["student_id"]) );
$password = mysql_real_escape_string( trim($_POST["password"]) );
$copy_password = mysql_real_escape_string( trim($_POST["copy_password"]) );
$error_message = null;

if( strcmp($password, $copy_password) != 0){
  $error_message = "Both passwords entered did not match!";
}
else{
  if( strlen($password) < 8 ){
    $error_message = "Password must be 8 characters or greater!";
  }
    else{
      $result = do_forgot_password($email,$student_id,$password);
      if($result == true){
        $error_message = "Password has been reset! Please return to home page to login.";
      }
      else{
        $error_message = "Email and/or Student ID incorrect! Please reenter!";
      }
    } 
  }
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
            <div class="panel-heading">Reset Password</div>
          </center>
            <div class="panel-body">
            <center>
              <p><? echo $error_message; ?></p>
                <form action="password_reset.php" method="post"enctype="multipart/form-data">
                <!--<label for="file">Email:</label>-->
                <input type="text" name="email" placeholder='SPSU Email' size="40"><br>
                <input type="password" name="student_id" placeholder='Student ID' size="40"><br>
                <!--<label for="file">Password:</label>-->
                <input type="password" name="password" placeholder='Enter New Password' size="40"><br>
                <input type="password" name="copy_password" placeholder='Reenter New Password' size="40"><br>
                <input type="submit" name="submit" value="Reset Password">

                </form>
                <a href = "http://www.waggle.myskiprofile.com/">
                <input type="button" value= "Back to Login Page"></a>
          </center>
          </div>
          </div>
        </div>
  </body>
</html>