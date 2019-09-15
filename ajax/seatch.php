<?php
session_start();
$type_game = $_POST['typeofgame'];
$universe = $_POST['universe'];
$i = 0;
$arrSess = array();

require_once '../mysql_connect.php';

$sql = 'SELECT p.nick , m.free_or_not, dtp.time, dtp.date, dtp.place FROM `player` p
INNER JOIN `master` m ON m.id_player = p.id_player
INNER JOIN `data_time_place_master` dtp ON dtp.id_master = m.id_master
WHERE m.id_ltg = :tg AND m.id_universe = :un AND  dtp.date >= :today AND  dtp.time >= :time1 ';
$query = $pdo->prepare($sql);
$query->execute(['tg'=> $type_game, 'un' => $universe, 'today'=> date("d.m.Y"), 'time1'=> date("H:i")]);

while ($row = $query -> fetch(PDO::FETCH_OBJ)) {
 $arrSess[$i] = array('Ник мастера' =>  $row->nick,
 'Взимается ли плата' => $row->free_or_not,
 'Свободное время' => $row->time,
 'Дата' => $row->date,
 'Место' => $row->place);



 $i++;
}
 $_SESSION['masterInf'] = $arrSess;

if (!empty( $_SESSION['masterInf']))
{
echo 'reload';
}
?>
