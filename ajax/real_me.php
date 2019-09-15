<?php
  $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
  $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
  $character = trim(filter_var($_POST['character'], FILTER_SANITIZE_STRING));
  $contact = trim(filter_var($_POST['contact'], FILTER_SANITIZE_STRING));

  $error='';
  if(strlen($username) <= 3)
  $error = 'Введите имя';
  else if(strlen($email) <= 3)
  $error = 'Введите email';
  else if(strlen($character) <= 3)
 $error = 'ну хотябы пару слов о себе';
  else if(strlen($contact) <= 3)
  $error = 'Введите контакты';

if($error != ''){
echo $error;
exit();
}

require_once '../mysql_connect.php';

$sql = 'SELECT `id_player` FROM `player` WHERE `nick` = :nick';
$query = $pdo->prepare($sql);
$query->execute(['nick'=> $username]);
$user = $query -> fetch(PDO::FETCH_OBJ);// позволяет вытащить только одну запись из бд

if ($user == NULL || $username==$_COOKIE['nickname'])
{
  $sql = 'UPDATE `player` SET `nick` = :nickUp , `e_mail`=:email,   `about_yourself`= :character1, `contact` = :contact
   WHERE  `nick` = :nick';
  $query3 = $pdo->prepare($sql);
  $query3->execute(['nickUp' => $username , 'email' => $email , 'character1' => $character, 'contact' => $contact, 'nick' => $_COOKIE['nickname']]);


  setcookie('nickname', $username, time()-3600*24*30, "/");
  unset($_COOKIE['nickname']);

  setcookie("nickname", $username, time() + 3600 * 24 * 30, "/");
    echo 'готово';
}
else {
 echo 'Игрок с таким ником уже существует';
  exit();
}
?>
