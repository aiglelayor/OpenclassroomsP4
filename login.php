<?php require("new_pdo.php");

// Mettre $_POST keys dans un array
$post = [];

// Array contenant les éventuelles erreurs
$errors = [];

$showErrors = false;
$pseudo = '';
$pass = ''

if (!empty($_POST))
{
	foreach ($_POST as $key => $value) {
		// Nettoyer les données
		$post[$key] = htmlspecialchars($value);
		// Récupérer $_POST dans le tableau $post
	}
	if(!preg_match("#^[a-zA-Z0-9À-ú\.:\?\&',\s]{1}#", $post['pseudo']))
	{
		$errors[] = '<div>Oups, certains champs ne sont pas remplis.</div>';
	}elseif (!preg_match("#^[a-zA-Z0-9À-ú\.:\?\&',\s]{1}#", $post['pass'])){

	}
}

?>


<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Connection</title>
</head>
<body>
	<h1>Connection</h1>
	<form action="login_post.php" method="post">
		<div>
			<label for="pseudo">Pseudo :<input type="text" name="pseudo" id="pseudo" required></label>
			</br>
			<label for="pass">Mot de Passe :<input type="text" name="pass" id="pass" required></label>
			</br>
			<div>
				<label for="connexion_automatique">Connexion automatique</label>
				<input type="checkbox" name="connexion_automatique" id="connexion_automatique">
			</div>
			</br>
			<input type="submit" value="Se connecter">
			
		</div>	
	</form>
</body>
</html>