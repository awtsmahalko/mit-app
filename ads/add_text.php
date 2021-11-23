<?php
include 'config.php';

$text = $mysqli_connect->real_escape_string($_POST['text']);
$id = (int) $_POST['id'];

if ($id > 0) {
    $mode = $mysqli_connect->real_escape_string($_POST['mode']);
    if ($mode == 'update') {
        $fetch_row = $mysqli_connect->query("UPDATE tbl_text SET `text` = '$text', `datetime` = NOW() WHERE text_id = '$id'") or die($mysqli_connect->error);
    }

    if ($mode == 'delete') {
        $fetch_row = $mysqli_connect->query("DELETE FROM tbl_text WHERE text_id = '$id'") or die($mysqli_connect->error);
    }
} else {
    $fetch_row = $mysqli_connect->query("INSERT INTO tbl_text(`text`, `datetime`) VALUES ('$text',NOW())") or die($mysqli_connect->error);
}
