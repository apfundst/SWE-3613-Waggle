<?
session_start();
include("other_funcs.php");
include("nav.php");
$user_status = do_get_ban_status($_SESSION['email']);
if(!isset($_SESSION["email"])){
  header('Location: http://www.waggle.myskiprofile.com/login.php');
  exit();
}
if($user_status == 0){
  header('Location: http://www.waggle.myskiprofile.com/login.php?err=You%20have%20been%20banned');
  exit();
}
if($_POST){
  $email = $_SESSION["email"];
  $current_password = mysql_real_escape_string( trim($_POST["current_password"]) );
  $password_1 = mysql_real_escape_string( trim($_POST["password_1"]) );
  $password_2 = mysql_real_escape_string( trim($_POST["password_2"]) );
  $error_message = null;

  if( !do_check_user_password($email, $current_password) ){
    $error_message = "Your current password does not match the one entered!";
  }
  else{
    if( strcmp($password_1,$password_2) != 0 ){
      $error_message = "Both new passwords entered did not match!";
    }
    else{
      if( strlen($password_1) < 8){
        $error_message = "Password must be 8 characters or greater!";
      }
      else{
        $result = do_change_password($email,$password_1);
        if($result == true){
          $error_message = "Password has been successfully changed!";
        }
        else{
          $error_message = "FAILED to reset password! Please reenter";
        }
      }
    }
  }
}
?>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="css.css">
  </head>
  <body>
     <div class="col-lg-4">
        <div class="panel">
          <center>
            <div class="panel-heading">Change Password</div>
          </center>
            <div class="panel-body">
            <center>
              <p><? echo $error_message; ?></p>
                <form action="user_settings.php" method="post"enctype="multipart/form-data">
                <input type="password" name="current_password" placeholder='Enter Current Password' size="40"><br>
                <input type="password" name="password_1" placeholder='Enter New Password' size="40"><br>
                <input type="password" name="password_2" placeholder='Reenter New Password' size="40"><br>
                <input type="submit" name="submit" value="Change Password">
                </form>
          </center>
          </div>
          </div>
        </div>
  </body>
</html>