<?php
require_once '../core/config.php';


$department = $_POST['department'];
$month      = $_POST['month'];
$year       = $_POST['year'];
$inv_date   = date("Y-m-t", strtotime("$year-$month-01"));

$fetch = $mysqli_connect->query("SELECT * from tbl_items ORDER BY item_name ASC");

$count = 1;

while ($rows = $fetch->fetch_array()) {
    $fetch_det = $mysqli_connect->query("SELECT * from tbl_items_packaging WHERE item_id = '$rows[item_id]'");
    while ($row_det = $fetch_det->fetch_array()) {

        $in = getInventoryIn($rows['item_id'], $row_det['packaging_id'], $inv_date, $department);
        $out = getInventoryOut($rows['item_id'], $row_det['packaging_id'], $inv_date, $department);;
?>
        <tr>
            <td><?php echo $count++; ?></td>
            <td><?php echo $rows['item_name']; ?></td>
            <td><?php echo getPackaging($row_det['packaging_id']); ?></td>
            <td><?php echo number_format($in, 2); ?></td>
            <td><?php echo number_format($out, 2); ?></td>
            <td><?php echo number_format($in - $out, 2); ?></td>
        </tr>
<?php }
}

?>