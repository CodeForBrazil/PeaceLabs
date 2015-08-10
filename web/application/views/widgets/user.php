<div class="panel panel-default panel-user goto" data-goto="<?php echo $user->get_url(); ?>">
	<div class="panel-body">
		<div class="avatar avatar-medium">
			<img src="<?php echo $user->get_avatar('medium'); ?>" alt="<?php echo $user->get_name(); ?>" class="img-rounded img-responsive">
		</div>
		<h3><a href="<?php echo $user->get_url(); ?>"><?php echo $user->get_name(); ?></a></h3>
		<?php if ($activities = $user->get_activities()) : ?>
			<p>
				<?php 
					$count = count($activities);
					echo $count.' ';
					echo ($count>1)?lang('app_activities'):lang('app_activity'); 
				?>
			</p>
		<?php endif; ?>
		<?php if ($user->city) : ?>
			<p><i class="fa fa-map-marker"></i>&nbsp;<?php echo $user->html('city'); ?></p>
		<?php endif; ?>
	</div>
</div>
