<?php
/*	
	$activity_users = array();
	foreach ($activity->get_users() as $i => $activity_user) {
		$user = $activity_user->user;
		$activity_users[] = array('id' => $user->id, 'text' => $user->get_name());
	}*/
?>

<div class="modal fade" id="newActivityModal" tabindex="-1" role="dialog" aria-labelledby="newActivityModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo lang('app_close'); ?></span></button>
        <h4 class="modal-title" id="newActivityModalLabel"><?php echo lang('app_new_activity_title'); ?></h4>
      </div>
	  <form role="form" method="post">
	  	<input type="hidden" name="form_name" value="new_activity"/>
	    <div class="modal-body">
		  <div class="form-group">
		    <input type="text" class="form-control" id="activity-name" name="name" 
		    	placeholder="<?php echo lang('app_activity_name_placeholder'); ?>" value="<?php echo set_value('name'); ?>">
		    <div class="help-block"><?php echo lang('app_activity_name_help'); ?></div>
		    <div class="alert-danger"><?php echo form_error('name'); ?></div>
		  </div>
		  <div class="form-group">
		  	<?php $this->load->view('widgets/activity_autocomplete',array('name'=>'activity_users')); ?>
		    <div class="help-block"><?php echo lang('app_activity_users_help'); ?></div>
		  </div>
		  <div class="form-group">
			<label for="activity-description"><?php echo lang('app_activity_description'); ?></label>
			<textarea id="activity-description" name="description" type="text" class="input-xlarge form-control" rows="5"
				placeholder="<?php echo lang('app_activity_description_placeholder'); ?>"/><?php echo set_value('description');?>
			</textarea>
		    <div class="help-block"><?php echo lang('app_activity_description_help'); ?></div>
			<div class="alert-danger"><?php echo form_error('description'); ?></div>
		  </div>
<!--		  <div class="form-group">
			<label for="image"><?php echo lang('app_activity_image'); ?></label>
			<div class="img-preview">
				<img src="" class="img-rounded img-responsive">
			</div>
			<span class="btn btn-default btn-file btn-xs">
			    <?php echo lang('app_browse'); ?> <input type="file" id="activity-image" name="image" />
			</span>
		    <div class="help-block"><?php echo lang('app_activity_image_help'); ?></div>
			<div class="alert-danger"><?php echo form_error('image'); ?></div>
</div> -->
	    </div>
	    <div class="modal-footer">
	      <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('app_cancel'); ?></button>
	      <button type="submit" class="btn btn-success"><?php echo lang('app_save'); ?></button>
	    </div>
	  </form>
    </div>
  </div>
</div>
