<?php

require_once('model/CommentManager.php');
function addComment($postId, $author, $comment)
{
	$commentManager = new CommentManager();
	$affectedLines = $commentManager->postComment($postId, $author, $comment);

	if ($affectedLines === false)
	{
		throw new Exception('Impossible d\'ajouter le commentaire !');
	}
	else {
		header('Location: index.php?action=post&id=' . $postId);
	}

	require('view/commentsView.php');
}

function reportComment($commentId, $pseudo)
{
	$commentManager = new CommentManager();
	$reportComment = $commentManager->reportComment($commentId, $pseudo);

	if ($reportComment === false)
	{
		throw new Exception('Impossible de signaler le commentaire !');
	}
	else {
		header('Location: index.php?action=post&id=' . $_GET[id]);
	}
}

function reportedComment()
{
	$commentManager = new CommentManager();
	$reportedComments = $commentManager->reportedComments();

	require('view/reportedCommentsView.php');
}

function eraseComment($commentId)
{
	$commentManager = new CommentManager();
	$eraseComment = $commentManager->eraseComment($commentId);

	if ($eraseComment === false)
	{
		throw new Exception('Impossible de supprimer le commentaire.');
	}
	else {
		header('Location: index.php?action=reportedComments');
	}
}
