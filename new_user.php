<?
ob_start();
session_start();
include("other_funcs.php");
if($_POST){
$first_name = mysql_real_escape_string( trim($_POST["first_name"])  );
$last_name = mysql_real_escape_string( trim($_POST["last_name"]) ) ;
$email_1 = mysql_real_escape_string( trim($_POST["email_1"]) );
$email_2 = mysql_real_escape_string( trim($_POST["email_2"]) );
$student_id_1 = mysql_real_escape_string( trim($_POST["student_id_1"]) );
$student_id_2 = mysql_real_escape_string( trim($_POST["student_id_2"]) );
$name = $first_name ." ". $last_name;

$illegals = '([[:digit:]]|[~`!@#$%^&*()_=+{}|\:;"/?,]|[|]|-)+';
if( strlen($name) < 4 ){
  $error_message = "You have to put in a name!";
}
else{
  if ( ereg($illegals, $name ) ) {
    $error_message = "Names entered contained illegal characters!";
  }
  else{
    if( strcmp($email_1,$email_2) != 0 ){
    $error_message = "Email addresses did not match!";
    }
    else{
      if( !ctype_alnum($email_1) || strlen($email_1) < 4 ){
        $error_message = "Email address is incorrect format!";
      }
      else{
        if( strcmp($student_id_1,$student_id_2) != 0 ){
          $error_message = "Student ID's did not match!";
        }
        else{
          if( !ctype_digit($student_id_1) || strlen($student_id_1) != 9 ){
            $error_message = "Incorrect Student ID format!";
          }
          else{
            $email = $email_1."@spsu.edu";
            $check = do_check_user($email);
            if( $check ){
              $error_message = "You are already a member of WAGGLE!";
            }
            else{
              $random_password = do_create_random_password(); 
              $created = do_create_user($email,$random_password,$first_name,$last_name,$student_id_1);
              if($created){
                $email_success = do_send_new_user_email($email, $first_name, $last_name, $random_password);
                if($email_success){
                  $_SESSION["created"] = TRUE;
                  header('Location: http://www.waggle.myskiprofile.com/new_user_success.php');
                  exit();
                }
                else{
                  $error_message = "Email didn't work with this info:";
                }
              }
              else{
                $error_message = "Failed to create user account! Please reenter information.";
              }

            }// Else for check email in DB

          }// Else to check student_id
        }//
      } 
    }
  }
}//First else that checked names
}//end first if
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
                <input type="text" name="email_1" placeholder='SPSU Email' size="28">@spsu.edu<br>
                <input type="text" name="email_2" placeholder='ReEnter SPSU Email' size="28">@spsu.edu<br>
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