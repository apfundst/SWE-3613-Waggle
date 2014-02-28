<?
ob_start();
session_start();
include("other_funcs.php");
if($_POST){
$email_1 = mysql_real_escape_string( trim($_POST["email_1"]) );
$email_2 = mysql_real_escape_string( trim($_POST["email_2"]) );
$student_id = mysql_real_escape_string( trim($_POST["student_id"]) );
$error_message = null;

if( strcmp($email_1, $email_2) != 0) {
  $error_message = "Both emails entered did not match!";
}
else{
  if(strlen($email_1) < 4 ){
    $error_message = "Invalid email length!";
  }
    else{
      $email = $email_1.'@spsu.edu';
      $result = do_forgot_password($email,$student_id);
      if($result == FALSE){
        $error_message = "Email and/or Student ID incorrect! Please reenter!";
      }
      else{
        $error_message = "Password has been reset! Please check your SPSU email for temporary password.";
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
                <input type="text" name="email_1" placeholder='SPSU Email' size="28">@spsu.edu<br>
                <input type="text" name="email_2" placeholder='ReEnter SPSU Email' size="28">@spsu.edu<br>
                <input type="password" name="student_id" placeholder='Student ID' size="40"><br>
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