<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lets - Enhanced your activities</title>

    <!-- Bootstrap -->
	<link rel="stylesheet/less" type="text/css" href="<?php echo base_url('/assets/less/style.less'); ?>" />
	<script src="<?php echo base_url('/assets/js/less.js'); ?>" type="text/javascript"></script>
	
    <script src="<?php echo base_url('/assets/js/jquery.min.js'); ?>"></script>	

    <link href="<?php echo base_url('/assets/css/bootstrap-theme.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('/assets/js/select2/select2.css'); ?>" rel="stylesheet"/>
	<link href="<?php echo base_url('/assets/js/select2/select2-bootstrap.css'); ?>" rel="stylesheet"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/" id="logo"><img src="/assets/img/lets-do-it.png" /></a>
        </div>
        <div>
        	<a href="#new" data-toggle="modal" data-target="#<?php echo (isset($current_user)?'newActivity':'login');?>Modal" 
        		class="new-activity-btn" title="<?php echo lang('app_new_activity_title'); ?>">
        		<i class="fa fa-plus"></i>
        	</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav pull-right">
          	<?php if (isset($current_user)) : ?>
	          	<li class="dropdown hidden-xs">
	              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $current_user->get_name(); ?><span class="caret"></span></a>
	              <ul class="dropdown-menu dropdown-menu-right" role="menu">
	                <li><a href="<?php echo site_url('user'); ?>"><?php echo lang('app_my_account'); ?></a></li>
	                <li><a href="<?php echo site_url('user/settings'); ?>"><?php echo lang('app_parameters'); ?></a></li>
	                <li><a href="<?php echo site_url('welcome/out'); ?>"><?php echo lang('app_disconnect'); ?></a></li>
	              </ul>
	          	</li>
                <li class="visible-xs"><a href="<?php echo site_url('user'); ?>"><?php echo lang('app_my_account'); ?></a></li>
                <li class="visible-xs"><a href="<?php echo site_url('user/settings'); ?>"><?php echo lang('app_parameters'); ?></a></li>
                <li class="visible-xs"><a href="<?php echo site_url('welcome/out'); ?>"><?php echo lang('app_disconnect'); ?></a></li>
          	<?php else : ?>
              <li><a href="#login" data-toggle="modal" data-target="#loginModal"><?php echo lang('app_connect'); ?></a></li>
            <?php endif; ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

	<?php if ( ! empty($errors)) : ?>
	<div class="container">
		<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<?php foreach ($errors as $error) : ?>
				<p><?php echo $error; ?></p>
			<?php endforeach; ?>
		</div>
	</div>
	<?php endif; ?>
	
	<?php if ( ! empty($messages)) : ?>
	<div class="container">
		<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<?php foreach ($messages as $message) : ?>
				<p><?php echo $message; ?></p>
			<?php endforeach; ?>
		</div>
	</div>
	<?php endif; ?>
	
	<?php if ( ! empty($debug)) : ?>
	<div class="container">
		<div class="alert alert-warning alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<?php foreach ($debug as $key => $value) : ?>
				<p><?php echo "<strong>$key</strong>: <br/>".json_encode($value); ?></p>
			<?php endforeach; ?>
		</div>
	</div>
	<?php endif; ?>
