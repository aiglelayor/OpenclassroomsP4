<?php

session_start();

//require('controller/dbConnectController.php');

require('controller/postsController.php');

require('controller/commentsController.php');

require('controller/userController.php');

try {
	if(isset($_GET['action'])) {
		if($_GET['action'] == 'listPosts') {
			listPosts();
		}
		elseif($_GET['action'] == 'post') {
			if(isset($_GET['id']) && $_GET['id'] > 0) {
				post();
			}
			else {
				throw new Exception("Aucun identifiant d\'article envoyé.", 1);
				
			}
		}
		elseif($_GET['action'] == 'addComment')
		{
			if(isset($_GET['id']) && $_GET['id'] > 0)
			{
				if(!empty($_POST['comment']) && !empty($_SESSION))
				{
					addComment($_GET['id'], $_SESSION['pseudo'], $_POST['comment']);
				}
				elseif(!empty($_POST['pseudo']) && !empty($_POST['comment']))
				{
					addcomment($_GET['id'], $_POST['pseudo'], $_POST['comment']);
				}
				else 
				{
					throw new Exception('Tous les champs ne sont pas remplis.', 1);
				}
			}
			else
			{
				throw new Exception('Aucun identifiant d\'article envoyé.', 1);
			}

		}
		elseif($_GET['action'] == 'login')
		{
			require('view/userView.php');
		}
		elseif($_GET['action'] == 'userLogin') {
			$pseudoconnect = htmlspecialchars($_POST['pseudoconnect']);
			$passconnect = $_POST['passconnect'];

			$errors = [];
			$showErrors = false;
			$success = false;

			if(!empty($pseudoconnect) AND !empty($passconnect))
			{
				userLogin($pseudoconnect, $passconnect);
			}
			else {
				$errors[] = 'Tous les champs doivent être complétés.';
				$showErrors = true;

				if(!empty($pseudoconnect)){
					$pseudoconnect = $pseudoconnect;
				}
				require('view/userView.php');
			}
			
		}
		elseif($_GET['action'] == 'userLogout')
		{
			userLogout();
		}
		elseif($_GET['action'] == 'formCreateUser')
		{
			if(!empty($_SESSION['id']))
			{
				$_SESSION['must_logout'] = "Attention ! Vous devez vous déconnecter avant de créer un autre compte.";
				header("Location: index.php");					
			}else{
				require('view/createUserView.php');
			}
		}
		elseif($_GET['action'] == 'createUser')
		{
			$pseudo = htmlspecialchars($_POST['pseudo']);
			$email = htmlspecialchars($_POST['email']);
			$pass = $_POST['pass'];

			// Putting $_POST keys in a array
			if (!empty($pseudo) AND !empty($pass) AND !empty($pass))
			{
				
				createUser($_POST['pseudo'], $_POST['email'], $_POST['pass']);

			}
			else {
				$errors[] = 'Tous les champs doivent être complétés.';
				$showErrors = true;

				if(!empty($pseudoconnect)){
					$pseudoconnect = $pseudoconnect;
					$email = $email;
				}
				require('view/createUserView.php');
			}
		}
		elseif($_GET['action'] == 'editPost')
		{
			if(isset($_GET['id']) && $_GET['id'] > 0) {
				editPost();
			}
			else {
				throw new Exception("Aucun identifiant d\'article envoyé.", 1);
				
			}
		}	
		elseif($_GET['action'] == 'savePost')
		{
			if(isset($_GET['id']) && $_GET['id'] > 0)
			{
				if(!empty($_POST['formeditpost']))
				{
					$title = htmlspecialchars($_POST['title']);
					$content = $_POST['content'];
				 	savePost($title, $content);
				}

			}
			else {
				throw new Exception("Aucun identifiant d\'article envoyé.", 1);
			}
		}
		elseif($_GET['action'] == 'deletePost')
		{
			if(isset($_GET['id']) && $_GET['id'] > 0)
			{
				$postId = htmlspecialchars($_GET['id']);
				deletePost($postId);
			}
			else {
				throw new Exception("Impossible d'effacer l'article.", 1);
			}
		}
		elseif($_GET['action'] == 'newPost')
		{
			require('view/newPostView.php');
		}
		elseif($_GET['action'] == 'saveNewPost')
		{
			var_dump($_POST);
			if(!empty($_POST['formnewpost']))
			{
				$title = htmlspecialchars($_POST['title']);
				$content = $_POST['content'];
			 	savePost($title, $content);
			}
		}
		elseif($_GET['action'] == 'reportComment')
		{
			if(!empty($_SESSION) && ($_GET['id']) && $_GET['comId'] > 0)
			{
				$commentId = htmlspecialchars($_GET['comId']);
				$pseudo = htmlspecialchars($_SESSION['pseudo']);
				reportComment($commentId, $pseudo);
			}
			else {
				throw new Exception("Aucun identifiant de commentaire envoyé.", 1);
				
			}
		}
		elseif($_GET['action'] == 'reportedComments')
		{
			if(!empty($_SESSION['isAdmin']))
			{
				reportedComment();
			}
		}
		elseif($_GET['action'] == 'eraseComment')
		{
			if(!empty($_SESSION['isAdmin']) && $_GET['id'] > 0)
			{
				$commentId = htmlspecialchars($_GET['id']);
				eraseComment($commentId);
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
