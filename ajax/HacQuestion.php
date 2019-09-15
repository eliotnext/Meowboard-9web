<?php
  $question = trim(filter_var($_POST['question'], FILTER_SANITIZE_STRING));
  $error = '';

  if(strlen($question) <= 5)
  $error = 'Введите в вопросы';


if ($error != ''){
  echo $error;
  exit();
}

require_once '../HacMysql_connect.php';

$sql = 'INSERT INTO `list_questions`  (id_playing) VALUES (?)';
$query1 = $pdo->prepare($sql);
$query1->execute([$rowIdPlaying->id_playing]);

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
