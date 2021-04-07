<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Créer un compte</title>
</head>
<body>
	<h1>Créer un compte</h1>
	<form action="inscription_membres_post.php" method="post">
		<div>
			<label for="pseudo">Pseudo :<input type="text" name="pseudo" id="pseudo" required></label>
			</br>
			<label for="pass">Mot de Passe :<input type="text" name="pass" id="pass" required></label>
			</br>
			<label for="pass_confirm">Confirmez le mot de passe :<input type="text" name="pass_confirm" id="pass_confirm" required></label>
			</br>
			<label for="email">Mail :<input type="text" name="mail" id="email" required></label>
			</br>
			<input type="submit" value="Valider"></input>
		</div>	
	</form>
</body>
</html>