<?php $this->load->view('header'); ?>    
 
<?php
	$activity_users = $activity->get_users();
	$user_list = array();
	foreach ($activity_users as $i => $activity_user) {
		$user = $activity_user['user'];
		$user_list[$i] = array('id' => $user->id, 'text' => $user->get_name());
	}
?> 
   
    <div class="container" role="main">

		<div class="row">
			<div class="col-sm-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
				
				<form id="edit_user" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
					<input type="hidden" id="activity-id" name="id" value="<?php echo $activity -> id; ?>" />
					<div class="form-group">
						<label class="control-label col-sm-4" for="name"><?php echo lang('app_activity_name'); ?></label>
						<div class="controls col-sm-8">
							<input id="activity-name" name="name" type="text" class="input-xlarge form-control"
								value="<?php echo set_value('name', $activity -> name); ?>" maxlength="100" />
							 <div class="alert-danger"><?php echo form_error('name'); ?></div>
						    <div class="help-block"><?php echo lang('app_activity_name_help'); ?></div>
						</div>
					</div>
					<div class="form-group">
						<div class="controls col-sm-8 col-sm-offset-4">
						  	<?php $this->load->view('widgets/activity_autocomplete',
						  			array('name'=>'activity_users2','user_list'=>$user_list)); ?>
						    <div class="help-block"><?php echo lang('app_activity_users_help'); ?></div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4" for="description"><?php echo lang('app_activity_description'); ?></label>
						<div class="controls col-sm-8">
							<?php /*
								$data = array(
							      'name'        => 'description',
							      'id'          => 'activity-description',
							      'value'       => set_value('description',$activity -> description),
							      'class'       => 'input-xlarge form-control',
							      'placeholder' => lang('app_description_placeholder'),
							    );
							
							  echo form_textarea($data); */
  							?>
							<textarea id="activity-description" name="description" class="input-xlarge form-control"
								placeholder="<?php echo lang('app_description_placeholder'); ?>"/><?php 

								echo trim((isset($_POST['description'])?$_POST['description']:$activity -> description));
								// This didn't work! -> echo set_value('description',$activity -> description);

							?></textarea>
						    <div class="help-block"><?php echo lang('app_activity_description_help'); ?></div>
							<div class="alert-danger"><?php echo form_error('description'); ?></div>
						</div>
					</div>
					<div class="form-group">
						<div class="controls col-sm-8 col-sm-offset-4">
							<button type="submit" class="btn btn-success"><?php echo lang('app_save'); ?></button>
							<a href="<?php echo site_url('user/view/'.$activity->owner); ?>" class="btn btn-default">
								<?php echo lang('app_back_to_profile'); ?>
							</a>
							<a href="<?php echo site_url('activity/delete/'.$activity->id); ?>" 
								title="<?php echo str_replace('"','“',sprintf(lang("app_activity_delete"),$activity->name)); ?>" 
								class="btn btn-danger btn-confirm pull-right">
								<i class="fa fa-trash-o"></i>
							</a>						
						</div>
					</div>
				</form>				

		<?php if (count($activity_users) > 0) : ?>
			<div class="col-sm-8 col-sm-offset-4">
				<table class="table table-striped">
					
					<?php foreach($activity_users as $activity_user) : ?>
					<?php $user = $activity_user['user']; ?>
					<tr>
						<td>
							<div class="avatar avatar-small">
								<img src="<?php echo $user->get_avatar('small'); ?>" alt="<?php echo $user->get_name(); ?>" 
									class="img-responsive">
							</div>
						</td>
						<td>
							<?php echo $user->get_name(); ?>
							<?php if ((isset($activity_user['comment'])) && ($comment = $activity_user['comment']) && !empty($comment)) : ?>
								<div class="comment"><?php echo $activity_user['comment']; ?></div>
							<?php endif; ?>
							
						</td>
						<td>
							<a href="<?php echo site_url('activity/disclaim/'.$activity->id.'/'.$user->id); ?>" 
								title="<?php echo sprintf(lang("app_activity_user_disclaim"),$user->get_name());?>" 
								class="btn-confirm">
								<i class="fa fa-trash-o"></i>
							</a>
						</td>
						
					</tr>
					<?php endforeach; ?>
					
				</table>
				
			</div>
		<?php endif; ?>
				
			</div>
		</div>
		
    </div>

<?php $data['extra_js'] = array("/assets/js/user.js"); ?>

<?php $this->load->view('footer.php',$data);
