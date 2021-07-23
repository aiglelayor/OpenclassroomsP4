<header>
	<!-- Blue header -->
	<div class="wrap">
		<div class="container">
			<div class="row justify-content-right">
				<div class="col m-auto">
					<p class="mb-0 contact"><span class="fas fa-envelope"></span> contact@jeanforteroche.com</p>
				</div>
				<div class="col d-flex justify-content-end">
					<div class="social-media">
			    		<p class="mb-0 d-flex">
			    			<a href="#" class="d-flex align-items-center justify-content-center"><span class="fab fa-facebook-f"><i class="sr-only">Facebook</i></span></a>
			    			<a href="#" class="d-flex align-items-center justify-content-center"><span class="fab fa-twitter"><i class="sr-only">Twitter</i></span></a>
			    			<a href="#" class="d-flex align-items-center justify-content-center"><span class="fab fa-instagram"><i class="sr-only">Instagram</i></span></a>
			    			<a href="#" class="d-flex align-items-center justify-content-center"><span class="fab fa-dribbble"><i class="sr-only">Dribbble</i></span></a>
			    		</p>
	        		</div>
				</div>
			</div>
		</div>
	</div>

	<nav class="navbar navbar-expand-lg ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	    	<a class="navbar-brand" href="index.html">Jean Forteroche <span>Écrivain</span></a>

	    	<form action="#" class="searchform order-sm-start order-lg-last">
		        <div class="form-group d-flex">
		            <input type="text" class="form-control pl-3" placeholder="Search">
		            <button type="submit" placeholder="" class="form-control search"><span class="fa fa-search"></span></button>
		        </div>
        	</form>

	      	<div class="collapse navbar-collapse order-last user" id="ftco-nav">
	      	  	<ul class="navbar-nav m-auto">
	      			<li class="nav-item dropdown">
		            	<a href="#" class="nav-link dropdown-toggle align-items-center justify-content-center"><span class="fas fa-user"><i class="sr-only">Utilisateur</i></span></a>
		           		<div class="dropdown-menu" aria-labelledby="dropdown04">
			              	<?php
							if(empty($_SESSION['id']))
							{
							?>
								<a class="dropdown-item" href="index.php?action=login">Connexion</a>
							<?php 
							}
							if(empty($_SESSION['id']))
							{
							?>
								<a class="dropdown-item" href="index.php?action=formCreateUser">Créer compte</a>
							<?php 
							}
							if(!empty($_SESSION['id']))
							{
							?>
								<a class="dropdown-item" href="index.php?action=userLogout">Se déconnecter</a>
								<p class="text-white">Bienvenue <?=htmlspecialchars($_SESSION['pseudo']) ?></p>
							<?php 
							}
							?>
		             	</div>
	            	</li>
	            </ul>
	        </div> 

	     	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="fa fa-bars"></span> Menu
	     	</button>

	      	<div class="collapse navbar-collapse" id="ftco-nav">
	      	  	<ul class="navbar-nav m-auto">
	        		<li class="nav-item active"><a href="index.php" class="nav-link">Accueil</a>
	        		</li>
	        		<li class="nav-item dropdown">
		            	<a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Lire</a>
		           		<div class="dropdown-menu" aria-labelledby="dropdown04">
		              		<a class="dropdown-item" href="index.php?action=post&id=1">Chapitre 1 : Un mystérieux billet</a>
		               		<a class="dropdown-item" href="index.php?action=post&id=2">Chapitre 2 : L'inconnu de l'A380</a>
		                	<a class="dropdown-item" href="index.php?action=post&id=3">Chapitre 3 : Un bel horizon, un nouveau regard</a>
		                	<a class="dropdown-item" href="index.php">Autres chapitres</a>
		             	</div>
	            	</li>
					<li class="nav-item">
						<?php
						if (!empty($_SESSION['isAdmin']))
						{
							?>
								<a class="nav-link" href="index.php?action=newPost">Rédiger article</a>
							<?php 
						}
						?>
					</li>
					<li class="nav-item">
						<?php
						if (!empty($_SESSION['isAdmin']))
						{
							?>
								<a class="nav-link" href="index.php?action=reportedComments">Commentaires Signalés</a>
							<?php 
						}
						?>
					</li>	            
	        	</ul>
	      	</div>

	    </div>
  	</nav>
<!-- END nav -->
</header>