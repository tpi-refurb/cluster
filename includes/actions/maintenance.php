<?php

	//header("Content-Type: text/json");
	
	require('../setup.php');
	
	$valid_table	=array('tlr_antennas', 'tlr_modems', 'tlr_remarks', 'tlr_technicians', 'tlr_telephones', 'tlr_disconnections');
	$valid_column	=array('antenna_name', 'modem_name', 'remarks_name', 'firstname', 'telephone_name', 'disconnection_name');
	$valid_state	=array('a', 'e', 'v', 'd');
	
	$table	= decode_url($_POST['t']);
	$column	= decode_url($_POST['c']);
	$id		= decode_url($_POST['i']);
	$state	= decode_url($_POST['s']);
	
	$trim_col = ucwords(str_replace('_name','',$column));
	
	$error=array();	
	$data = array();
	
	// Check table, column and state if valid
	if (!in_array($table, $valid_table) or
		!in_array($column, $valid_column) or
		!in_array($state, $valid_state)){
			$error['message']='Unexpected errors occured. '.$table.' not found.';
	}else{
		if($state==='d'){			
			if(!empty($id)){				
				$uname		= decode_url($_POST['u']); // Username
				$reason		=htmlspecialchars($_POST["ui_mainten_reason"]);
				$password	=htmlspecialchars($_POST["ui_mainten_password"]);
				if(!empty($reason)){
					$data['ui_mainten_reason'] =$reason;
				}else{
					$error["ui_mainten_reason"]='Reason is required.';
				}
				
				if(empty($password)){					
					$error["ui_mainten_password"]='Password is required.';
				}
				if(count($error) <=0){
					$error = $auth->isAuthenticatedUser($uname, $password);
					if($error['error']===false){
						if($auth->isAdmin($uname)){
							$error['username']= $uname;
							$error['password']= $password;
							$error['message']='Selected item was successfully deleted!';
						}else{
							
						}
					}else{
						$error['error']= true;
						$error['message']='Your are not authenticated user. Please provide valid password.';
					}
				}else{
					$error['error']= true;
				}
			}else{
				$error['error']= true;
				$error['message']='Unexpected errors occured, No selected item!';		
			}			
		}else{
			$active	=htmlspecialchars($_POST["active"]);
			$value	=htmlspecialchars($_POST["ui_mainten_".$column]);
			$data['active'] = $active;
			if(!empty($value)){
				$data[$column] =$value;
			}else{
				$error["ui_mainten_".$column]=$trim_col.' is required.';
			}
			
			if($table==='tlr_technicians'){
				$lastname	=htmlspecialchars($_POST["ui_mainten_lastname"]);
				$contact	=htmlspecialchars($_POST["ui_mainten_contact"]);
				$contact2	=htmlspecialchars($_POST["ui_mainten_contact2"]);
				$companyid	=htmlspecialchars($_POST["ui_mainten_tpiid"]);
				
				if(!empty($lastname)){
					$data['lastname'] =$lastname;
				}else{
					$error["ui_mainten_lastname"]='Lastname is required.';
				}
				if(!empty($contact)){
					$data['contact'] =$contact;
				}
				if(!empty($contact2)){
					$data['contact2'] =$contact2;
				}
				if(!empty($companyid)){
					$data['company_id'] =$companyid;
				}else{
					$error["ui_mainten_tpiid"]='Company ID is required.';
				}
			}else{
				if($db->exist($table,$column, "'".$value."'")){
					if($state==='a'){
						$error['error']= true;
						$error["ui_mainten_".$column] = $value. ' already exist!';
					}
				}
			}
			
			if(count($error) <=0){
				$error['error']= false;	
				if($state==='a'){
					if($db->insert($table,$data)){
						$error['error']= false;
						$error['message']='Item was succesfully added.';
					}else{
						$error['error']= true;
						$error['message']='Adding new item was not successful.';
					}
					$error['action']='Adding';
				}else if($state==='e'){
					$chk_id  = $db->getValue($table, 'id', $column."='".$value."'");
					if(empty($chk_id)){
						if($db->update($table,$data,"id= ".$id)){
							$error['error']= false;
							$error['message']='Selected item was succesfully updated.';
						}else{
							$error['error']= true;
							$error['message']='No applied changes.';
						}
					}else{
						if($chk_id!==$id){
							$error['error']= true;
							$error["message"] = $value. ' already exist!';
						}else{
							if($db->update($table,$data,"id= ".$id)){
								$error['error']= false;
								$error['message']='Selected item was succesfully updated.';
							}else{
								$error['error']= true;
								$error['message']='No applied changes.';
							}
						}
					}
					$error['action']='Editing';
				}else{
					$error['error']= true;
					$error['message']='An ALIEN action: this action was not found in developer\'s command.';		
				}				
			}else{
				$error['error']= true;
			}
		}
	}
	echo json_encode($error);
?>