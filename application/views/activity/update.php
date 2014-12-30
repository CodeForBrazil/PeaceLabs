<?php $this->load->view('header'); ?>    
    
    <div class="container" role="main">

		<div class="row">
			<div class="col-sm-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2 table-responsive" id="disabled_objects">
				
				<form id="edit_user" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
					<input type="hidden" id="activity-id" name="id" value="<?php echo $activity -> id; ?>" />
					<div class="form-group">
						<label class="control-label col-sm-4" for="name"><?php echo lang('app_activity_name'); ?></label>
						<div class="controls col-sm-8">
							<input id="activity-name" name="name" type="text" class="input-xlarge form-control"
								value="<?php echo set_value('name', $activity -> name); ?>" maxlength="100" />
							 <div class="alert-danger"><?php echo form_error('name'); ?></div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4" for="description"><?php echo lang('app_activity_description'); ?></label>
						<div class="controls col-sm-8">
							<textarea id="activity-description" name="description" type="text" class="input-xlarge form-control"
								placeholder="<?php echo lang('app_description_placeholder'); ?>"/><?php echo set_value('description', $activity -> description); 
							?></textarea>
							 <div class="alert-danger"><?php echo form_error('description'); ?></div>
						</div>
					</div>
					<div class="form-group">
						<div class="controls col-sm-8 col-sm-offset-4">
							<button type="submit" class="btn btn-success">Enregistrer</button>
							<a href="<?php echo site_url('activity/delete/'.$activity->id); ?>" 
								title="<?php echo str_replace('"','“',sprintf(lang("app_activity_delete"),$activity->name)); ?>" class="btn btn-danger btn-confirm pull-right">
								<i class="fa fa-trash-o"></i>
							</a>						
						</div>
					</div>
				</form>				
				
			</div>
		</div>
    </div>

<?php $data['extra_js'] = array("/assets/js/user.js"); ?>

<?php $this->load->view('footer.php',$data);
