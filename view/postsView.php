<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, inital-scale=1.0, shrink-to-fit=no"/>
  		
		<title>Blog TP P4</title>

<!-- 		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
		<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
		<link href="public/fonts/css/fontawesome.css" rel="stylesheet">
 		<link href="public/fonts/css/brands.css" rel="stylesheet">
  		<link href="public/fonts/css/solid.css" rel="stylesheet">
	
		<link rel="stylesheet" type="text/css" href="public/css/style.css">

		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<!-- <link rel="stylesheet" type="text/css" href="public/css/style.css"/> -->
	</head>
	<body>

		<?php require ('view/headerView.php')?>

		<div class="container">
		  <div id="alaskaCarousel" class="carousel slide" data-ride="carousel">
		    <!-- Indicators -->
		    <ol class="carousel-indicators">
		      <li data-target="#alaskacarousel" data-slide-to="0" class="active"></li>
		      <li data-target="#alaskaCarousel" data-slide-to="1"></li>
		      <li data-target="#alaskaCarousel" data-slide-to="2"></li>
		    </ol>

		    <!-- Wrapper for slides -->
		    <div class="carousel-inner">
		      <div class="item active">
		        <img src="public/images/slide1.jpg" alt="Un billet simple pour l'Alaska" style="width:100%;">
		      </div>

		      <div class="item">
		        <img src="public/images/slide2.jpg" alt="Un nouveau chapitre chaque semaine" style="width:100%;">
		      </div>
		    
		      <div class="item">
		        <img src="public/images/slide3.jpg" alt="Laissez un commentaire" style="width:100%;">
		      </div>
		    </div>

		    <!-- Left and right controls -->
		    <a class="left carousel-control" href="#alaskaCarousel" data-slide="prev">
		      <span class="glyphicon glyphicon-chevron-left"></span>
		      <span class="sr-only">Previous</span>
		    </a>
		    <a class="right carousel-control" href="#alaskaCarousel" data-slide="next">
		      <span class="glyphicon glyphicon-chevron-right"></span>
		      <span class="sr-only">Next</span>
		    </a>
		  </div>
		</div>

<!-- 			<div class="container hero_section">
				<div class="col text_hero_section">
						<h3 class="text-center">« Un roman qui vous embarque dans une aventure à couper le souffle ! » <span class="italique">New York Times</span></h3>
				</div>
			</div> -->

			<div class="row">
				<h1 class="section_titre text-center my-5">CHAPITRES PUBLIÉS</h2>
			</div>
			<div class="container">
			<?php
				while ($data = $posts->fetch())
				{
				?>
					<div class="col-sm-12 col-md-4 card">
						<div class="card-body">
							<img class="card-img-top" src="public/images/slide1.jpg" alt="Un billet simple pour l'Alaska">
							<h3 class="card-title">
							    <?=htmlspecialchars($data['title']); ?>
							</h3>
							<p class="card-text">
								Publié le <?=htmlspecialchars($data['date_creation_fr']); ?>
							</p>
							<p class="card-text">
							    <?=htmlspecialchars($data['content200chars']); ?>
							</p>
							<a href="index.php?action=post&id=<?=$data['id']; ?>"><input type="button" value="Lire la suite"></a>

							<?php 
							if(!empty($_SESSION['id']) && !empty($_SESSION['isAdmin']))
							{
								?>
								<a href="index.php?action=editPost&id=<?=$data['id']; ?>"> <input type="button" value="Modifier"></a>

								<a href="index.php?action=deletePost&id=<?=$data['id'];?>"> <input type="button" value="Supprimer"></a>
							<?php
							}
							?>
						</div>		
					</div>
				<?php
				}
				$posts->closeCursor();
				?>
			</div>
		</div>
		<div class="container">
			<div class="col text-center my-5">
				<a class="px-4" href="test">À propos</a>
				<a class="px-4" href="test">Vie privée</a>
				<a class="px-4" href="test">Conditions d'utilisation</a>
			</div>
		</div>

	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 	<script src="public/js/jquery.min.js"></script>
	<script src="public/js/popper.js"></script>
	<script src="public/js/bootstrap.min.js"></script>
	<script src="public/js/main.js"></script>
	</body>
</html>
