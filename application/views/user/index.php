<?php $this->load->view('header'); ?>    
    
    <div class="container" role="main">

		<div class="jumbotron">
			<?php echo $current_user->get_name(); ?>
		</div>
    </div>
    
    
<?php $this->load->view('footer.php');
