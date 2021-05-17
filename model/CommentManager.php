<?php

//namespace Saralb\Blog\Model; // La classe sera dans ce namespace.

require_once('Model/DbConnectManager.php');

class CommentManager extends DbConnectManager
{
	function getComments($postId)
	{
		$db = $this->dbConnect();
		$id_post = (int) $_GET['id'];
		$req = $db->prepare("SELECT id, id_post, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS comment_date_fr FROM comments WHERE id_post = '$id_post' ");
		$req->execute([$id_post]);
		$comments = $req->fetchAll(PDO::FETCH_ASSOC);

		return $comments;
	}

	function postComment($postId, $author, $comment)
	{
		$db = $this->dbConnect();
		$id_post = (int) $postId;
		var_dump($id_post);
		var_dump($author);
		var_dump($comment);
		$req = $db->prepare('INSERT INTO comments(id_post, author, comment, comment_date) VALUES(:id_post, :author, :comment, NOW()');
		$req->bindValue(':id_post', $id_post);
		$req->bindValue(':author', $author);
		$req->bindValue(':comment', $comment);

		//$affectedLines = $req->execute();
		if($req->execute())
			{
				var_dump($id_post);
			}
		return $req;	
	}
}

