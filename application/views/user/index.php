<?php $this->load->view('header'); ?>    
    
    <div class="container" role="main">

		<div class="jumbotron">
			<div class="user-header">
				<?php if (isset($current_user) && ($current_user->id == $user->id)) : ?>
				<nav>
					<ul class="nav nav-pills pull-right">
						<li>
							<a href="<?php echo site_url('user/settings'); ?>">
								<i class="fa fa-pencil-square-o"></i>
								<span class="hidden-xs"><?php echo lang('app_parameters'); ?></span>
							</a>
						</li>
					</ul>
				</nav>
				<?php endif; ?>
				
				<div class="avatar">
					<img src="<?php echo site_url($user->get_avatar('medium')); ?>" alt="<?php echo $user->get_name(); ?>" class="img-rounded img-responsive">
				</div>
				<h2><?php echo $user->get_name(); ?></h2>
				<p><?php echo $user->html('bio'); ?></p>
			</div>
		</div>

	</div>
    
<?php $this->load->view('footer.php');
