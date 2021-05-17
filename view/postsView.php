<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, inital-scale=1.0"/>
  		<link rel="stylesheet" type="text/css" href="public/css/style.css"/>
		<title>Blog TP P4</title>
	</head>
	<body>
	    <h1>Mon Super Blog !</h1>
		<p>Derniers Billets du blog :</p>
		<a href="new_member.php"> <input type="button" value="Créer compte"></a>

		<?php

		if(empty($_SESSION['id']))
		{
		?>
			<a href="index.php?action=login"> <input type="button" value="Se connecter" target></a>
		<?php 
		}

		if(!empty($_SESSION['id']))
		{
		?>
			<a href="logout.php"> <input type="button" value="Se déconnecter"></a>

			<section>
		    	<h3>Bienvenue <?=htmlspecialchars($_SESSION['pseudo']) ?></h3>
			</section>
		<?php
		}

		while ($data = $posts->fetch())
		{
		?>
		<section class="news">
		    <h3>
			    <?=htmlspecialchars($data['title']) . ' ' . htmlspecialchars($data['date_creation_fr']); ?>
			</h3>

			<p>
			    <?=htmlspecialchars($data['content']); ?>
			</p>

			<a href="index.php?action=post&id=<?=$data['id']; ?>"><input type="button" value="Commentaires"></a>

			<?php 
			if(!empty($_SESSION['id']) & $_SESSION['isAdmin'] === true)
			{
			?>
				<a href="edit_post.php?id=<?=$data['id']; ?>"> <input type="button" value="Modifier"></a>

				<a href="delete_post_post.php?id=<?=$data['id'];?>"> <input type="button" value="Supprimer"></a>
			<?php
			}
			?>
		</section>

		<?php
		}
		$posts->closeCursor();

		if(!empty($_SESSION['id']))
		{
		?>
			<a id="bouton_new_post" href="new_post.php"> <input type="button" value="Rédiger un nouvel article"></a>
		<?php 
		}
		?>
	</body>
</html>
