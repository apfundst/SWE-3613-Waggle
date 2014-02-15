<?
ob_start();

include("other_funcs.php");

$email = $_POST["email"];
$student_id = $_POST["student_id"];
$password = $_POST["password"];
$copy_password = $_POST["copy_password"];
$error_message = null;

if($password != $copy_password){
  $error_message = "Both passwords entered did not match!";
}
else{
  $result = do_update_password($email,$student_id,$password);
  if($result == true){
    $error_message = "Password has been reset! Please return to home page to login.";

  }
  else{
    $error_message = "Email and/or Student ID incorrect! Please reenter!";
  }
}
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
    <div class="row">
      <!--Log in bar-->
      <div class="col_lg_4_center">
        <div class="panel">
          <div class="panel-heading">
            <center>Reset Password</center>
          </div>
          <div class="panel-body">
            <center>
              <p><? echo $error_message; ?></p>
              <form action="password_reset.php" method="post"enctype="multipart/form-data">
                <!--<label for="file">Email:</label>-->
                <input type="text" name="email" placeholder='SPSU Email' size="40"><br>
                <input type="text" name="student_id" placeholder='Student ID' size="40"><br>
                <!--<label for="file">Password:</label>-->
                <input type="password" name="password" placeholder='Enter New Password' size="40"><br>
                <input type="password" name="copy_password" placeholder='Reenter New Password' size="40"><br>
                <input type="submit" name="submit" value="Reset Password">
              </form>
            </center>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>