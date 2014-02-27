<?php 
session_start();
include 'other_funcs.php';
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
else{
  
    $thread_id= '';
    $current_group_name = '';
  if($_POST['thread_id']){
    $group_status = do_get_group_ban_status($_SESSION['current_group_id']);
    if($group_status == 0){
      header('Location: http://www.waggle.myskiprofile.com/index.php');
      exit();
    }else{
      $current_group_name = do_get_group_name($_SESSION['current_group_id']);
      $thread_id = $_POST["thread_id"];
      $_SESSION['current_thread_id'] = $thread_id;
      $thread_name = do_get_thread_subject($_SESSION['current_thread_id']);
      $thread = do_get_messages($thread_id);
      if(is_null($thread)){
        $messages_html = 'No Posts Yet';
      }
      else{
        $messages_html = '';
        $messages_protected = '';
        $message_delete ='';
        $message_edit = '';
        foreach ($thread as $value) {
             $name = do_get_name($value['2']);
              
              
              
              $group_accessor = do_get_creator($_SESSION['current_group_id']);

              if($value[2] == $_SESSION['email']){
                $messages_html .= '<li id="threadItem"><span style="float:left;color:#0cb270;">' . $name . ' -- ' . $value[4].'</span><div class="postInfo">
                                    <form  enctype="multipart/form-data" action="edit_message.php" method="post" style="display:inline;">

                                    <span class="postEdit">
                                    <input type="hidden" name="message_id" value="'.$value[0].'">
                                    <input type="hidden" name="message_text" value="'.$value[3].'">
                                    <input class="editLink"type="submit" value="edit">
                                    </span> 
                                    </form>  
                                    <form  enctype="multipart/form-data" action="delete_message.php" method="post" style="display:inline;">
                                    <span class="postDelete">
                                    <input type="hidden" name="message_id" value="'. $value[0] . '">
                                    <input class="editLink"type="submit" value="delete">
                                    </span>
                                    </form>
                                    </div><br><hr><p>'.$value[3] . '</p><br><br></li>';

                
              }elseif(($_SESSION['is_admin'] == 1) || ($group_accessor == $_SESSION['email'])){
                $messages_html .= '<li id="threadItem"><span style="float:left;color:#0cb270;">' . $name . ' -- ' . $value[4].'</span><div class="postInfo">
                                    <form  enctype="multipart/form-data" action="delete_message.php" method="post" style="display:inline;">
                                    <span class="postDelete">
                                    <input type="hidden" name="message_id" value="'. $value[0] . '">
                                    <input class="editLink"type="submit" value="delete">
                                    </span>
                                    </form>
                                    </div><br><hr><p>'.$value[3] . '</p><br><br></li>';

                
              }else{
              $messages_html .= '<li id="threadItem"><span style="float:left;color:#0cb270;">' . $name . ' -- ' . $value[4].'</span><p>'.$value[3] . '</p><br><br></li>';

              }
              
        }
      }
    }
  }
  elseif(isset($_SESSION['current_thread_id']))
  {
    $group_status = do_get_group_ban_status($_SESSION['current_group_id']);
    if($group_status == 0){
      header('Location: http://www.waggle.myskiprofile.com/index.php');
      exit();
    }else{
      $current_group_name = do_get_group_name($_SESSION['current_group_id']);
      $thread_id = $_SESSION['current_thread_id'];
      $thread_name = do_get_thread_subject($_SESSION['current_thread_id']);
      $thread = do_get_messages($thread_id);
      if(is_null($thread)){
        $messages_html = 'No Posts Yet';
      }
      else{
        

        $messages_html = '';
        foreach ($thread as $value) {
             $name = do_get_name($value['2']);
              
              
              
              $group_accessor = do_get_creator($_SESSION['current_group_id']);

              if($value[2] == $_SESSION['email']){
                $messages_html .= '<li id="threadItem"><span style="float:left;color:#0cb270;">' . $name . ' -- ' . $value[4].'</span><div class="postInfo">
                                    <form  enctype="multipart/form-data" action="edit_message.php" method="post" style="display:inline;">

                                    <span class="postEdit">
                                    <input type="hidden" name="message_id" value="'.$value[0].'">
                                    <input type="hidden" name="message_text" value="'.$value[3].'">
                                    <input class="editLink"type="submit" value="edit">
                                    </span> 
                                    </form>  
                                    <form  enctype="multipart/form-data" action="delete_message.php" method="post" style="display:inline;">
                                    <span class="postDelete">
                                    <input type="hidden" name="message_id" value="'. $value[0] . '">
                                    <input class="editLink"type="submit" value="delete">
                                    </span>
                                    </form>
                                    </div><br><hr><p>'.$value[3] . '</p><br><br></li>';

                
              }elseif(($_SESSION['is_admin'] == 1) || ($group_accessor == $_SESSION['email'])){
                $messages_html .= '<li id="threadItem"><span style="float:left;color:#0cb270;">' . $name . ' -- ' . $value[4].'</span><div class="postInfo">
                                    <form  enctype="multipart/form-data" action="delete_message.php" method="post" style="display:inline;">
                                    <span class="postDelete">
                                    <input type="hidden" name="message_id" value="'. $value[0] . '">
                                    <input class="editLink"type="submit" value="delete">
                                    </span>
                                    </form>
                                    </div><br><hr><p>'.$value[3] . '</p><br><br></li>';

                
              }else{
              $messages_html .= '<li id="threadItem"><span style="float:left;color:#0cb270;">' . $name . ' -- ' . $value[4].'</span><br><hr><p>'.$value[3] . '</p><br><br></li>';

              }
              
        }
        


      }
    }
  }
  if($_SESSION['current_group_id']){
    $group_status = do_get_group_ban_status($_SESSION['current_group_id']);
    if($group_status == 0){
      header('Location: http://www.waggle.myskiprofile.com/index.php');
      exit();
    }else{
      $current_files = do_get_files($_SESSION['current_group_id']);
      if (is_null($current_files))
      {
         $files_html = 'No files have been uploaded yet!';
      }
      else
      {
        $files_html='';
        foreach($current_files as $files)
        {
         $file_creator = do_get_file_creator($files[2]);
          $file_creator_name = do_get_name($file_creator);
          $file_created_date = do_get_file_date_created($files[0]);
          $files_html .= '<tr class="tr_clickable" id="goups_background" ><td id="main_data" ><a href="'.$files[2].'" download="'.$files[3].'"id="table_contents_file">'.$files[3].'</a></td>';
          $files_html .= '<td id="side_data_l"> '.$files[4].'</td>';
          $files_html .= '<td id="side_data_l">'.$file_creator_name.'</td>';
          $files_html .= '<td id="side_data_l">'.$file_created_date.'</td>';

          if($file_creator == $_SESSION['email'] || $_SESSION['email'] == $_SESSION['current_group_creator'] || $_SESSION['is_admin'] == 1){  //add admin to this function checking
             $files_html .= '<td id="side_data_s"><form action="delete_file.php" method="post">
                              <input type="hidden" name="file_path" value="'.$files[2].'">
                              <input  class="deleteFile" type="submit" value="Delete File"></form></td>';
          }
          $file_html .= '</tr>';
        }
      //files section ends
      }

      $current_group_id = $_SESSION['current_group_id'];
      $current_group_name = do_get_group_name($current_group_id);

      $current_threads = do_get_threads($current_group_id);
      $members = do_get_group_members($current_group_id);
      
        foreach ($members as $yolo) {
          $name = do_get_name($yolo[0]);
          $group_member_list .= $name . '<br>';
        }
      
      $create_thread_button_html ='<div style="
        float:right;
        display: inline;
        border: 1px solid #ddd;
        background-color: #ecf0f1;
        padding: 3px;
        color:white;
        margin-right: 20px;
        font-size: 15px; "><a href="new_thread.php">Create New Thread</a></div>';
      if (is_null($current_threads)){
        $threads_html = 'No Threads in this group Yet!<br>';
        //echo $_SESSION['current_group_id'];
      }
      else{
      $threads_html = '';

      foreach($current_threads as $things)
      {
        if($things[0] == $thread_id ){
          //$threads_html .= '<form enctype="multipart/form-data" action="thread.php" method="post">
                            //  <input type="hidden" name="thread_id" value="'. $things[0] . '"><input type="submit" name="submit" id="input_a_active" value="';
          //$threads_html .= $things[3] . '"/></form>';
          //do nothing if its ther current thread

        }else{
          $threads_html .= '<tr class="tr_clickable" id="goups_background" >
                            <td id="main_data" style="padding:0px;"><form enctype="multipart/form-data" action="thread.php" method="post">
                              <input type="hidden" name="thread_id" value="'. $things[0] . '"><input type="submit" name="submit" id="table_contents" value="';
          $threads_html .= $things[3] . '"/></form></td></tr>';
        }

      }
      

    }

   }
  }

  if ($_POST['new_message'] ) {
    
    
      do_post_message($_SESSION['current_thread_id'], $_SESSION["email"], $_POST['new_message']);
      //$current_url = '"http://www.waggle.myskiprofile.com/thread.php?thread_id='.$thread_id.'"';
      header('Location: http://www.waggle.myskiprofile.com/thread.php');
      exit();
   
  }
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Waggle | Student Solution</title>
<link rel="stylesheet" type="text/css" href="css.css">
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
</head>

 
<body>
<!--<div id="header"> header </div>
<div id="left-sidebar"> left-sidebar </div>
<div id="content"> content </div>-->

  <? if($_SESSION['email'] == 'admin@spsu.edu'){
    include('admin_nav.php');
  }
  else{
    include('nav.php');
  }
  ?>
  <div class="row">
    <div class="col-lg-8">
      <div class="group-name">
        <h1><a href="group.php"><?=$current_group_name ?></a></h1>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="panel panel-default">
        <div class="panel-heading">Group Members</div>
        <div class="panel-body">

          <?=$group_member_list ?>


        </div>
      </div>
    </div>
  </div>
  <div class"row">
    <div class="col-lg-8">
      
      <div class="panel panel-default">
        <div class="panel-heading">Thread: <?=$thread_name;?>
        <?
        //if admin echo this html as string
        $maker = do_get_thread_creator($_SESSION['thread_id']);
        if(($_SESSION['is_admin'] == 1) || ($group_accessor == $_SESSION['email']) || ( $maker= $_SESSION['email'])){
          echo'
            <div style="float:right; display: inline; margin-right: 20px;">
              <form action="delete_thread.php" method="post" enctype="multipart/form-data">
              <input type="hidden" name="thread_id" value="'.$_SESSION['current_thread_id'].'" >
              <input type="submit" value="Delete Thread">
              </form>
              </div>
            ';
        }
        ?>
        </div>
        <div class="panel-body" >
        <form id="new_post"method="post" action="thread.php">
        
          <label>Enter your comments here...</label><br>
            <textarea name="new_message" style="width:100%; height:150px;">
            
            </textarea><br>
            <!--<input type="submit" value="Submit" onclick="this.submit(function (){this.disabled='true';});" >-->
            <button id="new_m" type="submit">Submit</button>
            <script>
              $("#new_post").submit(function(e){
                //alert( "Handler for .submit() called." );
                //$(this).attr('disabled', 'disabled');
                //$("new_post").submit();
                var result = confirm("Are you sure you want to leave?");
                if(result){
                  //do nothing they want to leave
                }
                else{
                  e.preventDefault();
                }
                
              });

            </script>
          </form>
          <br>
          <hr>

            <div class="panel-heading">Posts: <?=$thread_name;?></div>
          <ul >
          <?=$messages_html ?>
          </ul>
          


      </div>
      </div>
    </div>
    <div class="col-lg-4">

      <div class="panel panel-default">
        <div class="panel-heading">Other Threads for <?=$current_group_name ?></div>
        <div class="panel-body">
          <div class="scroll_table_files" style="height:300px">
          <table id="goups_background">
            <thead>
                <tr class="tr_non_clickable"id="goups_background">
                <th id="main_data" style="background-color:#222;color:white;">
                Thread Name

                </th>
                </tr>
              </thead>
              <tbody>

                <?=$threads_html ?>
              </tbody>
          </table>

          </div>

       </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">Files</div>
        <div class="panel-body">
          <div class="scroll_table_files" style="height:400px">
            <table id="goups_background">
                <thead>
                <tr class="tr_non_clickable"id="goups_background">
                <th id="main_data" style="background-color:#222;color:white;">
                File Name

                </th>
                <th id="side_data_s" style="background-color:#222;color:white;">
                File Size
                </th>

                <th id="side_data_l" style="background-color:#222;color:white;">
                Creator
                </th>
                <th id="side_data_s" style="background-color:#222;color:white;">
                Date Uploaded
                </th>
                <th id="side_data_s" style="background-color:#222;color:white;">
                Options
                </th>
                </tr>
                </thead>

            
            
                
                <tbody >
                <?=$files_html; ?>
                </tbody>
                
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>


<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Inconsolata">

</body>
</html>