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


