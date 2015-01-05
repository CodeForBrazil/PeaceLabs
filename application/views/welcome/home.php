<?php $this->load->view('header'); ?>    
    
    <div class="container home" role="main">

		<div class="row">
			
			<?php $app_name = "Lets"; ?>
			<?php if (isset($current_user)) : ?>
			<div class="jumbotron">
				<p>
					<strong>Bienvenue sur <?php echo $app_name.' <em>'.$current_user->get_name().'</em>'; ?> !</strong>
				</p>
			</div>
			<?php else : ?>
			<div class="jumbotron">
				<p>
					<strong>Bienvenue sur <?php echo $app_name; ?>!</strong> Ceci n'est qu'un prototype mais c'est un <em>bon début</em>. 
					Le but de ce site est de passer plus
					de <em>temps entre amis</em>, de <em>mieux les connaître</em>, de construire de <em>nouveaux souvenirs</em>, de se rencontrer 
					<strong>pour de vrai</strong>.
				</p>
				<p>
					<em><?php echo $app_name; ?></em> vous permet de noter <strong>ce que vous aimez ou aimeriez faire</strong>, d'y associer
					les amis que vous savez intéressés. Ensuite, d'autres amis pourront s'y ajouter spontanéement. 
					Le jour voulu vous saurez qui prévenir.
				</p>
				<p>
					<em>Inscrivez-vous</em> et testez! en vous rappelant que c'est un embryon de site, qu'il n'y a que 5% 
					des <strong>idées fantastiques</strong> que nous voulons y mettre. 
					Si vous avez des suggestions, des conseils, de problèmes, 
					faites le nous savoir par mail: <em><?php echo CONTACT_EMAIL; ?></em>.
 				</p>
				<p>
					<strong>A venir</strong>: rangement des activité par <em>Thèmes</em>, liste d'amis et <em>Privacité</em>, Partage et connexion avec 
					<em>Facebook</em>. 
				</p>
				<p>
					<a href="#register" data-toggle="modal" data-target="#registerModal"><strong>Allez-y créer votre compte!</strong></a>
				</p>
				
			</div>
			<?php endif; ?>

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
