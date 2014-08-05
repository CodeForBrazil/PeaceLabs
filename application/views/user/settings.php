<?php $this->load->view('header'); ?>    
    
    <div class="container" role="main">

		<div class="jumbotron">
			<?php echo "Paramètres du compte: ".$user->get_name(); ?>
		</div>
    </div>
    
    
<?php $this->load->view('footer.php');
