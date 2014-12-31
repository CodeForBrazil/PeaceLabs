<?php $this->load->view('header'); ?>    

    <div class="container" role="main">

		<div class="row">
			<div class="col-sm-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2 table-responsive" id="disabled_objects">
				
				<form id="edit_user" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
					<div class="form-group">
						<label class="control-label col-sm-4" for="name"><?php echo lang('app_name'); ?></label>
						<div class="controls col-sm-8">
							<input id="user-name" name="name" type="text" class="input-xlarge form-control"
								value="<?php echo set_value('name', $user -> name); ?>" maxlength="100" />
							 <div class="alert-danger"><?php echo form_error('name'); ?></div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4" for="avatar"><?php echo lang('app_avatar'); ?></label>
						<div class="controls col-sm-8">
							<div class="avatar img-preview">
								<img src="<?php echo $user->get_avatar('medium'); ?>" alt="<?php echo $user->get_name(); ?>" class="img-rounded img-responsive">
							</div>
							<span class="btn btn-default btn-file btn-xs">
							    <?php echo lang('app_browse'); ?> <input type="file" id="user-avatar" name="avatar" />
							</span>
							<div class="alert-danger">
								<?php echo form_error('avatar'); ?>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4" for="email"><?php echo lang('app_email'); ?></label>
						<div class="controls col-sm-8">
							<input id="user-email" name="email" type="text" class="input-xlarge form-control" placeholder="obligatoire"
								value="<?php echo set_value('email', $user -> email); ?>" maxlength="100"/>
							 <div class="alert-danger"><?php echo form_error('email'); ?></div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4" for="password"><?php echo lang('app_password'); ?></label>
						<div class="controls col-sm-8">
							<input id="user-password" name="password" type="password" class="input-xlarge form-control"
								value="<?php echo set_value('password', ''); ?>" maxlength="15"/>
							 <div class="alert-danger"><?php echo form_error('password'); ?></div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4" for="password_confirm"><?php echo lang('app_confirm_password'); ?></label>
						<div class="controls col-sm-8">
							<input id="user-password_confirm" name="password_confirm" type="password" class="input-xlarge form-control"
								value="<?php echo set_value('password_confirm', ''); ?>" maxlength="15"/>
							 <div class="alert-danger"><?php echo form_error('password_confirm'); ?></div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4" for="alias"><?php echo lang('app_alias'); ?></label>
						<div class="controls col-sm-8">
							<div class="input-group">
								<span class="input-group-addon domain"><?php echo $_SERVER['HTTP_HOST']; ?>/</span>
								<input id="user-alias" name="alias" type="text" class="input-xlarge form-control"
									value="<?php echo set_value('phone', $user -> alias); ?>" maxlength="50"/>
							</div>
							 <div class="alert-danger"><?php echo form_error('alias'); ?></div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4" for="bio"><?php echo lang('app_bio'); ?></label>
						<div class="controls col-sm-8">
							<textarea id="user-bio" name="bio" type="text" class="input-xlarge form-control"
								placeholder="<?php echo lang('app_bio_placeholder'); ?>"/><?php echo set_value('bio', $user -> bio); 
							?></textarea>
							 <div class="alert-danger"><?php echo form_error('bio'); ?></div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4" for="city"><?php echo lang('app_city'); ?></label>
						<div class="controls col-sm-8">
							<input id="user-city" name="city" type="text" class="input-xlarge form-control"
								value="<?php echo set_value('city', $user -> city); ?>" maxlength="100"/>
							 <div class="alert-danger"><?php echo form_error('city'); ?></div>
						</div>
					</div>
					<div class="form-group">
						<div class="controls col-sm-8 col-sm-offset-4">
							<button type="submit" class="btn btn-danger"><?php echo lang('app_save'); ?></button>
							<a href="<?php echo site_url('user/view/'.$user->id); ?>" class="btn btn-default">
								<?php echo lang('app_back_to_profile'); ?>
							</a>
						</div>
					</div>
				</form>				
				
			</div>
		</div>
    </div>

<?php $data['extra_js'][] = base_url("/assets/js/user.js"); ?>

<?php $this->load->view('footer.php',$data);
