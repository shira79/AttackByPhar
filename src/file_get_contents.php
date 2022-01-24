<?php

include('Logger.php');

$filepath = $_GET['filepath'];

//ログを書き込む
$logger = new Logger('get|' .$filepath);

echo file_get_contents($filepath);

?>

<div><li><a href="/">go back</a></li></div>
