<?php
$host   = "localhost";
$username = "root";
$password = "";
$database = "mit_db";

$mysqli_connect = new mysqli($host, $username, $password, $database);
$mysqli_connect->query("SET SESSION sql_mode=''");
$mysqli_connect->query("SET CHARSET 'utf8'");
