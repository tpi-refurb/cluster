
<?php	
	require('../setup.php');
	$id = decode_url((isset($_GET['i']) && $_GET['i'] != '') ? $_GET['i'] : '');
	$table = decode_url((isset($_GET['t']) && $_GET['t'] != '') ? $_GET['t'] : '');
	$state = decode_url((isset($_GET['s']) && $_GET['s'] != '') ? $_GET['s'] : '0');
	$valid_table	=array('clus_orders','installers');
	
	$error=array();	
	$data = array();
	
	// Check table, column and state if valid
	if (!in_array($table, $valid_table) or
		(intval($state) >1)){
			$error['error'] = true;
			$error['message']='Unexpected errors occured. '.$table.' not found or there is an error of state: '.$state;
	}else{
		if(!empty($id)){
			$data = array();
			$data['active'] =$state;
			$msg = ($state==='0')? 'deleted':'activated';
			if($state==='0'){
				$data['assigned_to'] =NULL;
				$data['assigned_partner'] =NULL;
				$data['assigned_date'] =NULL;
			}
			$data['active'] =$state;
			if($db->update($table,$data,'id='.$id)){
				$error['error'] = false;
				$error['message']='Selected order#/item was successfully '.$msg;
			}else{
				$error['error'] = false;
				$error['message']='Error: Changing state of selected item/order#.';
			}
		}else{
			$error['error'] = true;
			$error['message']='Error';
		}
	}
	echo json_encode($error);

?>