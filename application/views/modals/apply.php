<div class="modal fade" id="applyModal" tabindex="-1" role="dialog" aria-labelledby="applyModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
	  <form role="form" method="post">
	  	<input type="hidden" name="form_name" value="apply"/>
	  	<input type="hidden" name="id" value="<?php echo ($activity)?$activity->id:''; ?>"/>
	    <div class="modal-body">
	      <div><?php echo lang('app_apply_intro'); ?></div>
		  <div class="form-group">
			<textarea id="apply-comment" name="description" type="text" class="input-xlarge form-control" rows="5"
				placeholder="<?php echo lang('app_apply_comment_placeholder'); ?>"/></textarea>
		    <div class="help-block"><?php echo lang('app_apply_comment_help'); ?></div>
		  </div>
	    </div>
	    <div class="modal-footer">
	      <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('app_cancel'); ?></button>
	      <button type="submit" class="btn btn-success"><?php echo lang('app_apply'); ?></button>
	    </div>
	  </form>
    </div>
  </div>
</div>

<script type="application/javascript">
	$(document).ready(function () {
		$('.btn-apply').click(function() {
			if ($(this).attr('data-activity-name')) $('#applyModal .activity-name').html($(this).attr('data-activity-name'));
			if ($(this).attr('data-activity-owner')) $('#applyModal .owner-name').html($(this).attr('data-activity-owner'));
		});
	});
</script>
