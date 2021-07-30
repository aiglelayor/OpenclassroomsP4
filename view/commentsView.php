<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, inital-scale=1.0 shrink-to-fit=no"/>
  	<link rel="stylesheet" type="text/css" href="public/css/style.css"/>
	<title><?php htmlspecialchars($post['title']);?> </title>

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
	<link href="public/fonts/css/fontawesome.css" rel="stylesheet">
 	<link href="public/fonts/css/brands.css" rel="stylesheet">
  	<link href="public/fonts/css/solid.css" rel="stylesheet">
	
	<link rel="stylesheet" type="text/css" href="public/css/style.css">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>

	<?php require ('view/headerView.php')?>

	<section class="container">
		<?php
		if(isset($_SESSION['comment_reported']))
		{
		?>
			<div class="alert alert-success" role="alert">
			Merci ! Le commentaire a été signalé. Nous allons vérifier le contenu.
			</div>
		<?php
		};
		?>

		<div class="row">
			<h2 class="section_titre text-center my-5"><?=htmlspecialchars($post['title'])?></h2>
		</div>
		<p>
			<?=htmlspecialchars($post['content'])?>
		</p>
		
		<h2 class="text-center pt-5">Laissez un commentaire :</h2>
		
		<form class="pb-5 m-auto" action="index.php?action=addComment&amp;id=<?=$post['id']; ?>" method="post">
			<table>
				<div class="form-group">
					<?php
						if(empty($_SESSION))
						{
					?>
						<label for="pseudo">Votre nom : </label>
						<input type="text" class="form-control" name="pseudo" required>
						<small class="form-text text-muted">Vous pouvez également créer un compte, votre pseudo/nom ne vous sera plus demandé. Nous serons ravis de vous compter parmi notre communauté de lecteur ! :-)</small>
					<?php
						}
					?>
				</div>
				<div class="form-group">
					<label for="comment">Commentaire :</label>
					<textarea class="form-control" rows="3" name="comment" required></textarea>
				</div>
				<div class="form-group">
					<button name="" type="submit" class="btn btn-primary">Publier le commentaire</button>
				</div>				
			</table>
		</form>

		<?php
		if(!empty($comments)){			
		?>
			<h2>Commentaires</h2>
			<div>
				<?php
				}
				foreach($comments as $com) {
				?>
					<p>
						<strong><?=htmlspecialchars($com['author'])?></strong> le <?=htmlspecialchars($com['comment_date_fr'])?> </br><?=htmlspecialchars($com['comment'])?>
					</p>
					<?php
					if(!empty($_SESSION))
					{
					?>
						<a href="index.php?action=reportComment&comId=<?=$com['id']; ?>&amp;id=<?=$post['id']; ?>"><button type="button" class="btn btn-warning">Signaler</button></a>
					<?php
					}else {
					?>
						<a href="index.php?action=login"><button type="button" class="btn btn-primary">Se connecter pour signaler</button></a>
					<?php
					}
					?>
				<?php
				}
				?>
		</div>
	</section>

	<?php require ('view/footerView.php')?>

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