<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, inital-scale=1.0, shrink-to-fit=no"/>
  		
		<title>Billet simple pour l'Alaska</title>

		<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
		<link href="public/fonts/css/fontawesome.css" rel="stylesheet">
 		<link href="public/fonts/css/brands.css" rel="stylesheet">
  		<link href="public/fonts/css/solid.css" rel="stylesheet">
	
		<link rel="stylesheet" type="text/css" href="public/css/style.css">

		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body class="d-flex flex-column min-vh-100">
	<?php require ('view/headerView.php');?>

	<div class="container white_div my-5 mx-auto p-4 shadow-lg rounded">
		<h1 class="text-center mb-5">Connexion</h1>
		<form class="pb-5 m-auto" action="index.php?action=userLogin" method="post">
			<div class="mb-3">
				<?php
				if(!empty($showErrors))
				{
					if($showErrors == true){ ?>
						<div>
							<p>Certains champs requièrent votre attention.</p>
							<ol>
								<?php foreach ($errors as $kerrors) { ?>
								<li><?=$kerrors;?></li>
								<?php } ?>	
							</ol>
						</div>
					<?php
					}
				}
				?>
			</div>
			<div class="mb-3">
				<label for="pseudo" class="form-label">Pseudo</label>
				<input type="text" name="pseudoconnect" placeholder="Pseudo" class="form-control" id="pseudo" value="<?php if(isset($pseudoconnect)) { echo $pseudoconnect; } ?>">

			</div>
			<div class="mb-3">
				<label for="passconnect" class="form-label">Mot de passe</label>
				<input type="password" name="passconnect" class="form-control" id="passconnect" placeholder="Mot de passe" aria-describedby="passwordHelpBlock">
				<div id="passwordHelpBlock" class="form-text">
					Si vous avez oublié votre mot de passe veuillez en demander un autre à l'adresse mail suivrante : <a href="mailto:contact@jeanforteroche.com">admin@forteroche.fr</a>.
				</div>
			</div>
			<button type="submit" class="btn btn-primary" name="formconnection">Se connecter</button>
		</form>
		<?php
		if(isset($erreur))
		{
			echo $erreur;
		}
		?>
	</div>
	
	<div class="mt-auto">
		<?php require ('view/footerView.php')?>
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
