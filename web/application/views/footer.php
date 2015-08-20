
<?php if (isset($current_user) && $current_user->is(User_model::ROLE_ADMIN)) : ?>
	<div class="container">
		<ul id="footer_menu">
			<li><a href="<?php echo site_url('welcome/todo'); ?>">To do</a></li>
			<li><a href="<?php echo site_url('welcome/theme'); ?>">Theme</a></li>
		</ul>
	</div>
<?php endif; ?>

<!-- Modals -->
<?php $this->load->view('modals/new_activity'); ?>

<?php $this->load->view('modals/login'); ?>

<?php $this->load->view('modals/register'); ?>

<?php $this->load->view('modals/password'); ?>

<?php $this->load->view('modals/confirm'); ?>

<?php $this->load->view('modals/apply'); ?>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url('/assets/js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo base_url('/assets/js/global.js'); ?>" type="text/javascript"></script>
	
<?php 
	if (isset($extra_js)) {
		foreach ($extra_js as $js) {
			echo "<script src=\"$js\" type=\"text/javascript\"></script>";
		}
	}
/*	if (isset($extra_js_scripts)) {
		echo "$(document).ready(function () {";
		foreach ($extra_js_scripts as $script) echo $script;
		echo "});";
	}*/
?>    

<?php if (isset($open_modal)) : ?>
    <script type="text/javascript">
    $(window).load(function(){
        $('#<?php echo $open_modal; ?>Modal').modal('show');
    });
    </script>
<?php endif; ?>

<?php if (defined('ENVIRONMENT') && in_array(ENVIRONMENT,array('development'))) $this->output->enable_profiler(TRUE); ?>
    
  </body>
</html>

