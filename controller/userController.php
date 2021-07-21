<?php

require_once('Model/UserManager.php');

function userLogin($pseudoconnect, $passconnect)
{
	$userManager = new UserManager();

	$errors = [];
	$showErrors = false;
	$success = false;
	//$pseudoconnect = '';

	$userexists = $userManager->userExists($pseudoconnect);

	if($userexists == 1)
	{
		$userinfo = $userManager->userInfo($pseudoconnect, $passconnect);

		$password_match = password_verify($passconnect, $userinfo['pass']);

		if($password_match)
			{
				$_SESSION['id'] = $userinfo['id'];
				$_SESSION['isAdmin'] = $userinfo['isAdmin'];
				$_SESSION['pseudo'] = $userinfo['pseudo'];
				$_SESSION['email'] = $userinfo['email'];

				require('view/userConnectedView.php');
			}
	}
	else
	{
		$errors[] = 'Il y a une erreur dans votre pseudo ou dans mot de passe.';
		$showErrors = true;
		$pseudoconnect = $pseudoconnect;
		require('view/userView.php');
		//die(var_dump($requete->errorInfo()));
	}

	//$userLogin = $userManager->login($pseudoconnect, $passconnect);
}

function userLogout()
{
	$userManager = new UserManager();
	$userLogout = $userManager->logout();

	//require('view/userDisconnectedView.php');
}

// function userExists($pseudo)
// {
// 	$userManager = new UserManager();
// 	$userExists = $userManager->userExists($pseudo);

// 	if($reqPseudo->rowCount() != 0)
// 	{
// 		$errors[] = '<div>Désolé, ce pseudo existe déjà, veuillez choisir un autre.</div>';
// 	}
// }

// function emailExists($email)
// {
// 	$userManager = new UserManager();
// 	$emailExists = $userManager->emailExists();
// }

function createUser($pseudo, $email, $pass)
{
	$userManager = new UserManager();

	$post = [];
	// Array showing eventual errors
	$errors = [];

	$showErrors = false;
	$success = false;
	$pseudo = '';
	$email = '';

	$pseudo = htmlspecialchars($_POST['pseudo']);
	$email= htmlspecialchars($_POST['email']);

	// verify pseudo
	if(!preg_match("#^[a-zA-Z0-9À-ú\.:\?\&',\s-]{3,25}#", $pseudo))
	{
		$errors[] = '<div>Votre pseudo doit comporter entre 2 et 25 caractères.</div>';
	}else {
		$userexists = $userManager->userExists($pseudo);

		if($userexists == 1)
		{
			$errors[] = '<div>Désolé, ce pseudo existe déjà, veuillez choisir un autre.</div>';
		}
	}

	// verify pass
	if(empty($_POST['pass']))
	{
		$errors[] = '<div>Veuillez saisir un mot de passe.</div>';
	}
	elseif($_POST['pass'] != $_POST['pass_confirm'])
	{
		$errors[] = '<div>Les deux mots de passe ne sont pas identiques.</div>';
	}

	// verify email
	if(!preg_match("#^[a-zA-Z0-9À-ú\.:\?\&',\s-]{3,25}#", $email))
	{
		$errors []= '<div>Veuillez saisir votre mail.</div>';;
	}
	elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		$errors[] = '<div>L\'adresse mail est invalide.</div>';
	}else {
		// Vérifier si le mail existe en bdd
		$emailexists = $userManager->emailExists($email);

		if($emailexists == 1)
		{
			$errors[] = 'Cet email existe déjà. Il se peut que vous ayez déjà créé un compte.';
		}
	}

	if(count($errors) > 0)
	{
		$showErrors = true;
		$pseudo = $pseudo;
		$email = $email;
		require('view/createUserView.php');
		//die(var_dump($requete->errorInfo()));
	}else {
		$createUser = $userManager->createUser($pseudo, $email, $pass);
		require('view/userCreatedView.php');
	}

}



