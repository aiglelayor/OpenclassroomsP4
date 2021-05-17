<?php

require_once('Model/DbConnectManager.php');

class UserManager extends DbConnectManager
{
	public function login($pseudoconnect, $passconnect)
	{
		$db = $this->dbConnect();
		$requser = $db->prepare("SELECT * FROM members WHERE pseudo = ?");
	
		// On ajoute les champs qui correspondent à la requête dans un tableau.
		$requser->execute(array($pseudoconnect));

		$userexist = $requser->rowCount();
		if($userexist == 1)
		{
			$userinfo = $requser->fetch();
			$password_match = password_verify($passconnect, $userinfo['pass']);

			if($password_match)
			{
				$_SESSION['id'] = $userinfo['id'];
				$_SESSION['isAdmin'] = $userinfo['isAdmin'];
				$_SESSION['pseudo'] = $userinfo['pseudo'];
				$_SESSION['email'] = $userinfo['email'];
				//header('Location: postsManager.php');	
			}
			
		}
		else
		{
			throw new Exception("Il y a une erreur dans votre pseudo ou mot de passe.");
		}	
	}

	//Ajouter au routeur
	public function logout()
	{
		$_SESSION = array();
		session_destroy();
		header("Location: index.php");
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