<?php

	//header("Content-Type: text/json");
	
	require('../setup.php');
	
	$valid_state	=array('a', 'e', 'v', 'd','n','u');
	
	$date	= isset($_GET['d'])? $_GET['d']:'' ;
	$state	= isset($_GET['s'])? $_GET['s']:'' ;
	
	$pdt = plain_date($date);
	$sdt = slashed_date($date);
	$main_table	= "clus_orders";
	$table		= "clus_".$pdt;
	
	$error	=array();	
	$data	= array();
	
	// Check table, column and state if valid
	if (!in_array($state, $valid_state)){
			$error['message']='Unexpected errors occured. '.$table.' not found.';
	}else{
		if($state==='d'){
			
		}elseif($state==='u'){
			$id				=decode_url(htmlspecialchars($_POST["i"]));
			$unique_ord_no	=decode_url(htmlspecialchars($_POST["o"]));
			$ok_no			=(htmlspecialchars($_POST["ui_dispatch_okno"]));
			$status			=(htmlspecialchars($_POST["ui_status"]));
			$cbk			= isset($_POST["ui_cbk"])? $_POST['ui_cbk']:'';
			$uy				= isset($_POST["ui_uy"])? $_POST['ui_uy']:'';
			$sp				= isset($_POST["ui_sp"])? $_POST['ui_sp']:'';
			$splitter		= isset($_POST["ui_spl"])? $_POST['ui_spl']:'';
			$jump_wire		=(htmlspecialchars($_POST["ui_jump_wire"]));
			if(!empty($ok_no)){
				$data['OKNo'] =$ok_no;
			}else{
				$error["ui_dispatch_okno"]='OK # is required.';
			}
			if(!empty($status)){
				$data['status'] =$status;
			}else{
				$error["ui_status"]='Status is required.';
			}
			if(empty($jump_wire)){
				$data['jump_wire'] = NULL;
			}else{
				$data['jump_wire'] = $jump_wire;
			}
			
			$cbk = ($cbk==='true')?'1':NULL;			
			$sp = ($sp==='true')?'1':NULL;
			$splitter = ($splitter==='true')?'1':NULL;
			$data['cbk'] =$cbk;		
			$data['sp'] =$sp;
			$data['splitter'] =$splitter;
			if(!empty($uy)){
				$data['uy'] =$uy;
			}else{
				$data['uy'] =NULL;
			}
			if(count($error) <=0){
				$db->update($main_table,$data,"id =".$id);
				$error['error']= false;	
				$error['message']='Selected Order # was successfully updated.';	
			}else{
				$error['error']= true;	
			}
			
		}else{
			$id		=htmlspecialchars($_POST["i"]);
			$unique_ord_no	=htmlspecialchars($_POST["o"]);
			$ord_no = explode('/',$unique_ord_no);
			$ord_no = $ord_no[0];
			
			
			
			
			$ins1	=decode_url(htmlspecialchars($_POST["ins1"]));
			$ins2	=decode_url(htmlspecialchars($_POST["ins2"]));
			
			if($state==='n'){
				$ord_no		=(htmlspecialchars($_POST["ui_dispatch_ordno"]));
				$subsname	=(htmlspecialchars($_POST["ui_dispatch_subsname"]));
				$contactno	=(htmlspecialchars($_POST["ui_dispatch_contactno"]));
				$jobtype	=(htmlspecialchars($_POST["ui_dispatch_jobtype"]));
				$serviceno	=(htmlspecialchars($_POST["ui_dispatch_serviceno"]));
				$cabinetno	=(htmlspecialchars($_POST["ui_dispatch_cabinetno"]));
				
				$address	=(htmlspecialchars($_POST["ui_dispatch_address"]));
				$apptdate	=(htmlspecialchars($_POST["ui_dispatch_apptdate"]));
				$apptslot	=(htmlspecialchars($_POST["ui_dispatch_apptslot"]));
				$hist_status=(htmlspecialchars($_POST["ui_dispatch_status"]));
				
				$ins1	=decode_url(htmlspecialchars($_POST["ins1"]));
				$ins2	=decode_url(htmlspecialchars($_POST["ins2"]));
			
				if(!empty($ord_no)){
					$data['ord_no'] =$ord_no;
					$data['unique_ord_no'] =$ord_no.'/1_'.$sdt;
				}else{
					$error["ui_dispatch_ordno"]='Order # is required.';
				}
				
				/* Lets check if entered order no is exist, then ignore data initialization */
				if(!$db->exist($main_table,'ord_no',"'".$ord_no."'")){
					if(!empty($subsname)){
						$data['SubsName'] = strtoupper($subsname);
						$data['FullName'] = strtoupper($subsname);
					}else{
						$error["ui_dispatch_subsname"]='Subscriber name is required.';
					}
					if(!empty($contactno)){
						$data['ContactNo'] =$contactno;
					}
					if(!empty($jobtype)){
						$data['JobType'] =$jobtype;
					}
					if(!empty($serviceno)){
						$data['ServiceNo'] =$serviceno;
					}
					if(!empty($cabinetno)){
						$data['CabinetNo'] = strtoupper( $cabinetno);
					}
					if(!empty($address)){
						$data['InstAddress'] =$address;
					}
					if(!empty($apptdate)){
						$data['ApptDate'] = force_date($apptdate);
					}
					if(!empty($apptslot)){
						$data['ApptSlot'] =$apptslot;
						$slots = explode('-',$apptslot);
						$data['ApptSlotFrom'] =$slots[0];
						$data['ApptSlotTo'] =$slots[1];
					}
					if(!empty($hist_status)){
						$data['HistoryStatus'] =$hist_status;
					}else{
						$data['HistoryStatus'] ='NEW';
					}
				}else{
					if(!empty($subsname)){
						$data['SubsName'] = strtoupper($subsname);
						$data['FullName'] = strtoupper($subsname);
					}else{
						$error["ui_dispatch_subsname"]='Subscriber name is required.';
					}
				}
			}else{
				// Remove redundancy in error message
				if(empty($unique_ord_no)){
					$error["o"]='Order # is required.';
				}
			}
			
			if(!empty($ins1)){
				$data['assigned_to'] =$ins1;
			}else{
				$error["assigned_to"]='Installer 1 is required.';
			}
			if(!empty($ins2)){
				$data['assigned_partner'] =$ins2;
			}else{
				$error["assigned_partner"]='Installer 2 is required.';
			}
			
			if(!empty($date)){
				$data['assigned_date'] =$date;
			}else{
				$error["d"]='Assign Date is required.';
			}
			
			$data['active'] = '1'; // Make sure that order no must activate, for deleted data purpose
			
			if(count($error) <=0){
				$error['state']= $state;
				$error['error']= false;					
				#re-check if order no is exist
				if($db->exist($main_table,'unique_ord_no',"'".$unique_ord_no."'")){					
					$db->update($main_table,$data,"id =".$id);
					$error['message']='Order # : '.$ord_no.' was successfully assigned.';					
				}else{
					if($db->insert($main_table,$data)){
						$error['message']='Selected item was succesfully added.';
					}else{
						$error['error']= true;
						$error['message']='Error in adding technician.';
						$error = array_merge($error, $data);
					}
				}
					
			}else{
				$error['error']= true;
			}
		}
	}
	echo json_encode($error);
?>