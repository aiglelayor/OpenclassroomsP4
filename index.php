<?php

session_start();

//require('controller/dbConnectController.php');

require('controller/postsController.php');

require('controller/commentsController.php');

require('controller/userController.php');

try {
	if (isset($_GET['action'])) {
		if ($_GET['action'] == 'listPosts') {
			listPosts();
		}
		elseif ($_GET['action'] == 'post') {
			if(isset($_GET['id']) && $_GET['id'] > 0) {
				post();
			}
			else {
				throw new Exception("Aucun identifiant d\'article envoyé.", 1);
				
			}
		}
		elseif ($_GET['action'] == 'addComment')
		{
			if(isset($_GET['id']) && $_GET['id'] > 0)
			{
				if(!empty($_POST['comment']))
				{
					addComment($_GET['id'], 'test', $_POST['comment']);
				}
				else 
				{
					throw new Esception("Tous les champs ne sont pas remplis.", 1);
				}
			}
			else
			{
				throw new Exception('Aucun identifiant d\'article envoyé.', 1);
			}

		}
		elseif ($_GET['action'] == 'login')
		{
			require('view/userView.php');
		}
		elseif ($_GET['action'] == 'loginUser') {
			$pseudoconnect = htmlspecialchars($_POST['pseudoconnect']);
			$passconnect = $_POST['passconnect'];

			if(!empty($pseudoconnect) AND !empty($passconnect))
			{
				userLogin($pseudoconnect, $passconnect);
			}
			else {
				throw new Exception("Tous les champs doivent être complétés.", 1);
				
			}
			
		}
	}
	else {
		listPosts();
	}
}
catch(Exception $e) {
	echo 'Erreur : ' . $e->getMessage(); 
	// à  faire plus tard :-) - require('View/errorView.php');
}