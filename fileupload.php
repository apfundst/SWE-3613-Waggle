<?php
session_start();
ob_start();
include_once('connection.php');

function rename_file($file_name, $counter)
  {
    $extension = strpos($file_name, '.');
    if ($extension === false)
    {
      //if there is no extension
      echo "No File Extension Found";
      $new_ext = "";
    }

    $new_ext = substr($file_name, $extension);
    //$new_file_name = $_FILES["file"]["name"] . $new_ext;
    $path_parts = pathinfo($file_name);
    $new_filename = $path_parts['filename'] . "v". $counter . $new_ext;
    echo $new_filename;
    return $new_filename;
  }

  function upload_file_check($file_name, $counter)
  {
    if($counter < 1)
    {
      echo "filename: " . $file_name . "v". $counter;
    }
    $temp_name1 = rename_file($file_name, $counter);
    //check if it exists
    if (file_exists("upload/" . $temp_name1))
    {
      //if it does exist, counter++ and try again
      $counter = $counter + 1;
      echo "counter: " . $counter;
      upload_file_check($file_name, $counter);
    }
    else
    {
      $temp_name = rename_file($file_name, $counter);
      
      //file doesn't exist, successfully uploads
      move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $temp_name);

      $fileNamePath = "upload/" . $temp_name;
      $creator = $_SESSION["email"];
      $thread_id = $_SESSION['current_group_id'];
      $file_name = $_SESSION['file_name'];
      $file_size = $_SESSION['file_size'];
      $bool_returned = upload_to_database($thread_id, $fileNamePath, $creator, $file_name, $file_size);
      if($bool_returned==TRUE){
        header('Location: http://www.waggle.myskiprofile.com/index.php');
        exit();

      }
      else{
        echo "peter screwed up somewhere else!!!!!!!<br>";
        echo $bool_returned;

      }
       //echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
    }
  }

  function upload_to_database($thread_id, $fileNamePath, $creator, $file_name, $file_size)
  {
    //*****************
      $sql = "
          INSERT INTO `file`(`group_id`,`file_name_path`,`creator`, `file_name`, `file_size`)
          VALUES('$thread_id','$fileNamePath','$creator', '$file_name', '$file_size')
      ";

      $result = mysql_query($sql);
      if (!$result)
      {
        mysql_query('ROLLBACK');
        return "Invalid query: " .mysql_error();
      }
      else
      {
        return $result;
      }
    //***************
  }
  //actual execution of uploading file to database

  if ($_FILES["file"]["error"] > 0)
    {
      echo "Error: " . $_FILES["file"]["error"] . "<br>";
    }
    else
    {
    //change file name if already exists
  
    //debug echos  
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
  
    upload_file_check($_FILES["file"]["name"], 0);

    
    
  }

ob_flush();  
?>