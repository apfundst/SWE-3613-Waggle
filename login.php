<?

session_start();
$error_message = null;
if ($_POST) {
  $con = mysqli_connect("localhost","jsalvo_group8","waggle_password","jsavlo_waggle");
  if (!$con) {
    die('Could not connect: ' . mysql_error());
  }
  else{
    $userid = check_param('userid', 'string', null, null);
    $pass = check_param('pass', 'string', null, null);

    $sql = "
      SELECT *
      FROM user
      WHERE email = '$email'
      AND password = '$password'
    ";

    $result = mysql_query($sql);
    if (!$result) {
      preit(mysql_error());
    }
    else {
      if (mysql_num_rows($result) == 0) {
        $error_message = "Login failed.  Please check your userid and password.";
      }
      else {
        header("Location: /index.php");
        /*$row = mysql_fetch_assoc($result);
        $email = $row['email'];
        $doctor_name = $row['doctor_name'];
        $_SESSION['doctor_id'] = $doctor_id;
        $_SESSION['doctor_name'] = $doctor_name;*/

      }
    }
  }
}


if (!array_key_exists('doctor_id', $_SESSION)) {
?>
<html>
<head>
</head>

<style type="text/css">
 body{
  margin:0;
  padding:header-<length> 0 0 left-sidebar-<length>;
  font-family: 'Inconsolata', serif;
 }
 div#header{
  position:absolute;
  top:0;
  left:0;
  width:500%;
  height:header-<length>;
 }
 div#left-sidebar{
  position:absolute;
  top:header-<length>;
  left:0;
  width:left-sidebar-<length>;
  height:100%;
 }
 @media screen{
  body>div#header{
   position:fixed;
  }
  body>div#left-sidebar{
   position:fixed;
  }
 }
 * html body{
  overflow:hidden;
 } 
 * html div#content{
  height:100%;
  overflow:auto;
 }
 div {
  display: block;
}
body {
    background-color: #f8f8f8;
}
#wrapper {
    width: 100%;
}

#page-wrapper {
    padding: 0 15px;
    min-height: 568px;
    background-color: #fff;
}
.container-fluid {
  padding-right: 15px;
  padding-left: 15px;
  margin-right: auto;
  margin-left: auto;
}

.row {
  margin-right: -15px;
  margin-left: -15px;
}
.col-lg-4, .col-lg-8,  .col-lg-12 {
    float: left;
  }
.col-lg-12 {
    width: 100%;
  }
  
.col-lg-8 {
    width: 66.66666666666666%;
  }
  
.col-lg-4 {
    width: 33.33333333333333%;
  }
 
.navbar {
  position: relative;
  min-height: 50px;
  margin-bottom: 20px;
  border: 1px solid transparent;
  background-color: #0e855b;
  padding: 10px
}
.navbar-default {
  background-color: #0e855b;
  border-color: #e7e7e7;
}
.navbar-static-side {
  z-index: 1;
  position: absolute;
  width: 250px;
}
.navbar-default {
  background-color: #f8f8f8;
  border-color: #e7e7e7;
}
.panel {
  margin-bottom: 20px;
  margin-left: 20px;
  margin-right: 20px
  background-color: #fff;
  border: 1px solid transparent;
  border-radius: 3px;
  -webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.05);
  box-shadow: 0 1px 1px rgba(0,0,0,0.05);
}
.panel-default {
  border-color: #ddd;
}
.panel-heading {
  color: #333;
  background-color: #6dc378;
  border-color: #ddd;
  padding: 15px;
}
.panel-body {
  color: #333;
  background-color: #ffffff;
  border-color: #ddd;
  padding: 10px;
}
nav {
  display: block;
  
}
nav li{
  display: inline;
  border: 1px solid #ddd;
  background-color: #6dc378;
  padding: 8px;
  margin-left: 10px;
  font-size: 20px;
}
a{
  text-decoration:none;
  color: #3399CC;

}
#listItem{
 position: relative;
display: block;
padding: 10px 15px;
margin-bottom: -1px;
background-color: #fff;
border: 1px solid #ddd;
}
#listItem:hover{
  background-color: #6dc378; 
}
</style>
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
          <p><?= $error_message ?></p>
        <form action="login.php" method="post"enctype="multipart/form-data">
        <label for="file">Email:</label>
        <input type="text" name="email" for="userid"><br>
        <label for="file">Password:</label>
        <input type="text" name="password" for="pass"><br>
        <input type="submit" name="submit" value="Submit">
        </form></center>
      </div>
    </div>

</div>
</div>
</body>
</html>