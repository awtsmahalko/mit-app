<?php
require_once '../core/config.php';

if(isset($_POST['item_id'])){
	$item_id = $_POST['item_id'];

	$fetch = $mysqli_connect->query("SELECT * from tbl_packaging ORDER BY packaging_name ASC") or die(mysqli_error());

	while( $row = $fetch->fetch_array() ){
		
		$fetch_count = $mysqli_connect->query("SELECT count(ip_id) from tbl_items_packaging where item_id='$item_id' and packaging_id='$row[packaging_id]' ") or die(mysqli_error());
		$count = $fetch_count->fetch_array();

		?>
		<tr>
			<th><input type='checkbox' value="<?php echo $row['packaging_id']; ?>" class='ip_id' style='position: initial; opacity:1;' <?php if($count[0] > 0){ echo 'checked'; } ?> name="packaging_id[]" ></th>
			<th><?php echo $row['packaging_name']; ?></th>
			<th><?php echo $row['actual_qty']; ?></th>
		</tr>
	<?php }

}

?>