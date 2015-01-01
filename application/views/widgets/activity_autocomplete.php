
<input type='hidden' id="<?php echo $name; ?>" name="activity_users" 
	placeholder="<?php echo lang('app_activity_users_placeholder'); ?>"  
	value="<?php echo (isset($user_list)?set_value('activity_users',$user_list):set_value('activity_users')); ?>" 
	class="input-xlarge form-control"/>

<?php if (!isset($light) || !$light) : ?>
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
  </script>
<?php endif; ?>

  <script type="text/javascript">
	$(document).ready(function () {
      	options = selectOptions;
      	options.ajax.url = "<?php echo site_url('/user/search_identities'); ?>";
      <?php if (isset($user_list)) : ?>
      	$("#<?php echo $name; ?>").select2(options).select2("data", <?php echo json_encode($user_list); ?>);
      <?php else : ?>
      	$("#<?php echo $name; ?>").select2(options).select2("data");
      <?php endif; ?>
	});

  </script>