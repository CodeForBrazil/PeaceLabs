<?php $this->load->view('header'); ?>    
    
    <div class="container home" role="main">

		<div class="row">
			
			<div class="jumbotron">
				<?php if (!isset($current_user)) : ?>
					<p>
						<a href="#register" data-toggle="modal" data-target="#registerModal">
							<strong>Register now!</strong>
						</a>
					</p>
				<?php endif; ?>
				
			</div>

		</div>
    </div>
    
    
<?php $this->load->view('footer.php');
