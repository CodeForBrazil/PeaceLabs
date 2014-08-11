

<!-- Modals -->
<?php $this->load->view('modals/new_activity'); ?>

<?php $this->load->view('modals/login'); ?>

<?php $this->load->view('modals/register'); ?>

<?php $this->load->view('modals/password'); ?>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/assets/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/assets/js/bootstrap.min.js"></script>
	<script src="/assets/js/global.js" type="text/javascript"></script>
<?php 
	if (isset($extra_js)) {
		foreach ($extra_js as $js) {
			echo "<script src=\"$js\" type=\"text/javascript\"></script>";
		}
	}
?>    
    
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

