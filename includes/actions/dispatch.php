<?php

	//header("Content-Type: text/json");
	
	require('../setup.php');
	
	$valid_state	=array('a', 'e', 'v', 'd');
	
	$date	= decode_url($_POST['d']);
	$id		= decode_url($_POST['i']);
	$state	= decode_url($_POST['s']);
	
	$table	= "clus_".$date;
	
	$error	=array();	
	$data	= array();
	$histor	= array();
	
	// Check table, column and state if valid
	if (!in_array($state, $valid_state)){
			$error['message']='Unexpected errors occured. '.$state.' not found.';
	}else{
		if($state==='d'){
			$error['error']= true;
			if(!empty($id)){
				$dt	=force_date($date);
				$at	=decode_url($_POST["at"]);
				$ap	=decode_url($_POST["ap"]);
				
				if(empty($at) or empty($ap)){
					$error['message']='1---Error occured while deleting. Please try again.';
				}else{
					$data['assigned_to'] =null;
					$data['assigned_partner'] =null;
					$data['assigned_date'] =null;
					
					if($db->delete($table,"id=".$id)){
						$where ="assigned_to=".$at." AND assigned_partner =".$ap." AND assigned_date ='".$dt."'";
						$sql ="UPDATE clus_orders SET assigned_to = NULL , assigned_partner = NULL, assigned_date = NULL WHERE ".$where;
						$db->run($sql);
						$error['error']= false;
						$error['message']='Selected pair of technician was succesfully deleted.';
					}else{
						$error['message']='2--Error occured while deleting. Please try again.';
					}
				}
			}else{
				$error['message']='3--Error occured while deleting. Please try again.';
			}
			
		}else{
			$installer_1	=decode_url(isset($_POST["ui_tech_installer1"])? $_POST["ui_tech_installer1"]: '') ;
			$installer_2	=decode_url(isset($_POST["ui_tech_installer2"])? $_POST["ui_tech_installer2"]: '');
			
			if(!empty($installer_1)){
				$data['installer_1'] =$installer_1;
			}else{
				$error["ui_tech_installer1"]='Installer 1 is required.';
			}			
			
			if(!empty($installer_2)){
				$data['installer_2'] =$installer_2;
			}else{
				$error["ui_tech_installer2"]='Installer 2 is required.';
			}
			
			
			if($db->exist($table,'installer_1',$installer_1) || $db->exist($table,'installer_2',$installer_1)){
				$error["ui_tech_installer1"]='Installer 1 was already exist.';
			}
			
			if($db->exist($table,'installer_1',$installer_2) || $db->exist($table,'installer_2',$installer_2)){
				$error["ui_tech_installer2"]='Installer 2 was already exist.';
			}
			
			if(count($error) <=0){
				$error['error']= false;	
				
				#re-check if order no is exist
				
				if($db->insert($table,$data)){
					$error['message']='Selected item was succesfully added.';
				}else{
					$error['error']= true;
					$error['message']='Error in adding technician.';
				}
				
					
			}else{
				$error['error']= true;
			}
		}
	}
	echo json_encode($error);
?>