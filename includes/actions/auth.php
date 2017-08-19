<?php	
	require('../setup.php');
	$action = ((isset($_GET['a']) && $_GET['a'] != '') ? $_GET['a'] : '');
	$username=	$firstname= $lastname= $email= $password= $confirmpassword="";

	$error = array();
	if($action ==='login'){
		$username		= $_POST["ui_login_username"];
		$password		= $_POST['ui_login_password'];
		$remember		= 0;
		
		if(empty($username)){
			$error["ui_login_username"] ='Username is required';
		}
		if(empty($password)){
			$error["ui_login_password"] ='Password is required';
		}
		
		if(count($error)>0){
			$error["error"]=true;
			echo json_encode($error);
		}else{
			$error = $auth->loginUser($username,$password,$remember);		
			
			if($error["error"]==false){			
				$userid =$auth->getUID($username);
				$level =$auth->getLevel($username);
				$hashId = $auth->getSessionHash($userid);
				
				$stime = date('Y-m-d h:i:s A');
				$etime= date('Y-m-d').' 11:59:00 PM';		
				$seconds = strtotime($etime) - strtotime($stime); //Set expired date to 12 AM of the day
				
				setcookie($config->cookie_name,$hashId,time()+($seconds), "/", $_SERVER["HTTP_HOST"],0);
				setcookie("Username",encode_url($username),time()+($seconds), "/", $_SERVER["HTTP_HOST"],0);
				setcookie("UserId",encode_url($userid),time()+($seconds), "/", $_SERVER["HTTP_HOST"],0);
				
				unset($_POST);					
			}
			echo json_encode($error);
		}
		
	}else{
		
		$username		= $_POST['ui_signup_username'];	
		$email			= $_POST['ui_signup_email'];
		$firstname		= $_POST['ui_signup_firstname']; 
		$lastname		= $_POST['ui_signup_lastname'];
		$password		= $_POST['ui_signup_password'];
		$confirmpassword= $_POST['ui_signup_confirmpassword'];
		
		if(empty($username)){
			$error["ui_signup_username"] ='Username is required';
		}
		if(empty($email)){
			$error["ui_signup_email"] ='Email is required';
		}
		if(empty($firstname)){
			$error["ui_signup_firstname"] ='Firstname is required';
		}
		if(empty($lastname)){
			$error["ui_signup_lastname"] ='Lastname is required';
		}
		if(empty($password)){
			$error["ui_signup_password"] ='Password is required';
		}
		
		if(count($error)>0){
			$error["error"]=true;
			echo json_encode($error);
		}else{
			$error =$auth->registerNewUser($email, $password, $confirmpassword,$username,$firstname, $lastname);
			if($error["error"]==false){
				unset($_POST);				
			}
			echo json_encode($error);
		}
		
	}
	
?>