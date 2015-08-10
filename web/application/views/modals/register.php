<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLalel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo lang('app_close'); ?></span></button>
        <h4 class="modal-title" id="registerModalLalel"><?php echo lang('app_register_title'); ?></h4>
      </div>
	  <form role="form" method="post">
	  	<input type="hidden" name="form_name" value="register"/>
	    <div class="modal-body">
		  <?php if ( ! empty($errors)) : ?>
			<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<?php foreach ($errors as $error) : ?>
					<p><?php echo $error; ?></p>
				<?php endforeach; ?>
			</div>
		  <?php endif; ?>
		  <div class="form-group">
		    <label for="registerEmail"><?php echo lang('app_email'); ?></label>
		    <input type="email" class="form-control" id="registerEmail" name="register_email" 
		    	placeholder="<?php echo lang('app_email_placeholder'); ?>" value="<?php echo set_value('register_email'); ?>">
		    <div class="alert-danger"><?php echo form_error('register_email'); ?></div>
		  </div>
		  <div class="form-group">
		    <label for="registerPassword"><?php echo lang('app_password'); ?></label>
		    <input type="password" class="form-control" id="registerPassword" name="register_password" 
		    	placeholder="<?php echo lang('app_password_placeholder'); ?>" value="<?php echo set_value('register_password'); ?>">
		    <div class="alert-danger"><?php echo form_error('register_password'); ?></div>
		  </div>
		  <div class="form-group">
		    <label for="confirmPassword"><?php echo lang('app_confirm_password'); ?></label>
		    <input type="password" class="form-control" id="confirmPassword" name="confirm_password" 
		    	placeholder="<?php echo lang('app_confirm_password_placeholder'); ?>" value="<?php echo set_value('confirm_password'); ?>">
		    <div class="alert-danger"><?php echo form_error('confirm_password'); ?></div>
		  </div>
	    </div>
      	<div class="modal-footer">
	      <a href="#login" data-toggle="modal" data-target="#loginModal" data-dismiss="modal"><?php echo lang('app_already_account'); ?></a>
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('app_cancel'); ?></button>
          <button type="submit" class="btn btn-success"><?php echo lang('app_register'); ?></button>
      	</div>
	  </form>
    </div>
  </div>
</div>