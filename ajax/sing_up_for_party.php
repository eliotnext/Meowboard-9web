<?php
session_start();
  $id_playing1 = $_POST['id_playing1'];
  $id_playing2 = $_POST['id_playing2'];
  $id_playing3 = $_POST['id_playing3'];
  $id_playing4 = $_POST['id_playing4'];
  $id_team = $_POST['id_team']; //куда записывать игрока
  $id_list_of_playing = $_POST['id_list_of_playing'];
  $id_master = $_POST['id_master'];

require_once '../mysql_connect.php';

$sql = 'SELECT pl.id_playing FROM `player` p
INNER JOIN `playing` pl ON p.id_player = pl.id_player
WHERE  `nick` = :nick';
$query = $pdo->prepare($sql);
$query->execute(['nick'=> $_COOKIE['nickname']]);
$rowIdPlaying = $query -> fetch(PDO::FETCH_OBJ);

if($id_playing1 == '') {
    $sql = 'INSERT INTO `list_of_playing`  (id_playing1) VALUES (?)';
    $query1 = $pdo->prepare($sql);
    $query1->execute([$rowIdPlaying->id_playing]);
    $id = $pdo->lastInsertId();//выполняем его и средствами PDO получаем послений вставленный ID

    $sql = 'UPDATE `team` SET `id_list_of_playing` = :id_list_of_playing
    WHERE  `id_team` = :id_team';
    $query3 = $pdo->prepare($sql);
    $query3->execute(['id_list_of_playing' => $id  ,'id_team' => $id_team]);
}
else if($id_playing2 == '') {
  $sql = 'UPDATE `list_of_playing` SET `id_playing2` = ?
  WHERE  `id_list_of_playing` = ?';
  $query1 = $pdo->prepare($sql);
  $query1->execute([ $rowIdPlaying->id_playing, $id_list_of_playing]);

}
else if($id_playing3 == ''){
  $sql = 'UPDATE `list_of_playing` SET `id_playing3` = ?
  WHERE  `id_list_of_playing` = ?';
  $query1 = $pdo->prepare($sql);
  $query1->execute([ $rowIdPlaying->id_playing, $id_list_of_playing]);

}
else if($id_playing4 == ''){
  $sql = 'UPDATE `list_of_playing` SET `id_playing4` = ?
  WHERE  `id_list_of_playing` = ?';
  $query1 = $pdo->prepare($sql);
  $query1->execute([ $rowIdPlaying->id_playing, $id_list_of_playing]);

}
else {
echo 'Сбой обработки запросов!';
}

if (strlen($id_playing1.$id_playing2.$id_playing3.$id_playing4) == 3) {
  $sql = 'DELETE FROM `data_time_place_master`
  WHERE   (`id_master` = ?  AND  `time`= ? AND `date`= ?  AND `place`= ?) ';
  $query2 = $pdo->prepare($sql);
  $query2->execute([ $id_master, $_SESSION['time'],  $_SESSION['date'],  $_SESSION['place']]);
}

echo 'reload';

 ?>
