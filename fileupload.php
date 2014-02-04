<?php
ob_start();

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
      upload_to_database($thread_id, $fileNamePath, $creator);
       echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
    }
  }

  function upload_to_database($thread_id, $fileNamePath, $creator)
  {
    //*****************
      $sql = "
          INSERT INTO `file`(`thread_id`,`fileNamePath`,`creator`)
          VALUES('$thread_id','$fileNamePath','$creator')
      ";

      $result = mysql_query($sql);
      if (!$result)
      {
        mysql_query('ROLLBACK');
        return false;
      }
      else
      {
        return true;
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

    header('Location: http://www.waggle.myskiprofile.com/index.php');
    exit();
    }

ob_flush();  
?>