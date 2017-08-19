
<?php	

	require('../setup.php');
	$error = array();
	$error['error'] = true;
	try{
		$dt = (isset($_GET['d']) && $_GET['d'] != '') ? $_GET['d'] : get_currentdate();
		if(empty($dt)){
			$dt	=isset($_POST["date_dispatch"])? $_POST["date_dispatch"]: '';
		}
		$pdt = plain_date($dt);
		$dispatch->check_dispatch($pdt);
		
		$stime	= date('Y-m-d h:i:s A');
		$etime	= date('Y-m-d').' 11:59:00 PM';
		$seconds= strtotime($etime) - strtotime($stime); //Set expired date to 12 AM of the day
		
		setcookie("dt",encode_url($dt),time()+$seconds, "/", $_SERVER["HTTP_HOST"],0);
		$error['error'] = false;
		$error['message'] ='Dispatch date changed to '.$dt;
	}catch(Exception $e){
		$error['message'] ='Error in changing date.';
	}
	echo json_encode($error);
?>