<?php
require_once('../../includes/setup.php');
include (INCLUDES_PATH.DS.'global.helper.php');
$islogin =$auth->isLogin();

?>
<!DOCTYPE html>
<html lang="en" class="">
<head>
  <meta charset="utf-8" />
  <title>SCR Encoder-Access Denied</title>
  <meta name="description" content="SCR Encoder" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="stylesheet" href="../../libs/assets/animate.css/animate.css" type="text/css" />
  <link rel="stylesheet" href="../../libs/assets/font-awesome/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="../../libs/assets/simple-line-icons/css/simple-line-icons.css" type="text/css" />

  <link rel="stylesheet" href="../../libs/jquery/bootstrap/dist_3.3.6/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="../../assets/css/font.css" type="text/css" />
  <link rel="stylesheet" href="../../assets/css/app.css" type="text/css" />
  <link rel="stylesheet" href="../../assets/css/animate.css" type="text/css" />

</head>
<body>
<div class="app app-header-fixed bg-danger ">
  

<div class="container w-xxl w-auto-xs">
  <div class="text-center m-b-lg animated infinite pulse">
    <h1 class="m-n font-thin h1 text-white">Access Denied</h1>
	<div class="wrapper text-center">
		<p>Please contact administrator.</p>
    </div>
  </div>
  <div class="list-group bg-default auto m-b-sm m-b-lg">
    <a href="../../index.php" class="list-group-item">
      <i class="fa fa-chevron-right text-muted"></i>
      <i class="fa fa-fw fa-mail-forward m-r-xs"></i> Goto Home
    </a>
	<?php
	if(!$islogin){ ?>
    <a href="../../index.php" class="list-group-item">
      <i class="fa fa-chevron-right text-muted"></i>
      <i class="fa fa-fw fa-sign-in m-r-xs"></i> Sign in
    </a>
    <a href="<?php echo '../../index.php?page='.encode_url('15');?>" class="list-group-item">
      <i class="fa fa-chevron-right text-muted"></i>
      <i class="fa fa-fw fa-unlock-alt m-r-xs"></i> Sign up
    </a>
	<?php
	}
	?>
  </div>
  <div class="text-center">
    <p>
		<small class="text-muted">SCR Encoder<br>&copy; Copyright 2015</small>
	</p>
  </div>
</div>


</div>
</body>
</html>
