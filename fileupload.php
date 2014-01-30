<?php
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

      //header("Location: /index.php");
  }

  function upload_file_check($file_name, $counter)
  {
    //check if it exists
    echo "filename: " . $file_name . $counter;
    if (file_exists("upload/" . ($file_name . $counter)))
    {
      //if it does exist, counter++ and try again
      $counter = $counter + 1;
      echo "counter: " . $counter;
      upload_file_check($file_name, $counter);
    }
    else
    {
      //file doesn't exist, successfully uploads
      move_uploaded_file($_FILES["file"]["tmp_name"],
       "upload/" . $_FILES["file"]["name"];
       echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
    }
    
  }
?>