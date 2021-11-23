<?php
include 'config.php';

$fetch_row = $mysqli_connect->query("SELECT * from tbl_text ORDER BY datetime DESC") or die($mysqli_connect->error);

echo $_REQUEST['type'] == 'no-add' ? "" : "<tr><td style='padding:2px;' colspan='4'><input type='text' placeholder='Text' class='form-control' id='text-form'></td><td style='padding:2px;'><button class='btn btn-sm btn-success' onclick='addText()'>ADD DATA</button></td></tr>";

$count = 1;
while ($row = $fetch_row->fetch_array()) {

?>

    <tr>
        <td style="padding:2px;"><?= $count++ ?></td>
        <td style="padding:2px;"><?= $row['text_id'] ?></td>
        <td style="padding:2px;" id="text-<?= $row['text_id'] ?>" <?= $_REQUEST['type'] == 'no-add' ? "" : 'contenteditable="true"' ?>><?= $row['text'] ?></td>
        <td style="padding:2px;"><?= $row['datetime'] ?></td>
        <?php if ($_REQUEST['type'] != 'no-add') { ?>
            <td style="padding:2px;"><button class="btn btn-sm btn-primary" onclick="updateText(<?= $row['text_id'] ?>)">UPDATE</button><button onclick="deleteText(<?= $row['text_id'] ?>)" class="btn btn-sm btn-danger">DELETE</button></td>
        <?php } ?>
    </tr>
<?php } ?>