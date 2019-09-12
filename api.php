<?php
header("Content-Type:application/json");
if (isset($_GET['order_id']) && $_GET['order_id']!="") {
	include('connectdb.php');
	$order_id = $_GET['order_id'];
	$result = pg_query($dbconn,"SELECT * FROM transactions WHERE order_id = $order_id");
	if(pg_num_rows($result)>0){
	$row = pg_fetch_array($result);
	response($order_id);
	}else{
		response(NULL, NULL, 200,"No Record Found");
		}
}else{
	response(NULL, NULL, 400,"Invalid Request");
	}

function response($order_id){
	$response['order_id'] = $order_id;
	//$response['amount'] = $amount;
	//$response['response_code'] = $response_code;
	//$response['response_desc'] = $response_desc;
	
	$json_response = json_encode($response);
	echo $json_response;
}
?>