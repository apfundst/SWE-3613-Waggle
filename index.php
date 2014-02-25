<?
session_start();
include('other_funcs.php');
$user_status = do_get_ban_status($_SESSION['email']);
if(!isset($_SESSION["email"]))
{
  header('Location: http://www.waggle.myskiprofile.com/login.php');
  exit();
}
elseif($user_status == 0){
  header('Location: http://www.waggle.myskiprofile.com/login.php?err=You%20have%20been%20banned');
  exit();
}
else
{ 
  $_SESSION['is_admin'] = user_is_admin($_SESSION["email"]);
  $_SESSION['current_group_id'] = '';
  $threads_html = 'Select a Group!';
 

 //if statement to check if admin
 // Admins are going to have regular user pages as well as admin group access
 $groups = do_get_groups($_SESSION["email"]); 

  //endif
  if(is_null($groups))
  {
    $groups_html = 'You are not in any groups yet!';
  }
  else{
    $groups_html = '';
    foreach ($groups as $things) {
      $group_status = do_get_group_ban_status($things[0]);
      if($group_status == 1){
        $name = do_get_name($things[2]);
      //document.getElementById("frmUserList").submit();
        $groups_html .= '<tr class="tr_clickable" id="goups_background"><td id="main_data">'
        $groups_html .= '<form enctype="multipart/form-data" action="group.php" method="post">
                            <input type="hidden" name="group_id" value="'. $things[0] . '"><input type="submit" name="submit" id="table_contents" value="';
        $groups_html .= $things[1] . '"/></form></td><td id="side_data_s">5</td><td id="side_data_l">'.$name.'</td>
    </tr>';
      
      }
    } 
  }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
<?
if($_SESSION["is_admin"] == 1){
  include('admin_nav.php');
}
else{ 
  include('nav.php'); 
}
?>
<div class="row">
<div class="col-lg-12">
  <div class="panel panel-default">
    <div class="panel-heading">Your Groups<div style="
    float:right;
    display: inline;
    border: 1px solid #ddd;
    background-color: #ecf0f1;
    padding: 3px;
    color:white;
    margin-right: 20px;
    font-size: 15px; "><a href="new_group.php">Create New Group</a></div></div>
    <div class="panel-body">

      <table id="goups_background">
        <thead>
        <tr class="tr_non_clickable"id="goups_background">
        <th id="main_data" style="background-color:#222;color:white;">
        Group Name

        </th>
        <th id="side_data_s" style="background-color:#222;color:white;">
        Number of Members
        </th>
        <th id="side_data_l" style="background-color:#222;color:white;">
        Creator
        </th>
        </tr>
        </thead>
        <tbody>


        <?=$groups_html ?>
        </tbody>
    </table>
  

 </div>
  </div>
  
</div>
</div>
<div style="color:#f8f8f8">linkware: <a href="http://www.visualpharm.com">here</a>
</div>
</div>

<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Inconsolata">

</body>
</html>