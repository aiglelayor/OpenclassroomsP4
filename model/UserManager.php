<?php

require_once('Model/DbConnectManager.php');

class UserManager extends DbConnectManager
{
	public function userInfo($pseudoconnect, $passconnect)
	{
		$db = $this->dbConnect();
		$requser = $db->prepare("SELECT * FROM members WHERE pseudo = ?");
	
		// On ajoute les champs qui correspondent à la requête dans un tableau.
		$requser->execute(array($pseudoconnect));

		$userinfo = $requser->fetch();

		return $userinfo;

		// $userexists = $requser->rowCount();
		// if($userexists == 1)
		// {
		// 	$userinfo = $requser->fetch();
		// 	$password_match = password_verify($passconnect, $userinfo['pass']);

		// 	if($password_match)
		// 	{
		// 		$_SESSION['id'] = $userinfo['id'];
		// 		$_SESSION['isAdmin'] = $userinfo['isAdmin'];
		// 		$_SESSION['pseudo'] = $userinfo['pseudo'];
		// 		$_SESSION['email'] = $userinfo['email'];
		// 		//header('Location: postsManager.php');	
		// 	}
			
		// }
		// else
		// {
		// 	throw new Exception("Il y a une erreur dans votre pseudo ou mot de passe.");
		// }	
	}

	public function logout()
	{
		$_SESSION = array();
		session_destroy();
		header("Location: index.php");
	}

	public function userExists($pseudo)
	{
		$db = $this->dbConnect();
		$requser = $db->prepare("SELECT * FROM members WHERE pseudo = ?");
	
		// On ajoute les champs qui correspondent à la requête dans un tableau.
		$requser->execute(array($pseudo));

		$userexists = $requser->rowCount();

		return $userexists;
	}

	public function emailExists($email)
	{
		$db = $this->dbConnect();
		$reqemail = $db->prepare("SELECT * FROM members WHERE email = ?");
	
		// On ajoute les champs qui correspondent à la requête dans un tableau.
		$reqemail->execute(array($email));

		$mailexists = $reqemail->rowCount();

		return $mailexists;		
	}

	public function createUser($pseudo, $email, $pass)
	{
		$db = $this->dbConnect();
		$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
		$req = $db->prepare('INSERT INTO members(pseudo, pass, email, subscription_date) VALUES(:pseudo, :pass, :email, CURDATE())');
		$req->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
		$req->bindValue(':email', $email, PDO::PARAM_STR);
		$req->bindValue(':pass', $pass, PDO::PARAM_STR);

		if($req->execute())
		{
			$_SESSION['new_account_created'] = "Votre compte a bien été créé ! Bienvenue !";
		}
	}
}


// function login()
// {
// 	$db = dbConnect();
// 	$pseudoconnect = htmlspecialchars($_POST['pseudoconnect']);
// 	$passconnect = $_POST['passconnect'];

// 	if(!empty($pseudoconnect) AND !empty($passconnect))
// 	{
// 		$requser = $db->prepare("SELECT * FROM members WHERE pseudo = ?");
	
// 		// On ajoute les champs qui correspondent à la requête dans un tableau.
// 		$requser->execute(array($pseudoconnect));

// 		$userexist = $requser->rowCount();
// 			var_dump('verification');
// 		if($userexist == 1)
// 		{
// 			$userinfo = $requser->fetch();
// 			$password_match = password_verify($passconnect, $userinfo['pass']);

// 			if($password_match)
// 			{
// 				$_SESSION['id'] = $userinfo['id'];
// 				$_SESSION['pseudo'] = $userinfo['pseudo'];
// 				$_SESSION['email'] = $userinfo['email'];
// 				header('Location: postsManager.php');	
// 			}
			
// 		}
// 		else
// 		{
// 			$erreur = "Il y a une erreur dans votre pseudo ou mot de passe.";
// 		}

// 	}
// 	else
// 	{
// 		$erreur = "Tous les champs doivent être complétés.";
// 	}

// 	return $erreur;
// }
