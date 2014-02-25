<?
ob_start();
session_start();
include("other_funcs.php");

$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$email_1 = $_POST["email_1"];
$email_2 = $_POST["email_2"];
$student_id_1 = $_POST["student_id_1"];
$student_id_2 = $_POST["student_id_2"];

$error_message = null;

if($email_1 != $email_2){
  $error_message = "Both emails entered did not match!";
}
if($student_id_1.strlen() != )
if($student_id_1 != $student_id_2){
  $error_message = "Both Student ID's did not match"



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
            <div class="panel-heading">Enter the information below to get signed up!</div>
          </center>
            <div class="panel-body">
            <center>
              <p><? echo $error_message; ?></p>
                <form action="new_user.php" method="post"enctype="multipart/form-data">
                <!--<label for="file">Email:</label>-->
                <input type="text" name="first_name" placeholder='First Name' size="40"><br>
                <input type="text" name="last_name" placeholder='Last Name' size="40"><br>
                <input type="text" name="email_1" placeholder='SPSU Email' size="40"><br>
                <input type="text" name="email_2" placeholder='ReEnter SPSU Email' size="40"><br>
                <input type="password" name="student_id_1" placeholder='Student ID' size="40"><br>
                <input type="password" name="student_id_2" placeholder='ReEnter Student ID' size="40"><br>
                <input type="submit" name="submit" value="Create Account">
                </form>
                <a href = "http://www.waggle.myskiprofile.com/">
                <input type="button" value= "Back to Front Page"></a>
          </center>
          </div>
          </div>
        </div>
  </body>
</html>