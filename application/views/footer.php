
	<div class="container">
		<ul id="footer_menu">
			<li><a href="<?php echo site_url('welcome/todo'); ?>">To do</a></li>
			<li><a href="<?php echo site_url('welcome/theme'); ?>">Theme</a></li>
		</ul>
	</div>

<!-- Modals -->
<?php $this->load->view('modals/new_activity'); ?>

<?php $this->load->view('modals/login'); ?>

<?php $this->load->view('modals/register'); ?>

<?php $this->load->view('modals/password'); ?>

<?php $this->load->view('modals/confirm'); ?>

<?php $this->load->view('modals/lets'); ?>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url('/assets/js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo base_url('/assets/js/global.js'); ?>" type="text/javascript"></script>
    
    <script type="text/javascript">
    $(window).load(function(){
<?php if (isset($open_modal)) : ?>
        $('#<?php echo $open_modal; ?>Modal').modal('show');
<?php endif; ?>

    });
    </script>

<?php if (defined('ENVIRONMENT') && in_array(ENVIRONMENT,array('development'))) $this->output->enable_profiler(TRUE); ?>
    
  </body>
</html>

