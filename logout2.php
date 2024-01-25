<?php 
include('admin/db_connect');
unset($_SESSION);
session_start();
session_destroy();
header('location:./index.php?page=home');
session_write_close();
die;
?>




