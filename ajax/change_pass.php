<?php
  $pass = trim(filter_var($_POST['pass'], FILTER_SANITIZE_STRING));
  $passrepeat = trim(filter_var($_POST['passrepeat'], FILTER_SANITIZE_STRING));


  $error='';

 if(strlen($pass) <= 7)
  $error = 'Пароль должен быть минимум из 8 символов';
  else if(!preg_match("/([0-9]+)/", $pass))
     $error = 'Не хватает цифр';
     else if(!preg_match("/([a-z]+)/", $pass))
         $error = 'Не хватает маленьких букв';
   else  if(!preg_match("/([A-Z]+)/", $pass))
         $error = 'Не хватает больших букв';
   else if(strlen($passrepeat)==0)
         $error = 'Введите повтор пароля';
  else if($passrepeat != $pass)
  $error = 'Неверный повтор пароля';

if($error != ''){
echo $error;
exit();
}

$hash = "elinor";
$pass = md5($pass . $hash);

require_once '../mysql_connect.php';

$sql = 'SELECT `id_player` FROM `player` WHERE `password` = :pass AND `nick` = :nick';
$query = $pdo->prepare($sql);
$query->execute(['pass'=> $pass, 'nick' => $_COOKIE['nickname']]);
$user = $query -> fetch(PDO::FETCH_OBJ);// позволяет вытащить только одну запись из бд
if ($user == NULL )
{
  $sql = 'UPDATE `player` SET `password` = :pass
   WHERE  `nick` = :nick';
  $query3 = $pdo->prepare($sql);
  $query3->execute(['pass' => $pass , 'nick' => $_COOKIE['nickname']]);
    echo 'готово';
}
else {
 echo 'Новый пароль повторяет стары пароль';
  exit();
}

?>
