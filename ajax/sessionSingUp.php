<?php session_start();
$_SESSION['masterName'] = $_POST['masterName'];
$_SESSION['time'] = $_POST['time'];
$_SESSION['date']  = $_POST['date'];
$_SESSION['place']  = trim(filter_var($_POST['place'], FILTER_SANITIZE_STRING));
echo 'replace';
?>
