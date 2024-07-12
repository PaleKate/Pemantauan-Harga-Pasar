<?php 
session_start();
unset($_SESSION['login_saharga']);

header("location: ../../home");
exit;
?>