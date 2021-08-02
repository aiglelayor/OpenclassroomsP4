<?php

require_once('Model/DbConnectManager.php');

class CommentManager
{
	private $dbConnectManage;

	function __construct()
	{
	  $this->dbConnectManage = new DbConnectManager();
	}

	function getComments()
	{
   		$db = $this->dbConnectManage->dbConnect();

		$id_post = (int) $_GET['id'];
		$req = $db->prepare("SELECT id, id_post, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS comment_date_fr, report, report_author FROM comments WHERE id_post = '$id_post' ");
		$req->execute([$id_post]);
		$comments = $req->fetchAll(PDO::FETCH_ASSOC);

		$this->dbConnectManage->dbDisconnect();

		return $comments;
	}

	function postComment($postId, $author, $comment)
	{
		$db = $this->dbConnectManage->dbConnect();

		$req = $db->prepare('INSERT INTO comments(id_post, author, comment, comment_date) VALUES(:id_post, :author, :comment, NOW())');
		$req->bindValue(':id_post', $postId, PDO::PARAM_INT);
		$req->bindValue(':author', $author, PDO::PARAM_STR);
		$req->bindValue(':comment', $comment, PDO::PARAM_STR);
		$req->execute();

		$this->dbConnectManage->dbDisconnect();
	}

	function reportComment($commentId, $pseudo)
	{
		$db = $this->dbConnectManage->dbConnect();

		$req = $db->prepare('UPDATE comments SET report = ?, report_author = ? WHERE id = ?');
		$req_execute = $req->execute(array(
			1,
			$pseudo,
			$commentId
		));

		if($req->execute())
		{
			$_SESSION['comment_reported'] = "Merci ! Le commentaire a été signalé. Nous allons vérifier le contenu.";
		}

		$this->dbConnectManage->dbDisconnect();
	}

	function reportedComments()
	{
		$db = $this->dbConnectManage->dbConnect();

		$req = $db->prepare("SELECT id, id_post, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS comment_date_fr, report, report_author FROM comments WHERE report = 1 ");
		$req->execute();
		$reportedComments = $req->fetchAll(PDO::FETCH_ASSOC);

		return $reportedComments;
		
		$this->dbConnectManage->dbDisconnect();
	}

	function eraseComment($commentId)
	{
		$db = $this->dbConnectManage->dbConnect();

		$req = $db->prepare('DELETE FROM comments WHERE id = ?');
		$req_execute = $req->execute(array(
			$commentId
		));

		if($req->execute())
		{
			$_SESSION['comment_erased'] = "Le commentaire a été supprimé.";
		}

		$this->dbConnectManage->dbDisconnect();
	}
}

