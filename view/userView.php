<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Connexion</title>
</head>
<body>
	<div>
		<h1>Connexion</h1>
		<form action="index.php?action=loginUser" method="post">
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
