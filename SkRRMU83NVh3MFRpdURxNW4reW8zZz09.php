<?php
include('includes/setup.php');


$userid =decode_url($_COOKIE['UserId']);
$result= $auth->logout($_COOKIE[$config->cookie_name]);
$auth->setOffline($userid);

clearCookies();
removeCookies();


// Destroy the session variables
session_destroy();


//$activity->addActivity('LOGOUT','Exit application successfully',date("Y-m-d"),date("h:i:sa"),$userid);
redirect_to('index.php');

?>