<?php
  include('admin/db_connect.php');
  $notification_id = $_POST['notification_id'];
  $query = "UPDATE notifications SET seen = 1 WHERE id = {$notification_id}";
  mysqli_query($conn, $query);
?>