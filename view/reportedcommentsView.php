<!DOCTYPE html>
<html lang="fr">
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
	<body class="d-flex flex-column min-vh-100">

		<?php require ('view/headerView.php')?>

		<div class="container">
			<h2 class="text-center py-5">Commentaires signalés</h2>
			<div>
				<?php
				if(isset($_SESSION['comment_erased']))
				{
				?>
					<div class="alert alert-danger fade-in" role="alert">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<?php echo $_SESSION['comment_erased']; ?>
					</div>
				<?php
				};
				unset($_SESSION['comment_erased']);

				foreach($reportedComments as $com) {
					if(isset($com['report']))
					{
					?>
					<div class="col-sm-12 col-md-4 p-5">
						<p>
							<strong><?=htmlspecialchars($com['author'])?></strong> le <?=htmlspecialchars($com['comment_date_fr'])?> </br><?=htmlspecialchars($com['comment'])?>
						</p>

						<?php
						}
						if(!empty($_SESSION))
						{
						?>
							<a href="index.php?action=eraseComment&id=<?=$com['id']; ?>"><input type="button" class="btn btn-danger mb-5" value="Supprimer"></a>
						<?php
						}
						?>
					</div>
				<?php
				}
				?>
			</div>
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