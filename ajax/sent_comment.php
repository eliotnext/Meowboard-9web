<?php
$comment = trim(filter_var($_POST['comment'], FILTER_SANITIZE_STRING));
$player_inf_name = $_POST['player_inf_name'];

$error='';
if(strlen($comment) <= 3)
$error = 'Введите текст коментария перед тем как отправить';

if($error != ''){
echo $error;
exit();
}

   require_once '../mysql_connect.php';

$sql='SELECT p.id_player FROM `player` p
WHERE `nick` = :nick';
$query = $pdo->prepare($sql);
$query->execute(['nick'=> $_COOKIE['nickname']]);
$rowIdTrollMe = $query -> fetch(PDO::FETCH_OBJ);


$sql='SELECT p.id_player FROM `player` p
WHERE `nick` = :nick';
$query = $pdo->prepare($sql);
$query->execute(['nick'=> $player_inf_name]);
$rowIdPlayer = $query -> fetch(PDO::FETCH_OBJ);

$sql='INSERT INTO `comment` (`text_comment`, `id_player`, `id_troll`) VALUES (?, ?, ?)';
$query = $pdo->prepare($sql);
$query->execute([$comment,$rowIdPlayer->id_player,$rowIdTrollMe->id_player]);
//$row = $query -> fetch(PDO::FETCH_OBJ);
echo 'готово';

?>
