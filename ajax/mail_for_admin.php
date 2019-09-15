<?php
 session_start();
  $nameSender = trim(filter_var($_POST['nameSender'], FILTER_SANITIZE_STRING));
  $emailSender = trim(filter_var($_POST['emailSender'], FILTER_SANITIZE_EMAIL));
  $text_mail = trim(filter_var($_POST['text_mail'], FILTER_SANITIZE_STRING));

  $error='';
  if(strlen($nameSender) <= 3)
  $error = 'Введите имя';
  else if(strlen($emailSender) <= 3)
  $error = 'Введите email';
  else if(strlen($text_mail) <= 3)
 $error = 'Введите текст послания, который вы хотите донести до админов';

if($error != ''){
echo $error;
exit();
}

require_once '../mysql_connect.php';

$sql = 'INSERT INTO mail_for_admin (name_sender, email_sender, text_mail) VALUES (?, ?, ?)';
$query = $pdo->prepare($sql);
$query->execute([$nameSender, $emailSender, $text_mail]);
$user = $query -> fetch(PDO::FETCH_OBJ);// позволяет вытащить только одну запись из бд

echo 'готово';

?>
