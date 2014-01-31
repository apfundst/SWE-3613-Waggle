<?php 
include 'other_funcs.php';

$thread_id = $_GET["thread_id"];
$thread = do_get_messages($thread_id);
$messages_html = '';
foreach ($thread as $value) {
  $messages_html .= '<li id="threadItem">' . $value['message_text'] . '<br><br>';
  $messages_html .= '<span class="postInfo">' . $value['owner'] . ' -- ' . $value['date_created'];
  $messages_html .= '</span></li>'
 
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Waggle | Student Solution</title>
<link rel="stylesheet" type="text/css" href="css.css">
</head>

 
<body>
<!--<div id="header"> header </div>
<div id="left-sidebar"> left-sidebar </div>
<div id="content"> content </div>-->
<div class="container-fluid">
<nav class="navbar-default navbar" role="navigation">
<img src="http://www.thetachi.org/clientuploads/News/SPSU_LOGO_RGB.jpg" height="60">
Waggle
<div style="float: right;">
  <ul>
    
    <li><a href="#">Log Out</a></li>
  </ul>
</div>
</nav>
<div class="col-lg-8">
  
  <div class="panel panel-default">
    <div class="panel-heading">Thread Name</div>
    <div class="panel-body">

<ul >
    <?php=$messages_html ?>
  </ul>


  </div>
  </div>
</div>
<div class="col-lg-4">
<div class="panel panel-default">
<div class="panel-heading">Disscusion Threads</div>
    <div class="panel-body">

<ul >
    <li id="listItem">item 1</li>
    <li id="listItem">item 2</li>
    <li id="listItem">item 3</li>
    <li id="listItem">item 1</li>
    <li id="listItem">item 2</li>
    <li id="listItem">item 3</li>
  </ul>


 </div>
  </div>
<div class="panel panel-default">
    <div class="panel-heading">User Details</div>
    <div class="panel-body">
    User details go here I guess
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">Group memebers</div>
    <div class="panel-body"><form action="fileupload.php" method="post"
enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file" id="file"><br>
<input type="submit" name="submit" value="Submit">
</form>
    </div>
  </div>
</div>
</div>

<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Inconsolata">

</body>
</html>