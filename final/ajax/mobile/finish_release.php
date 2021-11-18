<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../../core/config.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->release_id) && $data->release_id > 0){
	$release_id = $mysqli_connect->real_escape_string($data->release_id);

    $sql = $mysqli_connect->query("UPDATE `tbl_release_header` SET release_status = 'F' WHERE release_id = '$release_id'");

    if ($sql) {
        echo 1;
    }else{
        echo 0;
    }

}

?>