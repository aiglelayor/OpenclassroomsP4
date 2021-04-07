<?php include("new_pdo.php");

	$post = [];
	// Effectuer ici la requête qui insère le message
	if (isset($_POST['auteur']) AND isset($_POST['commentaire']))
	{

		foreach ($_POST as $key => $value) {
		// Nettoyer les données
			$post[$key] = htmlspecialchars($value);
			// Récupérer de $_POST dans tableau $post
		}
		$id_billet = (int) $_GET['billet'];
		$requete = $bdd->prepare('INSERT INTO commentaires(id_billet, auteur, commentaire) VALUES(:id_billet, :auteur, :commentaire)');
		$requete->bindValue(':id_billet', $id_billet);
		$requete->bindValue(':auteur', $post['auteur']);
		$requete->bindValue(':commentaire', $post['commentaire']);

		if($requete->execute())
		{
			header('Location: commentaires.php?billet=<?=$id_billet; ?>');
		// } else {
		// 	var_dump($_POST);
		}
	};

	// Puis rediriger vers commentaires.php comme ceci :
	
	?>
