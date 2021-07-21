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

			if(!empty($pseudoconnect) AND !empty($passconnect))
			{
				userLogin($pseudoconnect, $passconnect);
			}
			else {
				throw new Exception("Tous les champs doivent être complétés.", 1);
			}
			
		}
		elseif($_GET['action'] == 'userLogout')
		{
			userLogout();
		}
		elseif($_GET['action'] == 'formCreateUser')
		{
			require('view/createUserView.php');
		}
		elseif($_GET['action'] == 'createUser')
		{
			// Putting $_POST keys in a array
			if (!empty($_POST['forminscription']))
			{
				
				createUser($_POST['pseudo'], $_POST['email'], $_POST['pass']);

			}
			else {
				throw new Exception("Utilsateur non créé.", 1);
				
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
					$content = htmlspecialchars($_POST['content']);
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
			if(!empty($_POST['formnewpost']))
			{
				$title = htmlspecialchars($_POST['title']);
				$content = htmlspecialchars($_POST['content']);
			 	savePost($title, $content);
			}
		}
		elseif($_GET['action'] == 'reportComment')
		{
			if(!empty($_SESSION) && isset($_GET['id']) && $_GET['id'] > 0)
			{
				$commentId = htmlspecialchars($_GET['id']);
				$pseudo = htmlspecialchars($_SESSION['pseudo']);
				reportComment($commentId, $pseudo);
			}
			else {
				throw new Exception("Aucun identifiant de commentaire envoyé.", 1);
				
			}
		}
		elseif($_GET['action'] == 'reportedComments')
		{
			var_dump('here');
			if(!empty($_SESSION['isAdmin']))
			{
				reportedComment();
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
