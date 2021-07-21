<?php

//namespace Saralb\Blog\Model; // La classe sera dans ce namespace.

require_once('Model/DbConnectManager.php');

class CommentManager extends DbConnectManager
{
	function getComments($postId)
	{
		$db = $this->dbConnect();
		$id_post = (int) $_GET['id'];
		$req = $db->prepare("SELECT id, id_post, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS comment_date_fr, report, report_author FROM comments WHERE id_post = '$id_post' ");
		$req->execute([$id_post]);
		$comments = $req->fetchAll(PDO::FETCH_ASSOC);

		return $comments;
	}

	function postComment($postId, $author, $comment)
	{
		$db = $this->dbConnect();
		//$id_post = (int) $postId;
		$req = $db->prepare('INSERT INTO comments(id_post, author, comment, comment_date) VALUES(:id_post, :author, :comment, NOW())');
		$req->bindValue(':id_post', $postId, PDO::PARAM_INT);
		$req->bindValue(':author', $author, PDO::PARAM_STR);
		$req->bindValue(':comment', $comment, PDO::PARAM_STR);
		//$req->bindValue('comment_date, :NOW(), PDO::PARAM_INT');
		$req->execute();
	}

	function reportComment($commentId, $pseudo)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('UPDATE comments SET report = ?, report_author = ? WHERE id = ?');
		$req_execute = $req->execute(array(
			1,
			$pseudo,
			$commentId
		));

		if($req->execute())
		{
			$_SESSION['comment_reported'] = "Le commentaire a été signalé. Merci de l'avoir fait, nous allons vérifier le contenu.";
		}
	}

	function reportedComments()
	{
		$db = $this->dbConnect();

		$req = $db->prepare("SELECT id, id_post, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS comment_date_fr, report, report_author FROM comments WHERE report = 1 ");
		$req->execute();
		$reportedComments = $req->fetchAll(PDO::FETCH_ASSOC);

		return $reportedComments;

	}
}

