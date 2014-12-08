<div class="modal fade" id="letsModal" tabindex="-1" role="dialog" aria-labelledby="letsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
	  <form role="form" method="post">
	  	<input type="hidden" name="form_name" value="lets"/>
	  	<input type="hidden" name="id"/>
	    <div class="modal-body">
	      <div><?php echo lang('app_lets_intro'); ?></div>
		  <div class="form-group">
			<textarea id="lets-comment" name="description" type="text" class="input-xlarge form-control" rows="5"
				placeholder="<?php echo lang('app_lets_comment_placeholder'); ?>"/></textarea>
		    <div class="help-block"><?php echo lang('app_lets_comment_help'); ?></div>
		  </div>
	    </div>
	    <div class="modal-footer">
	      <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('app_cancel'); ?></button>
	      <button type="submit" class="btn btn-success"><?php echo lang('app_lets'); ?></button>
	    </div>
	  </form>
    </div>
  </div>
</div>
