<?php
include 'config.php';

$fetch_row = $mysqli_connect->query("SELECT * from tbl_text_triggers ORDER BY datetime DESC") or die($mysqli_connect->error);

if ($fetch_row->num_rows < 1) {
    echo "<tr><td style='padding:2px;' colspan='5'>No records found</td></tr>";
}
$count = 1;
while ($row = $fetch_row->fetch_array()) {

?>

    <tr>
        <td style="padding:2px;"><?= $count++ ?></td>
        <td style="padding:2px;"><?= $row['old_text'] ?></td>
        <td style="padding:2px;"><?= $row['text'] ?></td>
        <td style="padding:2px;"><?= $row['triggered_by'] ?></td>
        <td style="padding:2px;"><?= $row['datetime'] ?></td>
    </tr>
<?php } ?>