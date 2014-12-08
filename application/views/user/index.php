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
					<img src="<?php echo site_url($user->get_avatar('large')); ?>" alt="<?php echo $user->get_name(); ?>" class="img-rounded img-responsive">
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
			<div class="col-sm-4">
			<?php foreach ($user->get_activities() as $activity) : ?>
				<div class="panel panel-default panel-activity">
					<!--div>
						<img src="<?php echo $activity->get_image('large'); ?>" title="<?php echo $activity->title; ?>" class="img-responsive img-rounded"/>
					</div-->
					<div class="panel-body">
					<h3><?php echo $activity->title; ?></h3>
					<?php if (!empty($activity->description)) : ?>
						<p><?php echo $activity->description; ?></p>
					<?php endif; ?>
					<nav class="activity-menu">
						<ul>
							<?php if (!isset($current_user)) : ?>
							<li>
								<button type="button" data-toggle="modal" data-target="#<?php echo 'loginModal'; ?>" class="btn btn-success btn-xs">
									<?php echo lang('app_lets'); ?>
								</button>								
							</li>
							<?php else : ?>
								<?php if ($activity->owner != $current_user->id || $current_user->is(User_model::ROLE_ADMIN)) : ?>
								<li>
									<button type="button" data-toggle="modal" data-target="#<?php echo (!$current_user)?'loginModal':'letsModal'; ?>" class="btn btn-success btn-xs">
										<?php echo lang('app_lets'); ?>
									</button>								
								</li>
								<?php endif; ?>
								<?php if ($activity->owner == $current_user->id || $current_user->is(User_model::ROLE_ADMIN)) : ?>
								<li>
									<a href="<?php echo site_url('activity/update/'.$activity->id); ?>"><i class="fa fa-pencil-square-o"></i></a>						
								</li>
								<li>
									<a href="<?php echo site_url('activity/delete/'.$activity->id); ?>" 
										title="<?php echo sprintf(lang("app_activity_delete"),$activity->title);?>" class="btn-confirm cla">
										<i class="fa fa-trash-o"></i>
									</a>						
								</li>
								<?php endif; ?>
							<?php endif; ?>
						</ul>
					</nav>
					</div>
				</div>
			<?php endforeach; ?>
			</div>
		</div>

	</div>
    
<?php $this->load->view('footer.php');


