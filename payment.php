<?php 

$amount = $_GET['total'];

//SSl

/* PHP */
$post_data = array();
$post_data['store_id'] = "growb643c484a329cc";
$post_data['store_passwd'] = "growb643c484a329cc@ssl";
$post_data['total_amount'] = $amount;
$post_data['currency'] = "BDT";
$post_data['tran_id'] = "SSLCZ_TEST_".uniqid();
$post_data['success_url'] = "http://localhost/CSE327_eCommerce_Website/home.php";
$post_data['fail_url'] = "http://localhost/CSE327_eCommerce_Website/checkout.php";
$post_data['cancel_url'] = "http://localhost/CSE327_eCommerce_Website/checkout.php";
# $post_data['multi_card_name'] = "mastercard,visacard,amexcard";  # DISABLE TO DISPLAY ALL AVAILABLE

# EMI INFO
$post_data['emi_option'] = "1";
$post_data['emi_max_inst_option'] = "9";
$post_data['emi_selected_inst'] = "9";

# CUSTOMER INFORMATION
$post_data['cus_name'] = $_POST['name'];
$post_data['cus_email'] = $_POST['email'];
$post_data['cus_add1'] = $_POST['address'];
$post_data['cus_add2'] = "";
$post_data['cus_city'] = $_POST['city'];
$post_data['cus_state'] = "";
$post_data['cus_postcode'] = $_POST['zipcode'];
$post_data['cus_country'] = $_POST['country'];
$post_data['cus_phone'] = $_POST['phone'];
$post_data['cus_fax'] = $_POST['phone'];

# SHIPMENT INFORMATION
$post_data['ship_name'] = $_POST['name'];
$post_data['ship_add1'] = $_POST['address'];
$post_data['ship_add2'] = "";
$post_data['ship_city'] = $_POST['city'];
$post_data['ship_state'] = "";
$post_data['ship_postcode'] = $_POST['zipcode'];
$post_data['ship_country'] = $_POST['country'];

# CART PARAMETERS
$cart_items = array();
foreach ($_POST['product'] as $key => $value) {
    $cart_items[] = array("product" => $value, "amount" => $_POST['amount'][$key]);
}
$post_data['cart'] = json_encode($cart_items);

$post_data['product_amount'] = $amount;
$post_data['vat'] = "0";
$post_data['discount_amount'] = "0";
$post_data['convenience_fee'] = "0";



//send

# REQUEST SEND TO SSLCOMMERZ
$direct_api_url = "https://sandbox.sslcommerz.com/gwprocess/v3/api.php";

$handle = curl_init();
curl_setopt($handle, CURLOPT_URL, $direct_api_url );
curl_setopt($handle, CURLOPT_TIMEOUT, 30);
curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($handle, CURLOPT_POST, 1 );
curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC


$content = curl_exec($handle );

$code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

if($code == 200 && !( curl_errno($handle))) {
	curl_close( $handle);
	$sslcommerzResponse = $content;
} else {
	curl_close( $handle);
	echo "FAILED TO CONNECT WITH SSLCOMMERZ API";
	exit;
}

# PARSE THE JSON RESPONSE
$sslcz = json_decode($sslcommerzResponse, true );

if(isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL']!="" ) {
        # THERE ARE MANY WAYS TO REDIRECT - Javascript, Meta Tag or Php Header Redirect or Other
        # echo "<script>window.location.href = '". $sslcz['GatewayPageURL'] ."';</script>";
	echo "<meta http-equiv='refresh' content='0;url=".$sslcz['GatewayPageURL']."'>";
	# header("Location: ". $sslcz['GatewayPageURL']);
	exit;
} else {
	echo "JSON Data parsing error!";
}


?>
