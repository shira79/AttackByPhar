<?php

include('Logger.php');

$fileName = $_FILES['imageUploader']['name'];
$fileTmp  = $_FILES['imageUploader']['tmp_name'];

$uploadPath = 'uploads/' . basename($fileName);

//ログを書き込む
$logger = new Logger('upload|' .$uploadPath);

//ファイルを移動
move_uploaded_file($fileTmp, $uploadPath);

?>

<h1>uploaded!!!</h1>
<div><li><a href="/">go back</a></li></div>
