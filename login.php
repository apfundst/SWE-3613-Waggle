<?

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
    $pass = $_POST['password'];

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
        $error_message = "Login failed.  Please check your userid and password.";
      }
      else {
        
        // Get the information from the result set
        $row = mysql_fetch_assoc($result);
        // Put information into temp variables
        $email = $row['email'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        // Create session variables to use throughout login
        $_SESSION['email'] = $email;
        $_SESSION['first_name'] = $first_name;
        $_SESSION['last_name'] = $last_name;

        header("Location: /index.php");

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
  <div class="row"
  <div class="col-lg-4">
  </div>
  <div class="col-lg-12">
    <div class="panel">
      <div class="panel-heading">
        <center>Login Here</center>
      </div>
      <div class="panel-body">
        <center>
          <p><? echo $error_message; ?></p>
        <form action="login.php" method="post"enctype="multipart/form-data">
        <label for="file">Email:</label>
        <input type="text" name="email" for="userid"><br>
        <label for="file">Password:</label>
        <input type="password" name="password" for="pass"><br>
        <input type="submit" name="submit" value="Submit">
        </form></center>
      </div>
    </div>

</div>
</div>
</body>
</html>