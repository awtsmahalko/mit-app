<?php
include 'vendor/phpqrcode/phpqrcode.php';
$text = $_REQUEST['text'];
QRcode::png($text);
