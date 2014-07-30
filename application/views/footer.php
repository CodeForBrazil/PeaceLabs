

<!-- Modals -->
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
		  </div>
	    </div>
	    <div class="modal-footer">
	      <a href="#register" data-toggle="modal" data-target="#registerModal" data-dismiss="modal"><?php echo lang('app_register'); ?></a>
	      <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('app_cancel'); ?></button>
	      <button type="submit" class="btn btn-primary"><?php echo lang('app_connect'); ?></button>
	    </div>
	  </form>
    </div>
  </div>
</div>

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
          <button type="submit" class="btn btn-primary"><?php echo lang('app_register'); ?></button>
      	</div>
	  </form>
    </div>
  </div>
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/assets/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/assets/js/bootstrap.min.js"></script>
    
    
    <script type="text/javascript">
    $(window).load(function(){
<?php if (isset($open_login_modal)) : ?>
        $('#loginModal').modal('show');
<?php endif; ?>

<?php if (isset($open_register_modal)) : ?>
        $('#registerModal').modal('show');
<?php endif; ?>
    });
    </script>
    
  </body>
</html>
