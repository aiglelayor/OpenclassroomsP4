<?php

require_once('model/CommentManager.php');

function addComment($postId, $author, $comment)
{
	$commentManager = new \Saralb\Blog\Model\CommentManager();
	$affectedLines = $commentManager->postComment($postId, $author, $comment);

	if ($affectedLines === false)
	{
		throw new Exception('Impossible d\'ajouter le commentaire !');
	}
	else {
		header('Location: index.php?action=post&id=' . $postId);
	}
}









	// $post = [];
	// // Effectuer ici la requête qui insère le message
	// if (isset($_POST['comment']))
	// {

	// 	foreach ($_POST as $key => $value) {
	// 	// Nettoyer les données
	// 		$post[$key] = htmlspecialchars($value);
	// 		// Récupérer de $_POST dans tableau $post
	// 	}
	// 	$id_post = (int) $_GET['post'];
	// 	$query = $db->prepare('INSERT INTO comments(id_post, author, comment) VALUES(:id_post, :author, :comment)');
	// 	$query->bindValue(':id_post', $id_post);
	// 	$query->bindValue(':author', $_SESSION['pseudo']);
	// 	$query->bindValue(':comment', $post['comment']);

	// 	if($query->execute())
	// 	{
	// 		header('Location: comments.php?id='.$id_post);
	// 	} else {
	// 	var_dump($_POST);
	// 	}
	// };
