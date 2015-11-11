<div class="modal fade" id="newProjectModal" tabindex="-1" role="dialog" aria-labelledby="newProjectModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only"><?php echo lang('app_close');?></span>
                </button>
                <h4 class="modal-title" id="registerModalLalel"><?php echo lang('newProjectTitle');?></h4>
            </div>

            <form role="form" method="post">
                <input type="hidden" name="form_name" value="register"/>
                <div class="modal-body">
                    <?php $this->load->view('partials/modalErrors');?>

                    <div class="form-group">
                        <label for="projectName"><?php echo lang('newProject_projectName');?></label>
                        <input type="text" class="form-control" id="projectName" name="project_name" placeholder="<?php echo lang('newProjectModalName')?>" value="<?php echo set_value('name');?>" >
                        <div class="alert-danger"><?php echo form_error('newProject_name');?></div>
                    </div>
                    <div class="form-group">
                        <label for="projectProfile_image"><?php echo lang('newProject_projectProfile_image');?></label>
                        <input type="text" class="form-control" id="projectProfile_image" name="project_profile_image" placeholder="<?php echo lang('newProjectModalProfile_image')?>" value="<?php echo set_value('profile_image');?>" >
                        <div class="alert-danger"><?php echo form_error('newProject_profile_image');?></div>
                    </div>
                    <div class="form-group">
                        <label for="projectFolder_image"><?php echo lang('newProject_projectFolder_image');?></label>
                        <input type="text" class="form-control" id="projectFolder_image" name="project_folder_image" placeholder="<?php echo lang('newProjectModalFolder_image')?>" value="<?php echo set_value('folder_image');?>" >
                        <div class="alert-danger"><?php echo form_error('newProject_folder_image');?></div>
                    </div>
                    <div class="form-group">
                        <label for="projectDescription"><?php echo lang('newProject_projectDescription');?></label>
                        <input type="text" class="form-control" id="projectDescription" name="project_description" placeholder="<?php echo lang('newProjectModalDescription')?>" value="<?php echo set_value('description');?>" >
                        <div class="alert-danger"><?php echo form_error('newProject_description');?></div>
                    </div>
                    <div class="form-group">
                        <label for="projectExecution_date"><?php echo lang('newProject_projectExecution_date');?></label>
                        <input type="text" class="form-control" id="projectExecution_date" name="project_execution_date" placeholder="<?php echo lang('newProjectModalExecution_date')?>" value="<?php echo set_value('execution_date');?>" >
                        <div class="alert-danger"><?php echo form_error('newProject_execution_date');?></div>
                    </div>
                    <div class="form-group">
                        <label for="projectPublic"><?php echo lang('newProject_projectPublic');?></label>
                        <input type="text" class="form-control" id="projectPublic" name="project_public" placeholder="<?php echo lang('newProjectModalPublic')?>" value="<?php echo set_value('public');?>" >
                        <div class="alert-danger"><?php echo form_error('newProject_public');?></div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('app_cancel');?></button>
                    <button type="submit" class="btn btn-success"><?php echo lang('app_register');?></button>
                </div>
            </form>
        </div>
    </div>
</div>
