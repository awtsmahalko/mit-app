<?php
include 'config.php';
$command = $_POST['command'];
$response = array();
if ($command == 'insert') {

    $text =  $mysqli_connect->real_escape_string($_POST['text']);
    // SET @p0='a'; CALL `insert_text`(@p0);
    $fetch_row = $mysqli_connect->query("CALL insert_text('$text')") or die($mysqli_connect->error);
    if ($fetch_row) {
        $response['command'] =  "CALL `insert_text` ('$text')";
        $response['response'] =  "Successfuly inserted $text";
    } else {
        $response['command'] =  "Error";
        $response['response'] =  "Unable to insert $text";
    }
}
if ($command == 'update') {

    $text =  $mysqli_connect->real_escape_string($_POST['text']);
    $id =  $mysqli_connect->real_escape_string($_POST['id']);
    // SET @p0='a'; CALL `insert_text`(@p0);
    $fetch_row = $mysqli_connect->query("CALL update_text('$text',$id)") or die($mysqli_connect->error);
    if ($fetch_row) {
        $response['command'] =  "CALL `update_text` ('$text',$id)";
        $response['response'] =  "Successfuly updated $text";
    } else {
        $response['command'] =  "Error";
        $response['response'] =  "Unable to update $text";
    }
}

if ($command == 'delete') {

    $id =  $mysqli_connect->real_escape_string($_POST['id']);
    // SET @p0='a'; CALL `insert_text`(@p0);
    $fetch_row = $mysqli_connect->query("CALL delete_text($id)") or die($mysqli_connect->error);
    if ($fetch_row) {
        $response['command'] =  "CALL `delete_text` ($id)";
        $response['response'] =  "Successfuly deleted $id";
    } else {
        $response['command'] =  "Error";
        $response['response'] =  "Unable to deleted $id";
    }
}
echo json_encode($response);
