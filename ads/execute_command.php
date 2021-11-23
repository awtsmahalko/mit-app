<?php
include 'config.php';
$command = $_POST['command'];
// SET @p0='a'; CALL `insert_text`(@p0);
$fetch_row = $mysqli_connect->query($command) or die($mysqli_connect->error);
echo $fetch_row;
