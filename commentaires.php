<?php include("new_pdo.php");

	// On récupère toutes les données du tableau avant de commencer l'HTML parce que je récupère le titre de l'article dans le title du head :$bil['titre']

	// On récupère les billets
	//Si la variable Get existe, je récupère l'id de l'article
	if (isset($_GET['billet'])){
		$id_billet = (int) $_GET['billet'];
		$req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets WHERE id = ?');
		// ?? Pourquoi a-t-on besoin de faire un execute sur la variable req ?
		$req->execute([$id_billet]);

		$billet = $req->fetchAll(PDO::FETCH_ASSOC);
		if (empty($billet)){
			echo '<h2>Ce billet n\'existe pas.</h2>';
		} else {
			foreach($billet as $billet_donnees);
		}
		
	};
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, inital-scale=1.0"/>
  	<link rel="stylesheet" type="text/css" href="blog_tp_p4.css"/>
	<title>Commentaires <?=htmlspecialchars($billet_donnees['titre']); ?></title>
</head>
<body>
	<h1>Mon Super Blog !</h1>
	<a href="index.php">Retour à la liste des billets</a>

	<section class="news">
		<h3><?=htmlspecialchars($billet_donnees['titre'])?></h3>
		<h3><?=htmlspecialchars($billet_donnees['contenu'])?></h3>

		<h2><strong>Commentaires</strong></h2>

		<?php
		// On récupère les commentaires grâce à $id_billet
		$req_commentaires = $bdd->prepare("SELECT id, id_billet, auteur, commentaire, DATE_FORMAT(date_commentaire, '%d/%m/%Y à %Hh%imin%ss') AS date_commentaire_fr FROM commentaires WHERE id_billet = '$id_billet' ");
		$req_commentaires->execute([$id_billet]);

		$commentaires = $req_commentaires->fetchAll(PDO::FETCH_ASSOC);
		foreach($commentaires as $com) {
		?>
			<p><strong><?=htmlspecialchars($com['auteur'])?></strong>le<?=htmlspecialchars($com['date_commentaire_fr'])?></br><?=htmlspecialchars($com['commentaire'])?>
			</p>
		
		<?php
		}
		?>


		<h2>Laissez un commentaire :</h2>
		<form action="commentaires_post.php?billet=<?=$id_billet; ?>" method="post">
		<p>
			<label>Nom : <input type="text" name="auteur"></label> </br>
			<label>Commentaire : <input type="text" name="commentaire"></label>
		</p>
		<input type="submit" value="Valider">
	</form>

</body>
</html>