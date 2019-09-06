<?php
// แก้ไขฟิวล์แล้ว
include_once("PT_model.php");

class Da_adddata extends PT_model {

		// PK is ps_id
	public $act_id;
	public $ak_name;
	public $ak_key;
	public $us_user;
	public $us_pass;
	public $ev_id;




	function __construct() {
		parent::__construct();
	}

	// function insert_review(){

	// 	if($this->us_user==NULL ||$this->us_pass==NULL ||$this->ak_key==NULL ||$this->ev_id==NULL){
	// 		return 0 ;
	// 	}
	// 	$sql = 'SELECT ev_id FROM `pm_app_key` 
	// 		INNER JOIN pm_event on ak_id =  ev_ak_id
	// 		WHERE ak_key = ? AND ev_id = ?
	// 		LIMIT 1';
	//  	$result_2 = $this->db_ums->query($sql, array($this->ak_key,$this->ev_id))->result();
	//  	if($result_2 == NULL){
	//  		return 0;
	//  	}

	// 	$sql = 'SELECT us_id FROM `pm_user`
	// 		WHERE us_user = ? AND us_pass = ?
	// 		LIMIT 1';
	//  	$result_1 = $this->db_ums->query($sql, array($this->us_user,$this->us_pass))->result();
	// 	if($result_2 == NULL){
	// 	 	$sql = "INSERT INTO ".$this->db.".pm_user (us_id,us_user,us_pass,us_Account_name)
	//   	 			VALUES(NULL, ?, ?,NULL)";
	//   	 	if($this->us_user == NULL || $this->us_pass == NULL ){
	//   	 		return 0 ;
	//   	 	}
	// 	 	$this->db_ums->query($sql, array($this->us_user, $this->us_pass));
	//  	}

	//  	$sql = '
	// 		INSERT INTO `pm_log_event` (`le_id`, `le_us_id`, `le_ev_id`, `le_date`) VALUES (NULL
	// 		, (SELECT us_id FROM `pm_user`
	// 		WHERE us_user = ? AND us_pass = ?
	// 		LIMIT 1) 
	// 		, (SELECT ev_id FROM `pm_app_key` 
	// 		INNER JOIN pm_event on ak_id =  ev_ak_id
	// 		WHERE ak_key = ? AND ev_id = ?
	// 		LIMIT 1)
	// 		, current_timestamp()) 
	// 		';
	//  	$this->db_ums->query($sql, array($this->us_user,$this->us_pass,$this->ak_key,$this->ev_id));
	



 //  	 	$this->last_insert_id = $this->db_ums->insert_id();
	// }


	 function insert_review(){
		// if($this->us_user==NULL ||$this->ak_key==NULL ||$this->ev_id==NULL ){
	 	if($this->us_user==NULL){
	 			return "User is Null" ;
	 	}
	 	if($this->ak_key==NULL ||$this->ev_id==NULL ){
			return "key OR Activity_code is Wrong";
		}
		$sql = 'SELECT * FROM `pm_app_key` 
			INNER JOIN pm_event on ak_id =  ev_ak_id
			WHERE ak_key = ? AND Activity_code = ?
			LIMIT 1';
	 	$result_2 = $this->db_ums->query($sql, array($this->ak_key,$this->ev_id))->result();
	 	if($result_2 == NULL){
	 		return "key OR Activity_code is Wrong";
	 	}
	 	if($result_2[0]->Status_event == "0"){
	 		return "Event is Closed";
	 	}
	 	if($result_2[0]->Activity_period !== "0"){
	 		$paymentDate = date('Y-m-d');
			$paymentDate=date('Y-m-d', strtotime($paymentDate));
			//echo $paymentDate; // echos today! 
			$contractDateBegin = date('Y-m-d', strtotime($result_2[0]->daterangepicker_start));
			$contractDateEnd = date('Y-m-d', strtotime($result_2[0]->daterangepicker_end));

			if (!(($paymentDate >= $contractDateBegin) && ($paymentDate <= $contractDateEnd))){
				return "Event Not in time ";
			}
	 	}







		$sql = 'SELECT * FROM `pm_user_v1`
				LEFT JOIN pm_log_event ON pm_user_v1.us_id = pm_log_event.le_us_id
				LEFT JOIN pm_event ON pm_log_event.le_ev_id = pm_event.ev_id
				LEFT JOIN pm_app_key ON pm_event.ev_ak_id = pm_app_key.ak_id
				WHERE user_id = ? AND ak_key = ?
				LIMIT 1';
	 	$result_1 = $this->db_ums->query($sql, array($this->us_user,$this->ak_key))->result();
		if($result_1 == NULL){

		 	$sql = "INSERT INTO ".$this->db.".pm_user_v1 (us_id,user_id)
	  	 			VALUES(NULL,?)";
	  	 	if($this->us_user == NULL ){
	  	 		return "User is Null" ;
	  	 	}
		 	$this->db_ums->query($sql, array($this->us_user));
		 	$this->last_insert_id = $this->db_ums->insert_id();
		 	$sql = '
				INSERT INTO `pm_log_event` (`le_id`, `le_us_id`, `le_ev_id`, `le_date`) VALUES (NULL
				, ? 
				, (SELECT ev_id FROM `pm_app_key` 
				INNER JOIN pm_event on ak_id =  ev_ak_id
				WHERE ak_key = ? AND Activity_code = ?
				LIMIT 1)
				, current_timestamp()) 
				';



		 	$this->db_ums->query($sql, array($this->last_insert_id,$this->ak_key,$this->ev_id));
	 	}


	 	else{
	 		$sql = '
				INSERT INTO `pm_log_event` (`le_id`, `le_us_id`, `le_ev_id`, `le_date`) VALUES (NULL
				, (SELECT us_id FROM `pm_user_v1`
				LEFT JOIN pm_log_event  as main ON pm_user_v1.us_id = main.le_us_id
				LEFT JOIN pm_event  ON main.le_ev_id = pm_event.ev_id
				LEFT JOIN pm_app_key ON pm_event.ev_ak_id = pm_app_key.ak_id
				WHERE user_id = ? AND ak_key = ?
				LIMIT 1) 
				, (SELECT ev_id FROM `pm_app_key` 
				INNER JOIN pm_event on ak_id =  ev_ak_id
				WHERE ak_key = ? AND Activity_code = ?
				LIMIT 1)
				, current_timestamp()) 
				';



		 	$this->db_ums->query($sql, array($this->us_user,$this->ak_key,$this->ak_key,$this->ev_id));
		
	 	}




	 	



  	 	$this->last_insert_id = $this->db_ums->insert_id();

  	 	return "Comple Query";


//////////////////////////////////////////////////////////////////////////
  // 	 		if($this->us_user==NULL ||$this->ak_key==NULL ||$this->ev_id==NULL ){
		// 	return "key OR Activity_code is Wrong";
		// }
		// $sql = 'SELECT * FROM `pm_app_key` 
		// 	INNER JOIN pm_event on ak_id =  ev_ak_id
		// 	WHERE ak_key = ? AND Activity_code = ?
		// 	LIMIT 1';
	 // 	$result_2 = $this->db_ums->query($sql, array($this->ak_key,$this->ev_id))->result();
	 // 	if($result_2 == NULL){
	 // 		return "key OR Activity_code is Wrong";
	 // 	}
	 // 	if($result_2[0]->Status_event == "0"){
	 // 		return "Event is Closed";
	 // 	}
	 // 	if($result_2[0]->Activity_period !== "0"){
	 // 		$paymentDate = date('Y-m-d');
		// 	$paymentDate=date('Y-m-d', strtotime($paymentDate));
		// 	//echo $paymentDate; // echos today! 
		// 	$contractDateBegin = date('Y-m-d', strtotime($result_2[0]->daterangepicker_start));
		// 	$contractDateEnd = date('Y-m-d', strtotime($result_2[0]->daterangepicker_end));

		// 	if (!(($paymentDate >= $contractDateBegin) && ($paymentDate <= $contractDateEnd))){
		// 		return "Event Not in time ";
		// 	}
	 // 	}







		// $sql = 'SELECT us_id FROM `pm_user_v1`
		// 	WHERE user_id = ? 
		// 	LIMIT 1';
	 // 	$result_1 = $this->db_ums->query($sql, array($this->us_user))->result();
		// if($result_1 == NULL){

		//  	$sql = "INSERT INTO ".$this->db.".pm_user_v1 (us_id,user_id)
	 //  	 			VALUES(NULL,?)";
	 //  	 	if($this->us_user == NULL ){
	 //  	 		return "User is Null" ;
	 //  	 	}
		//  	$this->db_ums->query($sql, array($this->us_user));
	 // 	}






	 // 	$sql = '
		// 	INSERT INTO `pm_log_event` (`le_id`, `le_us_id`, `le_ev_id`, `le_date`) VALUES (NULL
		// 	, (SELECT us_id FROM `pm_user_v1`
		// 	WHERE user_id = ? 
		// 	LIMIT 1) 
		// 	, (SELECT ev_id FROM `pm_app_key` 
		// 	INNER JOIN pm_event on ak_id =  ev_ak_id
		// 	WHERE ak_key = ? AND Activity_code = ?
		// 	LIMIT 1)
		// 	, current_timestamp()) 
		// 	';



	 // 	$this->db_ums->query($sql, array($this->us_user,$this->ak_key,$this->ev_id));
	



  // 	 	$this->last_insert_id = $this->db_ums->insert_id();

  // 	 	return "Comple Query";































	 }












function get_all(){
	
  	    $sql =  "SELECT pm_app_key.ak_key,pm_event.ev_id,pm_event.Activity_code,pm_event.Status_event,pm_event.Main_activity,pm_event.Activity_period,pm_event.daterangepicker_start,pm_event.daterangepicker_end  FROM `pm_app_key` 
LEFT JOIN pm_event ON pm_app_key.ak_id = pm_event.ev_ak_id
LEFT JOIN pm_log_event ON pm_event.ev_id = pm_log_event.le_ev_id
LEFT JOIN pm_user_v1 ON pm_log_event.le_us_id = pm_user_v1.us_id
WHERE ak_key = ? AND Activity_code =?
GROUP BY pm_event.ev_id";
          	return $this->db_ums->query($sql ,array($this->ak_key,$this->ev_id));
}







	function update() {

	}

	function delete() {

	}



}
/* End of file da_docdcp_seqropose.php */
/* Location: ./application/models/da_docdcp_seqropose.php */
