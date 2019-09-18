<?php
require (APPPATH.'/libraries/REST_Controller.php');

class C_adddata extends REST_Controller {

public function __construct(){
		parent::__construct();
	}




public function index_get()
{   	
// 	$this->load->model('Da_adddata', 'dd');
// 	$dd = $this->dd;
	
// 	$get = $_GET;
// 		$status_login = 0;
// 	$list_cat1 = $dd->get_all()->result();


// 	$raw_data =json_decode($get['test'],true);




// 	foreach($raw_data["list_cat"] as $ra_row){

// 		foreach($list_cat1 as $rs_row1){
// if($ra_row['ak_key'] != $rs_row1->ak_key){
// $respon = "No Key in sql";
// continue;
// }

//  if($ra_row['us_id']==""){
// 	$respon = "No us_id";
// continue;
// }

// if($ra_row['ev_id'] != $rs_row1->ev_id){
// $respon = "No ev_id in sql";
// continue;
// }
// $status_login=1;


// if($status_login){

// 		$checked = 0;
// 		$dd->ak_key = $ra_row['ak_key'];
// 		$dd->us_user = $ra_row['us_id'];
// 		$dd->ev_id = $ra_row['ev_id'];
// 		$respon = "Succeed";
// 				$dd->insert_review();
		
// 			}
// }
// }
// if($status_login){
// 	echo "Succeed";
// }
// else{
// 	echo " Error Value";
// }


}


















  
// function isJson($string) {
//  json_decode($string);
//  return (json_last_error() == JSON_ERROR_NONE);
// }

public function index_post()
{   	
	
 // echo "index_posttum";
	$this->load->model('Da_adddata', 'dd');
	$dd = $this->dd;
	$post = $_POST;
	$status_login = 0;
	$Key =$post['Key'];
	$event =$post['event'];
	$user =$post['user'];
	$dd->ak_key = $Key;
	$dd->us_user = $user;
	$dd->ev_id = $event;
	$respon =$dd->insert_review();
	echo $respon;
			


// if( $rs_row1->Status_event==0){
// 	//สถานะ
// 	continue;
// }


// // if( $rs_row1->Activity_period==1){
// // if($rs_row1->daterangepicker_start!=date("Y-m-d") &&$rs_row1->daterangepicker_end!=date("Y-m-d") ){
// // 	continue;
// // }
// // }



// if($ra_row['ak_key'] != $rs_row1->ak_key ){
//  $respon = "No Key in sql";
// continue;
// }

//  if($ra_row['us_id']==""){
// 	 $respon = "No us_id";
// continue;
// }

// if($ra_row['ev_id'] != $rs_row1->ev_id){
//  $respon = "No ev_id in sql";
// continue;
// }
// $status_login=1;


// if($status_login){

// 		$checked = 0;
// 		$dd->ak_key = $ra_row['ak_key'];
// 		$dd->us_user = $ra_row['us_id'];
// 		$dd->ev_id = $ra_row['ev_id'];
// 		$respon = "Succeed";
// 				//$dd->insert_review();
		
// 			}
// }
// }


			



}

public function index_put()
{
    echo "PUT_request";
}

public function index_patch()
{
    echo "PATCH_request";
}

public function index_delete()
{
    echo "DELETE_request";
}




}

