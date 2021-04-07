<?php
session_start();
include("new_pdo.php");
?>



<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, inital-scale=1.0"/>
  		<link rel="stylesheet" type="text/css" href="blog_tp_p4.css"/>
		<title>Blog TP P4</title>
	</head>
	<body>
		<h1>Mon Super Blog !</h1>
		<p>Derniers Billets du blog :</p>
		<a href="inscription_membres.php" target="_blank"> <input type="button" value="Créer compte"></a>
		<a href="connexion.php" target="_blank"> <input type="button" value="Se connecter"></a>
		<a href="deconnexion.php" target="_blank"> <input type="button" value="Se déconnecter"></a>
		<?php

		if(isset($_GET['id']) AND $_GET['id'] > 0 AND isset($_SESSION['id']) AND $_GET['id'] == $_SESSION['id'])
		{
			$getid = intval($_GET['id']);
			$requeteuser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
			$requeteuser->execute(array($getid));
			$userinfo = $requeteuser->fetch();
		?>
		<section>
			<h3>Bienvenue <?=htmlspecialchars($userinfo['pseudo']) ?></h3>
		</section>

		<?php
		}
		//Récupère les 5 derniers billets
		$reponse = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d%m%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets ORDER BY ID DESC LIMIT 5');
				while ($donnees = $reponse->fetch())
				{
		?>
		<section class="news">
					<h3><?=htmlspecialchars($donnees['titre']) . ' ' . htmlspecialchars($donnees['date_creation_fr']); ?>
					</h3>

					<p>
						<?=htmlspecialchars($donnees['contenu']); ?>
					</p>
					<a href="commentaires.php?billet=<?=$donnees['id']; ?>">Commentaires</a>
		</section>
		<?php	}
		$reponse->closeCursor();
		if(isset($_GET['id']) AND $_GET['id'] > 0 AND isset($_SESSION['id']) AND $_GET['id'] == $_SESSION['id'])
		{
		?>
		<a id="bouton_creer_article" href="creer_article.php" target="_blank"> <input type="button" value="Rédiger un article"></a>
		<?php 
		}?>
	</body>
</html>
