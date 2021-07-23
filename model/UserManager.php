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