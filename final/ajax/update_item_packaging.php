<?php
require_once '../core/config.php';

$item_id = $mysqli_connect->real_escape_string($_POST['item_id']);
$date = getCurrentDate();

// delete all entries
$mysqli_connect->query("DELETE from tbl_items_packaging where item_id='$item_id' ") or die($mysqli_connect->error);

if(isset($_POST['packaging_id'])){

    foreach($_POST['packaging_id'] as $packaging_id){
        
        $fetch_count = $mysqli_connect->query("SELECT count(ip_id) from tbl_items_packaging where item_id='$item_id' and packaging_id='$packaging_id' ") or die($mysqli_connect->error);
        $count = $fetch_count->fetch_array();

        if($count[0] == 0){
            $mysqli_connect->query("INSERT INTO `tbl_items_packaging`( `item_id`, `packaging_id`, `date_modified`) VALUES ('$item_id','$packaging_id','$date')") or die($mysqli_connect->error);
        }
        
    }

    echo 1;

}else{
    echo 1;
}
