<?php
require_once '../mysql_connect.php';

$name_of_team = trim(filter_var($_POST['name_of_team'], FILTER_SANITIZE_STRING));
$id_team = $_POST['id_team'];

$error='';
if(strlen($name_of_team) <= 3)
$error = 'Введите название команды и снова нажмите *Восстановить команду';

if($error != ''){
echo $error;
exit();
}

$sql = 'UPDATE `team` SET `name_of_team` = ?
WHERE  `id_team` = ?';
$query1 = $pdo->prepare($sql);
$query1->execute([ $name_of_team, $id_team]);

echo 'reload';
 ?>
