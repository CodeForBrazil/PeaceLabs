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
