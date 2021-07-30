<?php

require_once('Model/UserManager.php');

function userLogin($pseudoconnect, $passconnect)
{
	$userManager = new UserManager();

	$errors = [];
	$showErrors = false;
	$success = false;

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
	}
}

function userLogout()
{
	$userManager = new UserManager();
	$userLogout = $userManager->logout();
}

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

	// Verify pseudo
	if(!preg_match("#^[a-zA-Z0-9À-ú\.:\?\&',\s-]{3,25}#", $pseudo))
	{
		$errors[] = '<div>Votre pseudo doit contenir entre 2 et 25 caractères.</div>';
	}else {
		$userexists = $userManager->userExists($pseudo);

		if($userexists == 1)
		{
			$errors[] = '<div>Désolé, ce pseudo existe déjà, veuillez choisir un autre.</div>';
		}
	}

	// Verify pass
	if(empty($_POST['pass']))
	{
		$errors[] = '<div>Veuillez saisir un mot de passe.</div>';
	}
	elseif(!preg_match("#^[a-zA-Z0-9À-ú\.:\?\&',\s-]{5,25}#", $pass))
	{
		$errors[] = '<div>Votre mot de passe doit contenir entre 5 et 25 caractères.</div>';
	}
	elseif ($_POST['pass'] != $_POST['pass_confirm'])
	{
		$errors[] = '<div>Les deux mots de passe ne sont pas identiques.</div>';
	}

	// Verify email
	if(!preg_match("#^[a-zA-Z0-9À-ú\.:\?\&',\s-]{3,25}#", $email))
	{
		$errors []= '<div>Veuillez saisir votre mail.</div>';;
	}
	elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		$errors[] = '<div>L\'adresse mail est invalide.</div>';
	}else {
		// Verify if email exists in db
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
	}else {
		$createUser = $userManager->createUser($pseudo, $email, $pass);
		require('view/userCreatedView.php');
	}

}