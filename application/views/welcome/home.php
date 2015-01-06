<?php $this->load->view('header'); ?>    
    
    <div class="container home" role="main">

		<div class="row">
			
			<div class="jumbotron">
				<?php 
					$intro = lang((isset($current_user))?'app_home_intro_connected':'app_home_intro'); 
					$search = array('<<app_contact>>','<<user_name>>');
					$replace = array(
						$this->config->item('contact_email'),
						(isset($current_user)?$current_user->get_name():'')
					);
					echo str_replace($search,$replace,$intro);
				?>
				<?php if (!isset($current_user)) : ?>
					<p>
						<a href="#register" data-toggle="modal" data-target="#registerModal">
							<strong><?php echo lang('app_create_your_account'); ?></strong>
						</a>
					</p>
				<?php endif; ?>
				
			</div>

			<?php
				if (isset($users) && is_array($users)) {
					$i = 0; $arr = array(array(),array(),array());
					foreach ($users as $user) {
						$arr[$i++][] = $user;
						if ($i == 3) $i = 0;
					}
					for ($i=0; $i < 3; $i++) : ?>
						<div class="col-sm-4">
						<?php 
							foreach ($arr[$i] as $user) $this->load->view("widgets/user",array('user' => $user)); 
						?>
						</div>
					<?php endfor;
				} ?>
			

		</div>
    </div>
    
    
<?php $this->load->view('footer.php');
