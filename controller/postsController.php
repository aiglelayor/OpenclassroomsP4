<?php

require_once('model/PostManager.php');

require_once('model/CommentManager.php');

function listPosts()
{
	$postManager = new PostManager(); // Création d'un objet
	$posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

	require('view/postsView.php');
}

function post()
{
	$postManager = new PostManager();
	$post = $postManager->getPost($_GET['id']);

	$commentManager = new CommentManager();
	$comments = $commentManager->getComments($_GET['id']);

	require('view/commentsView.php');
}

function editPost()
{
	$postManager = new PostManager();

	$showErrors = false;

	$post = $postManager->getPost($_GET['id']);


	if (empty($post)){
		echo '<h2>Cet article n\'existe pas.</h2>';
		die;
	} else {
		require('view/editPostView.php');
	}
}

function savePost($title, $content)
{
	$postManager = new PostManager();

	$errors = [];
	$showErrors = false;
	$success = false;
	$title = '';
	$content = '';

	$title = htmlspecialchars($_POST['title']);
	$content = htmlspecialchars($_POST['content']);

	if(!preg_match("#^[a-zA-Z0-9À-ú\.:\?\&',\s-]{3,51}#", $title))
	{
		$errors[] = '<div>Votre titre doit comporter entre 2 et 50 caractères.</div>';
	}else {
		$titleexists = $postManager->titleExists($title);

		if($titleexists == 1)
		{
			$errors[] = '<div>Désolé, ce titre existe déjà, veuillez choisir un autre.</div>';
		}
	}

	if(!preg_match("#^[a-zA-Z0-9À-ú\.:\?\&',\s-]{3,2001}#", $content))
	{
		$errors[] = '<div>Votre article doit comporter entre 2 et 2000 caractères.</div>';
	}

	// Verify pass
	if(count($errors) > 0)
	{
		$showErrors = true;
		$title = $title;
		$content = $content;
		if(isset($_GET['id']) && $_GET['id'] > 0)
		{
			require('view/editPostView.php');
		}else {
			require('view/newPostView.php');
		}
		
	}else
	{
		if(isset($_GET['id']) && $_GET['id'] > 0)
		{
			$postId = (int) $_GET['id'];

			$savePost = $postManager->savePost($postId, $title, $content);

			header('Location: index.php');
		}else {
			$saveNewPost = $postManager->saveNewPost($title, $content);

			header('Location: index.php');
		}

	}
}	

function deletePost($postId)
{
	$postManager = new PostManager();
	$deletePost = $postManager->deletePost($postId);

	header('Location: index.php');
}
