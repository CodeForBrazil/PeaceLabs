<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo lang('app_close'); ?></span></button>
        <h4 class="modal-title" id="passwordModalLabel"><?php echo lang('app_password_title'); ?></h4>
      </div>
	  <form role="form" method="post">
	  	<input type="hidden" name="form_name" value="password"/>
	    <div class="modal-body">
		  <div class="form-group">
		    <label for="passwordEmail"><?php echo lang('app_email'); ?></label>
		    <input type="email" class="form-control" id="passwordEmail" name="password_email" 
		    	placeholder="<?php echo lang('app_retrieve_password_placeholder'); ?>" value="<?php echo set_value('password_email'); ?>">
		    <div class="alert-danger"><?php echo form_error('password_email'); ?></div>
		  </div>
	    </div>
	    <div class="modal-footer">
	      <a href="#register" data-toggle="modal" data-target="#registerModal" data-dismiss="modal"><?php echo lang('app_register'); ?></a>
	      <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('app_cancel'); ?></button>
	      <button type="submit" class="btn btn-success"><?php echo lang('app_send'); ?></button>
	    </div>
	  </form>
    </div>
  </div>
</div>
