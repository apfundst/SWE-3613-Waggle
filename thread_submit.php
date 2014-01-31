<?
if ($_POST) {
  do_post_message($thread_id, $_SESSION['email'], $_POST['new_message']);
  header('Location: http://www.waggle.myskiprofile.com/thread.php?thread_id='.$thread_id);
  exit();
}
?>