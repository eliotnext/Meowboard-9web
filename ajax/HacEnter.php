<?php
  $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
  $pass = trim(filter_var($_POST['pass'], FILTER_SANITIZE_STRING));
  $error = '';

  if(strlen($username) <= 3)
  $error = 'Введите логин';
  else if(strlen($pass) <= 3)
  $error = 'Введите пароль';


if ($error != ''){
  echo $error;
  exit();
}

$hash = "elinor";
$pass = md5($pass . $hash);

require_once '../HacMysql_connect.php';

$sql = 'SELECT `id_user` FROM `user` WHERE `login` = :login  && `pass` = :pass';
$query = $pdo->prepare($sql);
$query->execute(['login'=> $username, 'pass' => $pass]);

$user = $query -> fetch(PDO::FETCH_OBJ);// позволяет вытащить только одну запись из бд
if ($user == NULL)
echo 'Такого пользователя не существует или неверный пароль';
else {
  setcookie("nickname", $username, time() + 3600 * 24 * 30, "/");

  echo 'готово';
}
// header("Location: /index.php");
//Потогм вставим сюда личный кабинет
?>
