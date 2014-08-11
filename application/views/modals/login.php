<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo lang('app_close'); ?></span></button>
        <h4 class="modal-title" id="loginModalLabel"><?php echo lang('app_login_title'); ?></h4>
      </div>
	  <form role="form" method="post">
	  	<input type="hidden" name="form_name" value="login"/>
	    <div class="modal-body">
		  <div class="form-group">
		    <label for="loginEmail"><?php echo lang('app_email'); ?></label>
		    <input type="email" class="form-control" id="loginEmail" name="login_email" 
		    	placeholder="<?php echo lang('app_email_placeholder'); ?>" value="<?php echo set_value('login_email'); ?>">
		    <div class="alert-danger"><?php echo form_error('login_email'); ?></div>
		  </div>
		  <div class="form-group">
		    <label for="loginPassword"><?php echo lang('app_password'); ?></label>
		    <input type="password" class="form-control" id="loginPassword" name="login_password" 
		    	placeholder="<?php echo lang('app_password_placeholder'); ?>" value="<?php echo set_value('login_password'); ?>">
		    <div class="alert-danger"><?php echo form_error('login_password'); ?></div>
		    <div><a href="#password" data-toggle="modal" data-target="#passwordModal" data-dismiss="modal"><?php echo lang('app_retrieve_password'); ?></a></div>
		  </div>
	    </div>
	    <div class="modal-footer">
	      <a href="#register" data-toggle="modal" data-target="#registerModal" data-dismiss="modal"><?php echo lang('app_register'); ?></a>
	      <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('app_cancel'); ?></button>
	      <button type="submit" class="btn btn-success"><?php echo lang('app_connect'); ?></button>
	    </div>
	  </form>
    </div>
  </div>
</div>