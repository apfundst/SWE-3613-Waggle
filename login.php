<?
include 'other_funcs.php';
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
        $ban = do_get_ban_status($email);
        if($ban == 0){
          $error_message = "You can't login because you have been banned!";
        }
        else{

        
          $_SESSION["email"] = $email;
          $_SESSION["first_name"] = $first_name;
          $_SESSION["last_name"] = $last_name;
          unset($_SESSION['current_group_id']);
          /*if($email == 'admin@spsu.edu')
          {
            header('Location: http://www.waggle.myskiprofile.com/admin.php');
            exit();
          }*/

          header('Location: http://www.waggle.myskiprofile.com/index.php');
          exit();
          ob_flush();
        }

      }
    }
  }
}
if($_GET['err']){

  $error_message = $_GET['err'];
}

?>
<html>
  <head>
     <link rel="stylesheet" type="text/css" href="css.css">
    <link rel="stylesheet" type="text/css" href="LOGIN/css.css">

  </head>
  <body>
		<!-- Create Logo at the top of the screen -->
		<!--Black bar at the top of the screen.-->
		<div class="navbar">
			<img class="logoImg"src="LOGIN/LOGOWAGGLEv4.2.png" height="75">
		</div>
		<!--The big picture-->
		
			
          
          
          <div class="col-lg-4" style="margin-left:33%; ">
					<!--The Login section-->
          <div class="panel-heading">Log In</div>
					<div class="panel-body" style="height:500px;">
					
          <!--<div id="cf" style="height:300px; width:300px; margin-top:75px; float:left;">
              <img class="bottom" src="LOGIN/beehive3.png" />
              <img class="top" src="LOGIN/beehive5.png" />
          </div>-->
          <div style="margin-left:25%;margin-top:150px;">
						<form action="login.php" method="post"enctype="multipart/form-data">
							<!--<label for="file">Email:</label>-->
							<input type="text" name="email" placeholder='SPSU Email' size="40" for="userid"><br>
							<!--<label for="file">Password:</label>-->
							<input type="password" name="password" placeholder='Password' size="40" for="pass"><br>
							<input type="submit" name="submit" value="Login">
						</form>
						<a href="http://www.waggle.myskiprofile.com/password_reset.php">
						<input type="button" value= "Forgot Password?"></a>
						<a href="http://www.waggle.myskiprofile.com/new_user.php">
						<input type="button" value= "New User Sign Up"></a>
					</div>
					</div>
        </div>
			
		
	</body>
</html>