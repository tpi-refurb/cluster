<?php
	require('../setup.php');
	$data = array();
	$error = array();
	$error['error']= false;
	$rs = $db->getResults('SELECT * FROM config');
	
	foreach($rs as $cfg){
		$name =$cfg['setting'];
		$val =$cfg['value'];
		$type =$cfg['type'];
		
		$newval ='';
		if(strpos($name,'table') !==false){
			//$error[$name]=$newval;
		}else if(strpos($name,'bcrypt') !==false){
			//$error[$name]=$newval;
		}else{
			$ui_name = 'ui_settings_'.$name;
			if(isset($_REQUEST[$ui_name])){
				$newval = htmlspecialchars($_REQUEST[$ui_name]);
				if(!empty($newval)){
					if($type==='BOOLEAN'){
						$data[$name] = ($newval==='on')?'1':'0';						
					}else{
						$data[$name] = $newval;
					}							
					$error[$name] = $newval;			
				}
			}else{
				$error[$name] ='not set';		
			}		
		}
		
		
	}
	$userid = $auth->getUserid();			
	if($error['error']===false){			
		foreach($data as $key=>$c_val){
			$query = $db->prepare("UPDATE config SET value = ? WHERE setting = ?");
			if($query->execute(array($c_val, $key))) {
				$config->{$key} = $c_val;
			}
		}
		$error['error']= false;	
		$error['message']= "Settings changed.";
	}else{
		$error['error']= true;	
		$error['message']= "Error in changing settings.";	
	}
	echo json_encode($error);
		
?>