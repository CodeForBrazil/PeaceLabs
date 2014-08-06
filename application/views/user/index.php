<?php $this->load->view('header'); ?>    
    
    <div class="container" role="main">

		<div class="jumbotron">
			<h2><?php echo $user->get_name(); ?></h2>
		</div>

	</div>
    
<?php $this->load->view('footer.php');
