<?php $this->load->view('header'); ?>    
    
    <div class="container" role="main">

		<div class="jumbotron header">
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
				
				<div class="avatar avatar-large">
					<img src="<?php echo $user->get_avatar('large'); ?>" alt="<?php echo $user->get_name(); ?>" class="img-rounded img-responsive">
				</div>
				<h2><?php echo $user->get_name(); ?></h2>
				<?php if ($user->bio) : ?>
					<p><?php echo $user->html('bio'); ?></p>
				<?php endif; ?>
				<?php if ($user->city) : ?>
					<p><i class="fa fa-map-marker"></i>&nbsp;<?php echo $user->html('city'); ?></p>
				<?php endif; ?>
			</div>
		</div>
		
		<div class="row">
			<?php 
				$i = 0; $arr = array(array(),array(),array());
				foreach ($user->get_activities() as $activity) {
					$arr[$i++][] = $activity;
					if ($i == 3) $i = 0;
				}
			?>
			<?php for ($i=0; $i < 3; $i++) : ?>
				<div class="col-sm-4">
				<?php 
					foreach ($arr[$i] as $activity) $this->load->view("widgets/activity",array('activity' => $activity)); 
				?>
				</div>
			<?php endfor; ?>
		</div>

	</div>
    
<?php $this->load->view('footer.php');


