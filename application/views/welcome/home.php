<?php $this->load->view('header'); ?>    
    
    <div class="container theme-showcase" role="main">

		<div class="jumbotron">
			<?php if (isset($current_user)) echo json_encode($current_user); else echo "Hello"; ?>
			<?php echo $this->session->userdata('user_id'); ?>
		</div>
    </div>
    
    
<?php $this->load->view('footer.php');
