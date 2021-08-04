<?php

require_once('model/DbConnectManager.php');

class UserManager
{
	private $dbConnectManage;

	function __construct()
	{
	  $this->dbConnectManage = new DbConnectManager();
	}

	public function userInfo($pseudoconnect, $passconnect)
	{
		$db = $this->dbConnectManage->dbConnect();
		$requser = $db->prepare("SELECT * FROM members WHERE pseudo = ?");
		// On ajoute les champs qui correspondent à la requête dans un tableau.
		$requser->execute(array($pseudoconnect));
		$userinfo = $requser->fetch();

		return $userinfo;

		$this->dbConnectManage->dbDisconnect();
	}

	public function logout()
	{
		$_SESSION = array();
		session_destroy();
		header("Location: index.php");
	}

	public function userExists($pseudo)
	{
		$db = $this->dbConnectManage->dbConnect();

		$requser = $db->prepare("SELECT * FROM members WHERE pseudo = ?");
		$requser->execute(array($pseudo));
		$userexists = $requser->rowCount();

		return $userexists;

		$this->dbConnectManage->dbDisconnect();
	}

	public function emailExists($email)
	{
		$db = $this->dbConnectManage->dbConnect();

		$reqemail = $db->prepare("SELECT * FROM members WHERE email = ?");
		$reqemail->execute(array($email));
		$mailexists = $reqemail->rowCount();

		return $mailexists;

		$this->dbConnectManage->dbDisconnect();
	}

	public function createUser($pseudo, $email, $pass)
	{
		$db = $this->dbConnectManage->dbConnect();

		$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
		$req = $db->prepare('INSERT INTO members(pseudo, pass, email, subscription_date) VALUES(:pseudo, :pass, :email, CURDATE())');
		$req->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
		$req->bindValue(':email', $email, PDO::PARAM_STR);
		$req->bindValue(':pass', $pass, PDO::PARAM_STR);

		if($req->execute())
		{
			$_SESSION['new_user'] = "Votre compte a bien a été créé !";
		}
		$this->dbConnectManage->dbDisconnect();
	}
}