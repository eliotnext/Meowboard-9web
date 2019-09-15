<?php
session_start();
//можно использовать для нормального мравнения времени time()
// и в бд поле date сделать int и через php записывать туда time
$error='';

$time1 =trim(filter_var( $_POST['time1'], FILTER_SANITIZE_STRING));
$date1 =trim(filter_var( $_POST['date1'], FILTER_SANITIZE_STRING));
$place1 =trim(filter_var($_POST['place1'], FILTER_SANITIZE_STRING));
$name_of_team =trim(filter_var($_POST['nameOfTeam'], FILTER_SANITIZE_STRING));


if(strlen($name_of_team) < 3)
$error = 'Введите название команды';

if(empty($place1))
$error = 'Введите место встречи';

if(strlen($date1)<10)
$error = 'Введите дату';
else if(strlen($date1)>10)
$error = 'Число введено неверно';
else if($date1{2}!="." || $date1{5}!=".")
$error = 'Пожалуйста, соблюдайте формат ввода даты "."';
else if(!is_numeric($date1{0}.$date1{1}.$date1{3}.$date1{4}.$date1{6}.$date1{7}.$date1{8}.$date1{9}))
$error = 'Пожалуйста, соблюдайте формат ввода даты (цифры)';
else if($date1{0}.$date1{1} > 31 || $date1{0}.$date1{1} <= 0 || $date1{3}.$date1{4} > 12  || $date1{3}.$date1{4} <=0)
$error = 'Всего 31 день, 12 месяцев';
else if($date1{0}.$date1{1} < date("d") && $date1{3}.$date1{4} < date("m") && $date1{6}.$date1{7}.$date1{8}.$date1{9} < date("Y")
&& $time1{0}.$time1{1} <= date("H") && $time1{3}.$time1{4} <= date("i") )
$error = 'В прошлом не стоит, Доктор Кто (сегодня '.date("d.m.Y").')' ;
else if ($date1{6}.$date1{7}.$date1{8}.$date1{9} > 2100)
$error='Предчувствуем появление высшего эльфа';

date_default_timezone_set("Europe/Moscow");

 if(strlen($time1) < 5)
 $error = 'Введите время';
 else if (strlen($time1) > 5)
 $error = 'Время введено неверно';
 else if($time1{2}!=':')
 $error = 'Пожалуйста, соблюдайте формат ввода времени (:)';
 else if(!is_numeric($time1{0}.$time1{1}.$time1{3}.$time1{4}))
 $error = 'Пожалуйста, соблюдайте формат ввода времени (цифры)';
 else if ($time1{0}.$time1{1} > 24 || $time1{3}.$time1{4} > 60)
 $error = 'Всего 24 часа и 60 минут';
 // else if($time1{0}.$time1{1} <= date("H") && $time1{3}.$time1{4} <= date("i"))
 //  $error = 'Назначать встречу в прошлом не стоит, Доктор Кто (сейчас '.date("H:i").')';


if($error != ''){
echo $error;
exit();
}

require_once '../mysql_connect.php';

//Проверка на уникальность имени команды
 $sql = 'SELECT `id_team` FROM `team` WHERE `name_of_team` = :name_of_team';
 $query = $pdo->prepare($sql);
 $query->execute(['name_of_team'=> $name_of_team]);
 $rowName_of_team = $query -> fetch(PDO::FETCH_OBJ);// позволяет вытащить только одну запись из бд

 if ($rowName_of_team == NULL)
{

$sql = 'SELECT g.time_game, g.data_game, g.place_game FROM `game` g
WHERE `time_game` = :time_game AND `data_game` = :data_game AND `place_game` = :place_game';
$query5 = $pdo->prepare($sql);
$query5->execute(['time_game'=> $time1, 'data_game'=> $date1, 'place_game'=> $place1 ]);
$rowСheck = $query5->fetch(PDO::FETCH_OBJ);

if($rowСheck == NULL)
{
$sql = 'SELECT m.id_master  FROM `player` p
INNER JOIN `master` m ON m.id_player = p.id_player
WHERE `nick` = :nick';
$query2 = $pdo->prepare($sql);
if($_COOKIE['nickname'] == '')
$query2->execute(['nick'=> $_SESSION['name_player_for_master']]);
else
$query2->execute(['nick'=>$_COOKIE['nickname']]);
$rowMasterInf = $query2 -> fetch(PDO::FETCH_OBJ);

$sql = 'INSERT INTO data_time_place_master ( `time`, `date`, `place`, `id_master`) VALUES (?, ?, ?, ?)';
$query3 = $pdo->prepare($sql);
$query3->execute([$time1, $date1, $place1, $rowMasterInf->id_master]);

$sql = 'INSERT INTO `team`  (id_master, name_of_team) VALUES (?, ?)';
$query4 = $pdo->prepare($sql);
$query4->execute([$rowMasterInf->id_master, $name_of_team]);
$id = $pdo->lastInsertId();
//достать только созданное id или заставить ввести название команды
//Чтобы сразу при вводе времени создавалась команда
//Чтобы чтобы потом было куда записываться


$sql = 'INSERT INTO `game`  (id_team, id_status_game, time_game, data_game, place_game ) VALUES (?, ?, ?, ?, ?)';
$query = $pdo->prepare($sql);
$query->execute([$id, '1', $time1, $date1, $place1]);

echo 'готово';
}

else  $error = 'Это время у вас уже занято';
}
else  $error = 'Такая party уже существует! Постарайтесь придумать что-то оригинальное';
//$array = unserialize($string);//Затем из этой строки, можно снова получить массив
// в seatch тогда придётся использовать двумерный массив
//implode('|', array(1, 2, 3)); склеить
if($error != ''){
echo $error;
exit();
}

 ?>
