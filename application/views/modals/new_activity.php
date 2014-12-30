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
		        <input type='hidden' id="activity_users" name="activity_users" placeholder="<?php echo lang('app_activity_users_placeholder'); ?>"  
		        		value="<?php echo set_value('activity_users'); ?>" class="input-xlarge form-control"/>
		    <div class="help-block"><?php echo lang('app_activity_users_help'); ?></div>
		  </div>
		  <div class="form-group">
			<label for="activity-description"><?php echo lang('app_activity_description'); ?></label>
			<textarea id="activity-description" name="description" type="text" class="input-xlarge form-control" rows="5"
				placeholder="<?php echo lang('app_activity_description_placeholder'); ?>"/><?php echo set_value('description'); 
			?></textarea>
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

  <script src="<?php echo base_url('/assets/js/select2/select2.min.js'); ?>"></script>	
  <script src="<?php echo base_url('/assets/js/select2/select2_locale_fr.js'); ?>"></script>	

  <script type="text/javascript">
	function formatSelect2(item) { console.log(item); return item.name; }
  	var selectOptions = {
		    multiple: true,
			minimumInputLength: 3,
			quietMillis: 400,
			createSearchChoice: function(term, data) {
			    if ($(data).filter(function() {
			      return this.text.localeCompare(term) === 0;
			    }).length === 0) {
			      return {
			        id: term,
			        text: term
			      };
			    }
			},
     		ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
		        dataType: 'json',
		        data: function (term, page) {
		        	console.log(term);
		            return {
		                q: term // search term
		            };
		        },
		        results: function (data, page) { // parse the results into the format expected by Select2.
		            // since we are using custom formatting functions we do not need to alter remote JSON data
		            console.log(data);
		            return { results: data.results };
		        }
		    },
		    formatSelect2: formatSelect2
	};
	$(document).ready(function () {
      	options = selectOptions;
      	options.ajax.url = "<?php echo site_url('/user/search_identities'); ?>";
      	$("#activity_users").select2(options).select2("data");
	});

  </script>