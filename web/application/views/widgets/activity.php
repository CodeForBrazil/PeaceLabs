<?php $is_owner = isset($current_user) && ($activity->owner == $current_user->id || $current_user->is(User_model::ROLE_ADMIN)); ?>
<?php $is_not_owner = !isset($current_user) || ($activity->owner != $current_user->id) || $current_user->is(User_model::ROLE_ADMIN); ?>

<div class="panel panel-default panel-activity">
	<!--div>
		<img src="<?php echo $activity->get_image('large'); ?>" title="<?php echo $activity->title; ?>" class="img-responsive img-rounded"/>
	</div-->
	<div class="panel-body">
	<h3><?php echo $activity->name; ?></h3>
	<?php $activity_users = $activity->get_users(); ?>
	<div class="stats">
		<i class="fa fa-group"></i>&nbsp;<?php echo count($activity_users); ?>				
	</div>
	<?php if ($is_owner && count($activity_users)>0) : ?>
		<ul class="users">
			<?php foreach ($activity_users as $activity_user) : ?>
				<?php $user = $activity_user['user']; ?>
				<li>
					<div class="avatar avatar-small">
						<img src="<?php echo $user->get_avatar('small'); ?>" alt="<?php echo $user->get_name(); ?>" class="img-responsive">
					</div>
					<a href="<?php echo $user->get_url(); ?>"><?php echo $user->get_name(); ?></a>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
	<?php if (!empty($activity->description)) : ?>
		<p><?php echo $activity->description; ?></p>
	<?php endif; ?>
	<?php if ($is_not_owner) : ?>
		<div class="footer">
			<?php if (isset($current_user) && $activity->has_applied($current_user)) : ?>
				<a href="<?php echo site_url('activity/disclaim/'.$activity->id); ?>" 
					class="btn btn-danger btn-sm btn-confirm center-block" 
					title="<?php echo str_replace('"','“',sprintf(lang("app_activity_disclaim"),$activity->name));?>">
					<?php echo lang('app_disclaim'); ?>
				</a>		
			<?php else : ?>
				<button type="button" data-toggle="modal" data-target="#<?php echo ((!isset($current_user))?'loginModal':'applyModal'); ?>" 
					class="btn btn-success btn-sm center-block btn-apply" data-activity-name="<?php echo $activity->name; ?>" 
					data-activity-owner="<?php echo $activity->get_owner()->get_name(); ?>"
					data-activity-id="<?php echo $activity->id; ?>" 
					title="<?php echo lang('app_apply_title'); ?>">
					<?php echo lang('app_apply'); ?>
				</button>		
			<?php endif; ?>						
		</div>
	<?php endif; ?>
	<?php if ($is_owner) : ?>
		<nav class="activity-menu">
			<ul>
				<li>
					<a href="<?php echo site_url('activity/update/'.$activity->id); ?>"><i class="fa fa-gear"></i></a>						
				</li>
			</ul>
		</nav>
	<?php endif; ?>
	</div>
</div>
