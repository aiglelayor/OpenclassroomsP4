<?php
session_start();
require("new_pdo.php");

if(isset($_POST['formconnection']))
{
	$pseudoconnect = htmlspecialchars($_POST['pseudoconnect']);
	$passconnect = sha1($_POST['passconnect']);
	if(!empty($pseudoconnect) AND !empty($passconnect))
	{
		$requeteuser = $bdd->prepare("SELECT * FROM membres WHERE pseudo = ? AND pass = ?");
		
		// On ajoute les champs qui correspondent à la requête dans un tableau.
		$requeteuser->execute(array($pseudoconnect, $passconnect));
		$userexist = $requeteuser->rowCount();
				var_dump($userexist);
		if($userexist == 1)
		{
			$userinfo = $requeteuser->fetch();
			$_SESSION['id'] = $userinfo['id'];
			$_SESSION['pseudo'] = $userinfo['pseudo'];
			$_SESSION['email'] = $userinfo['email'];

			header('Location: index.php?id='.$_SESSION['id']);
		}
		else
		{
			$erreur = "Il y a une erreur dans votre pseudo ou mot de passe.";
		}

	}
	else
	{
		$erreur = "Tous les champs doivent être complétés.";
	}
}

?>



<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Connexion</title>
</head>
<body>
	<div>
		<h1>Connexion</h1>
		<form method="post">
			<input type="text" name="pseudoconnect" placeholder="Pseudo"/>
			<input type="password" name="passconnect" placeholder="Mot de passe">
			<input type="submit" name="formconnection" value="Se connecter">
		</form>
		<?php
		if(isset($erreur))
		{
			echo $erreur;
		}
		?>
	</div>
	
</body>
</html>
