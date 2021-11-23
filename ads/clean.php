<?php
include 'config.php';

$text = $mysqli_connect->real_escape_string($_POST['text']);

echo $text;
