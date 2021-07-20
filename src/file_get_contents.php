<?php

include('Logger.php');

$filepath = $_GET['filepath'];
echo file_get_contents($filepath);

?>

<h1>check attacking</h1>

<ul>
    <li><a href="/">go back</a></li>
</ul>
