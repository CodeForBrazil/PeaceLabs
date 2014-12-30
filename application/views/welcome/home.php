<?php $this->load->view('header'); ?>    
    
    <div class="container" role="main">

		<div class="row">

			<?php
				if (isset($users) && is_array($users)) {
					$i = 0; $arr = array(array(),array(),array());
					foreach ($users as $user) {
						$arr[$i++][] = $user;
						if ($i == 3) $i = 0;
					}
				}
			?>
			<?php for ($i=0; $i < 3; $i++) : ?>
				<div class="col-sm-4">
				<?php 
					foreach ($arr[$i] as $user) $this->load->view("widgets/user",array('user' => $user)); 
				?>
				</div>
			<?php endfor; ?>
			

		</div>
    </div>
    
    
<?php $this->load->view('footer.php');
