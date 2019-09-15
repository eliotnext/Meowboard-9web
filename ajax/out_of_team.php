<?php

  $id_game = $_POST['id_game'];

require_once '../mysql_connect.php';

$sql = 'SELECT t.id_master, t.id_list_of_playing, lop.id_playing1, lop.id_playing2, lop.id_playing3, lop.id_playing4, t.id_team
FROM `game` g
INNER JOIN `team` t ON g.id_team = t.id_team
INNER JOIN `list_of_playing` lop ON lop.id_list_of_playing = t.id_list_of_playing
 WHERE `id_game` = ?';
 $query3 = $pdo->prepare($sql);
 $query3->execute([$id_game]);
 $rowIdGame = $query3->fetch(PDO::FETCH_OBJ);

 if ($_COOKIE['position'] == 3) //значит игрок
 {

   $id_playing1 = $rowIdGame->id_playing1;
   $id_playing2 = $rowIdGame->id_playing2;
   $id_playing3 =$rowIdGame->id_playing3;
   $id_playing4 = $rowIdGame->id_playing4;


$sql = 'SELECT pl.id_playing FROM `player` p
INNER JOIN `playing` pl ON p.id_player = pl.id_player
WHERE  `nick` = :nick';
$query = $pdo->prepare($sql);
$query->execute(['nick'=> $_COOKIE['nickname']]);
$rowIdPlaying = $query -> fetch(PDO::FETCH_OBJ);

if($id_playing1 == $rowIdPlaying->id_playing) {

  $sql = 'UPDATE `list_of_playing` SET `id_playing1` = ?
  WHERE  `id_list_of_playing` = ?';
  $query1 = $pdo->prepare($sql);
  $query1->execute([ NULL , $rowIdGame->id_list_of_playing]);

}
else if($id_playing2 == $rowIdPlaying->id_playing) {

  $sql = 'UPDATE `list_of_playing` SET `id_playing2` = ?
  WHERE  `id_list_of_playing` = ?';
  $query1 = $pdo->prepare($sql);
  $query1->execute([ NULL , $rowIdGame->id_list_of_playing]);

}
else if($id_playing3 == $rowIdPlaying->id_playing){

  $sql = 'UPDATE `list_of_playing` SET `id_playing3` = ?
  WHERE  `id_list_of_playing` = ?';
  $query1 = $pdo->prepare($sql);
  $query1->execute([ NULL , $rowIdGame->id_list_of_playing]);

}
else if($id_playing4 == $rowIdPlaying->id_playing){

  $sql = 'UPDATE `list_of_playing` SET `id_playing4` = ?
  WHERE  `id_list_of_playing` = ?';
  $query1 = $pdo->prepare($sql);
  $query1->execute([ NULL , $rowIdGame->id_list_of_playing]);

}
else {
echo 'Сбой обработки запросов!';
}
//echo strlen($id_playing1.$id_playing2.$id_playing3.$id_playing4);
if (strlen($id_playing1.$id_playing2.$id_playing3.$id_playing4) == 4) {
$sql = 'SELECT g.time_game, g.data_game, g.place_game FROM `game` g
WHERE  `id_game`= ?';
   $query3 = $pdo->prepare($sql);
  $query3->execute([$id_game]);
  $rowDataTimeGame = $query3 -> fetch(PDO::FETCH_OBJ);

$sql = 'INSERT INTO `data_time_place_master`  (`time`, `date`, `place` , `id_master`) VALUES (?,?,?,?)';
$query2 = $pdo->prepare($sql);
$query2->execute([$rowDataTimeGame->time_game, $rowDataTimeGame->data_game, $rowDataTimeGame->place_game, $rowIdGame->id_master]);
}
}
else if ($_COOKIE['position'] == 5) //значит мастер
{
    $sql = 'UPDATE `team` SET `name_of_team` = ?
    WHERE  `id_team` = ?';
    $query1 = $pdo->prepare($sql);
    $query1->execute([ 'КОМАНДА РАСПУЩЕНА МАСТЕРОМ (ИГРА ОТМЕНЯЕТСЯ). В СКОРОМ ВРЕМЕНИ БУДЕТ УДАЛЕНА ИЗ СПИСКА АДМИНИСТРАТОРОМ!', $rowIdGame->id_team]);
}
else echo 'Ошибка при выходе из команды мастера или игрока!';

echo 'reload';

 ?>
