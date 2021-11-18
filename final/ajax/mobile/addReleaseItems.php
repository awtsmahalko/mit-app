<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../../core/config.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->ip_id) && !empty($data->ip_id) ){
	$release_id = $mysqli_connect->real_escape_string($data->release_id);
    $ip_id = $mysqli_connect->real_escape_string($data->ip_id);
    $qty = $mysqli_connect->real_escape_string($data->qty);

    $fetch_item_packaging = $mysqli_connect->query("SELECT item_id, packaging_id from tbl_items_packaging where ip_id='$ip_id' ") or die($mysqli_connect->error);
    $item_packaging = $fetch_item_packaging->fetch_array();
    $item_id = $item_packaging['item_id'];
    $packaging_id = $item_packaging['packaging_id'];

    if($ip_id > 0 AND $item_id > 0 AND $packaging_id > 0){

        $fetch_rows = $mysqli_connect->query("SELECT count(release_id), release_detail_id from tbl_release_details where release_id='$release_id' AND item_id = '$item_id' AND packaging_id = '$packaging_id'") or die($mysqli_connect->error);
        $count_rows = $fetch_rows->fetch_array();
        if ($count_rows[0] > 0) {
            $sql = $mysqli_connect->query("UPDATE `tbl_release_details` set qty=qty+'$qty' where release_detail_id='$count_rows[1]' ");

            if ($sql) {
                echo 1;
            }else{
                echo 0;
            }
        } else {
            $sql = $mysqli_connect->query("INSERT INTO `tbl_release_details`(`release_id`, `item_id`, `packaging_id`, `qty`) VALUES ('$release_id', '$item_id', '$packaging_id', '$qty')");

            if ($sql) {
                echo 1;
            }else{
                echo 0;
            }
        }
    }else{
        echo -1;
    }
	
}
