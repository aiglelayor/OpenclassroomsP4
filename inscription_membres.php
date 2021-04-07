<?php require("new_pdo.php");

	// Putting $_POST keys in a array
	$post = [];
	// Array showing eventual errors
	$errors = [];

	$showErrors = false;
	$success = false;
	$pseudo = '';
	$email = '';
	
	if (!empty($_POST['forminscription']))
	{

		$pseudo = htmlspecialchars($_POST['pseudo']);
		$email= htmlspecialchars($_POST['email']);

		// foreach ($_POST as $key => $value) {
		// // Clean data
		// 	$post[$key] = htmlspecialchars($value);
		// 	// Récupérer de $_POST dans tableau $post. Les données sont passées par htmlspecialchars.
		//}
		if(!preg_match("#^[a-zA-Z0-9À-ú\.:\?\&',\s-]{3,25}#", $pseudo))
		{
			$errors[] = '<div>Votre pseudo doit comporter entre 2 et 25 caractères.</div>';
		}else {
			//Vérifier si le pseudo existe en bdd
			$requetePseudo = $bdd->prepare('SELECT pseudo FROM membres WHERE pseudo = :pseudo');
			$requetePseudo->bindValue(':pseudo', $pseudo);
			$requetePseudo->execute();

			if($requetePseudo->rowCount() != 0)
			{
				$errors[] = '<div>Désolé, ce pseudo existe déjà, veuillez choisir un autre.</div>';
			}
		}

		//Vérifier le mdp
		if(empty($_POST['pass']))
		{
			$errors[] = '<div>Veuillez saisir un mot de passe.</div>';
		}elseif($_POST['pass'] != $_POST['pass_confirm'])
		{
			$errors[] = '<div>Les deux mots de passe ne sont pas identiques.</div>';
		}

		if(!preg_match("#^[a-zA-Z0-9À-ú\.:\?\&',\s-]{3,25}#", $email))
		{
			$errors []= '<div>Veuillez saisir votre mail.</div>';;
		}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$errors[] = '<div>L\'adresse mail est invalide.</div>';
		}else{
			// Vérifier si le mail existe en bdd
			$requeteEmail = $bdd->prepare('SELECT email FROM membres WHERE email = :email');
			$requeteEmail->bindValue(':email', $email);
			$requeteEmail->execute();

			if($requeteEmail->rowCount() != 0)
			{
				$errors[] = 'Cet email existe déjà. Il se peut que vous ayez déjà créé un compte.';
			}
		}

		if(count($errors) > 0)
		{
			$showErrors = true;
			$pseudo = $pseudo;
			$email = $email;
		}else {
			//On sécurise le password en le hashant
			//Important : On ne stocke jamais un password en clair en pdo
			//$options = array("cost"=>4);
			$pass = sha1($_POST['pass']);
	
			$requete = $bdd->prepare('INSERT INTO membres(pseudo, pass, email, date_inscription) VALUES(:pseudo, :pass, :email, CURDATE())');
			$requete->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
			$requete->bindValue(':email', $email, PDO::PARAM_STR);
			$requete->bindValue(':pass', $pass, PDO::PARAM_STR);

			// Redirection
			if($requete->execute())
			{
				$_SESSION['comptecree'] = "Votre compte a bien été créé ! Bienvenue !";
				header('Location: index.php');
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
	<title>Inscription</title>
</head>
<body>
	<div align="center">
		<h1>Inscription</h1>
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
						<label for="pseudo">Pseudo :
					</td>
					<td>
						<input type="text" name="pseudo" id="pseudo" placeholder="Votre pseudo" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>">
					</td>
				</tr>
				<tr>
					<td>
						<label for="email">Mail :</label>
					</td>
					<td>
						<input type="email" name="email" id="email" placeholder="Votre mail" value="<?php if(isset($email)) { echo $email; } ?>">
					</td>
				</tr>
				<tr>
					<td>
						<label for="pass">Mot de Passe :</label>
					</td>
					<td>
						<input type="password" name="pass" id="pass" placeholder="Votre mot de passe">
					</td>
				</tr>
				<tr>
					<td>
						<label for="pass_confirm">Confirmation du mot de passe :</label>
					</td>
					<td>
						<input type="password" name="pass_confirm" id="pass_confirm" placeholder="Votre mot de passe">
					</td>					
				</tr>
				<tr>
					<td></td>
					<td id="bouton_submit">
						<input type="submit" name="forminscription" value="S'inscrire"></input>
					</td>
				</tr>	
			</table>
		</form>
	</div>
</body>
</html>