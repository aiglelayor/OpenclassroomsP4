<?php
session_start();
require("new_pdo.php");

	// Putting $_POST keys in a array
	$post = [];
	// Array showing eventual errors
	$errors = [];

	$showErrors = false;
	$success = false;
	$titre = '';
	$contenu = '';
	
	if (!empty($_POST['forminscription']))
	{

		$titre = htmlspecialchars($_POST['titre_nouvel_article']);
		$contenu= htmlspecialchars($_POST['contenu_nouvel_article']);

		// foreach ($_POST as $key => $value) {
		// // Clean data
		// 	$post[$key] = htmlspecialchars($value);
		// 	// Récupérer de $_POST dans tableau $post. Les données sont passées par htmlspecialchars.
		//}
		if(!preg_match("#^[a-zA-Z0-9À-ú\.:\?\&',\s-]{3,100}#", $titre))
		{
			$errors[] = '<div>Votre titre est trop long.</div>';
		}else {
			//Vérifier si le pseudo existe en bdd
			$requeteTitre = $bdd->prepare('SELECT titre FROM billets WHERE titre = :titre');
			$requeteTitre->bindValue(':titre', $titre);
			$requeteTitre->execute();

			if($requeteTitre->rowCount() != 0)
			{
				$errors[] = '<div>Désolé, ce titre existe déjà, veuillez en choisir un autre.</div>';
			}
		}

		//Vérifications contenu
		if(!preg_match("#^[a-zA-Z0-9À-ú\.:\?\&',\s-]{10,1000}#", $contenu))
		{
			$errors []= '<div>Votre article est soit trop court, soit trop long.</div>';
		}

		if(count($errors) > 0)
		{
			$showErrors = true;
			$titre = $titre;
			$contenu = $contenu;
		}else {
			
			$requete = $bdd->prepare('INSERT INTO billets(membre_id, titre, contenu, date_creation) VALUES(:membre_id, :titre, :contenu, CURDATE())');
			$requete->bindValue(':membre_id', $_SESSION['id'], PDO::PARAM_STR);
			$requete->bindValue(':titre', $titre, PDO::PARAM_STR);
			$requete->bindValue(':contenu', $contenu, PDO::PARAM_STR);

			// Redirection
			if($requete->execute())
			{
				$_SESSION['article_cree'] = "Votre article a bien a été créé !";
				header('Location: index.php?id='.$_SESSION['id']);
			} else {
				$showErrors = true;
				die(var_dump($requete->errorInfo()));

			}
		}
}
?>



<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Rédiger un article</title>
</head>
<body>
	<div align="center">
		<h1>Rédiger un article</h1>
		<?php if($showErrors == true){ ?>
			<div>
				<p>Certains champs requièrent votre attention.</p>
				<ol>
					<?php foreach ($errors as $kerrors) { ?>
					<li><?=$kerrors;?></li>
					<?php } ?>	
				</ol>
			</div>
		<?php } ?>	
		<form method="post" action="">
			<table>
				<tr>
					<td>
						<label for="titre_nouvel_article">Titre :
					</td>
					<td>
						<input type="text" name="titre_nouvel_article" id="titretitre_nouvel_article" placeholder="Titre de votre article" value="<?php if(isset($titre)) { echo $titre; } ?>" required>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<textarea name="contenu_nouvel_article" placeholder="Redigez votre article..." rows="10" value="<?php if(isset($contenu)) { echo $contenu; } ?>" required></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td id="bouton_submit">
						<input type="submit" name="forminscription" value="Publier l'article"></input>
					</td>
				</tr>	
			</table>
		</form>
	</div>
</body>
</html>