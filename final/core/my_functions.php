<?php

function getCurrentDate()
{
	ini_set('date.timezone', 'UTC');
	//error_reporting(E_ALL);
	date_default_timezone_set('UTC');
	$today = date('H:i:s');
	$system_date = date('Y-m-d H:i:s', strtotime($today) + 28800);
	return $system_date;
}

function getUser($id)
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT * from tbl_users where user_id='$id' ");
	$row = $fetch->fetch_array();
	$user_name = $row['user_fname'] . ' ' . $row['user_mname'] . ' ' . $row['user_lname'];

	return $user_name;
}

function getUserEmail($id)
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT user_email from tbl_users where user_id='$id' ");
	$row = $fetch->fetch_array();
	$user_email = $row['user_email'];

	return $user_email;
}

function getUserContactNo($id)
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT user_contact_no from tbl_users where user_id='$id' ");
	$row = $fetch->fetch_array();
	$user_contact_no = $row['user_contact_no'];

	return $user_contact_no;
}

function getItem($id)
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT item_name from tbl_items where item_id='$id' ");
	$row = $fetch->fetch_array();
	$item_name = $row['item_name'];

	return $item_name;
}

function getPackaging($id)
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT packaging_name from tbl_packaging where packaging_id='$id' ");
	$row = $fetch->fetch_array();
	$packaging_name = $row['packaging_name'];

	return $packaging_name;
}

function getSupplier($id)
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT supplier_name from tbl_suppliers where supplier_id='$id' ");
	$row = $fetch->fetch_array();
	$res = $row['supplier_name'];

	return $res;
}

function getSupplierEmail($id)
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT supplier_email from tbl_suppliers where supplier_id='$id' ");
	$row = $fetch->fetch_array();
	$res = $row['supplier_email'];

	return $res;
}

function getSupplierContactNo($id)
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT supplier_contact_no from tbl_suppliers where supplier_id='$id' ");
	$row = $fetch->fetch_array();
	$res = $row['supplier_contact_no'];

	return $res;
}

function getPRNum($id)
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT pr_no from tbl_purchase_request_header where pr_id='$id' ");
	$row = $fetch->fetch_array();
	$res = $row['pr_no'];

	return $res;
}

function getPRDepartment($id)
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT pr_department from tbl_purchase_request_header where pr_id='$id' ");
	$row = $fetch->fetch_array();
	$res = $row['pr_department'];

	return $res;
}

function getIarInvoices($po_id)
{
	global $mysqli_connect;

	$res = array();
	$fetch = $mysqli_connect->query("SELECT rr_invoice from tbl_receiving_header where po_id='$po_id' ");
	while ($row = $fetch->fetch_array()) {
		$res[] = $row['rr_invoice'];
	}

	return implode(",", $res);
}

function getIarInvoicesDate($po_id)
{
	global $mysqli_connect;

	$res = array();
	$fetch = $mysqli_connect->query("SELECT rr_invoice_date from tbl_receiving_header where po_id='$po_id' ");
	while ($row = $fetch->fetch_array()) {
		$res[] = date("F d, Y", strtotime($row['rr_invoice_date']));
	}

	return implode(",", $res);
}

function getData($select, $table, $column, $id)
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT $select from $table where $column='$id' ");
	$row = $fetch->fetch_array();

	return $row[0];
}

function getInventory($item_id, $packaging_id, $inventory_date, $department = 'ELEM')
{
	return getInventoryIn($item_id, $packaging_id, $inventory_date, $department) - getInventoryOut($item_id, $packaging_id, $inventory_date, $department);
}
function getInventoryIn($item_id, $packaging_id, $inventory_date, $department)
{
	global $mysqli_connect;
	$inject = $department == "" ? "" : "AND p.pr_department = '$department'";
	$fetch_in = $mysqli_connect->query("SELECT SUM(qty) from tbl_receiving_details AS d,tbl_receiving_header AS h,tbl_purchase_request_header AS p where d.rr_id = h.rr_id AND h.pr_id = p.pr_id $inject AND h.rr_date <= '$inventory_date' AND d.item_id = '$item_id' AND d.packaging_id = '$packaging_id'");
	$row_in = $fetch_in->fetch_array();

	return $row_in[0] * 1;
}

function getInventoryOut($item_id, $packaging_id, $inventory_date, $department)
{
	global $mysqli_connect;
	$inject = $department == "" ? "" : "AND department = '$department'";
	$fetch_out = $mysqli_connect->query("SELECT SUM(qty) from tbl_release_details AS d,tbl_release_header AS h where h.release_id = d.release_id AND item_id = '$item_id' AND packaging_id = '$packaging_id' AND release_status = 'F' AND release_date <= '$inventory_date' $inject");
	$row_out = $fetch_out->fetch_array();

	return $row_out[0] * 1;
}
function getNotif()
{
	global $mysqli_connect;
	$result = '';
	$fetch = $mysqli_connect->query("SELECT * from tbl_purchase_request_header where pr_status='P'");
	while ($row = $fetch->fetch_array()) {
		$result .= '<a class="dropdown-item d-flex align-items-center" href="index.php?page=purchase-request">
			<div class="mr-3">
				<div class="icon-circle bg-primary">
					<i class="fas fa-file-alt text-white"></i>
				</div>
			</div>
			<div>
				<div class="small text-gray-500">' . date("F d, Y", strtotime($row['pr_date'])) . '</div>
				<span class="font-weight-bold">New purchase request</span>
			</div>
		</a>';
	}
	return $result;
}

function sendSms($number, $message)
{
	$message = strlen($message) > 100 ? substr($message, 0, 100) : $message;
	if (is_dev == 'N') {
		$ch = curl_init();
		$itexmo = array('1' => $number, '2' => $message, '3' => sms_api_code, 'passwd' => sms_api_pass);
		curl_setopt($ch, CURLOPT_URL, "https://www.itexmo.com/php_api/api.php");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt(
			$ch,
			CURLOPT_POSTFIELDS,
			http_build_query($itexmo)
		);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		return curl_exec($ch);
		curl_close($ch);
	}
}
function sendEmail($message, $subject, $email)
{
	require_once 'PHPMailer-master/PHPMailerAutoload.php';

	$mail = new PHPMailer;

	$mail->isSMTP();                            // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                     // Enable SMTP authentication
	$mail->Username = email;          // SMTP username
	$mail->Password = email_pass; // SMTP password
	$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                          // TCP port to connect to

	$mail->setFrom(email, 'PIMS');
	$mail->addReplyTo(email, 'PIMS');

	$mail->addAddress($email);   // Add a recipient
	$mail->isHTML(true);  // Set email format to HTML

	$bodyContent = $message;

	$mail->Subject = $subject;
	$mail->Body    = $bodyContent;

	if (!$mail->send()) {
		//return 'Message could not be sent.';
		return 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		return "send";
	}
}
function countItems()
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT COUNT(*) FROM tbl_items");
	$row = $fetch->fetch_array();
	return $row[0] * 1;
}

function countApprovePr()
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT COUNT(*) FROM tbl_purchase_request_header WHERE pr_status = 'A'");
	$row = $fetch->fetch_array();
	return $row[0] * 1;
}

function countPendingPr()
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT pr_status, 100. * count(*) / sum(count(*)) over () AS percent FROM tbl_purchase_request_header GROUP BY pr_status");
	$per['P'] = 0;
	while ($row = $fetch->fetch_array()) {
		$per[$row['pr_status']] = $row['percent'];
	}
	return number_format($per['P'], 2);
}
function countUsers()
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT COUNT(*) FROM tbl_users");
	$row = $fetch->fetch_array();
	return $row[0] * 1;
}

function getAverageCost($item_id, $packaging_id)
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT SUM(qty*cost) / SUM(qty) FROM tbl_purchase_order_details WHERE item_id = '$item_id' AND packaging_id = '$packaging_id'");
	$row = $fetch->fetch_array();
	return $row[0] * 1;
}
