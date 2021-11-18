<?php
if ($page == 'home') {
	require view . 'homepage.php';
} else if ($page == 'users') {
	require view . 'users.php';
} else if ($page == 'items') {
	require view . 'items.php';
} else if ($page == 'packaging') {
	require view . 'packaging.php';
} else if ($page == 'suppliers') {
	require view . 'suppliers.php';
} else if ($page == 'purchase-request') {
	require view . 'purchase_request.php';
} else if ($page == 'canvass') {
	require view . 'canvass.php';
} else if ($page == 'purchase-order') {
	require view . 'purchase_order.php';
} else if ($page == 'receiving') {
	require view . 'receiving.php';
} else if ($page == 'inventory') {
	require view . 'inventory.php';
} else if ($page == 'stock-card') {
	require view . 'stock_card.php';
} else if ($page == 'release') {
	require view . 'release.php';
} else if ($page == 'print') {
	require view . 'print.php';
} else {
	if (!empty($page) or $page != $page) {
		require view . '404.php';
	} else {
		require view . 'homepage.php';
	}
}
