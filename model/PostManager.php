<?php

//namespace Saralb\Blog\Model; // La classe sera dans ce namespace.

require_once('Model/DbConnectManager.php');

class PostManager extends DbConnectManager
{
	public function getPosts()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT id, title, content, DATE_FORMAT(
		date_creation, \'%d%m%Y à %Hh%imin%ss\') AS date_creation_fr FROM posts ORDER BY id DESC LIMIT 5');	

		return $req;
	}

	public function getPost($postId)
	{
		$db = $this->dbConnect();
		//$id_post = (int) $_GET['id'];
		$req = $db->prepare('SELECT id, title, content, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM posts WHERE id = ?');
		$req->execute([$postId]);
		$post = $req->fetch();

		return $post;
	}


	public function titleExists($title)
	{
		$db = $this->dbConnect();
		$reqTitle = $db->prepare('SELECT title FROM posts WHERE title = :title');
		$reqTitle->bindValue(':title', $title);
		$reqTitle->execute();

	}

	public function savePost($postId, $title, $content)
	{
		$db = $this->dbConnect();
		//$id_post = (int) $_GET['posts'];
		$req = $db->prepare('UPDATE posts SET title = ?, content = ? WHERE id = ?');
		$req_execute = $req->execute(array(
			$title,
			$content,
			$postId
		));
	}

	public function saveNewPost($title, $content)
	{
		$db = $this->dbConnect();
		//$id_post = (int) $_GET['posts'];
		$req = $db->prepare('INSERT INTO posts(title, content, date_creation) VALUES(:title, :content, NOW())');
		//$req->bindValue(':member_id', $_SESSION['id'], PDO::PARAM_STR);
		$req->bindValue(':title', $title, PDO::PARAM_STR);
		$req->bindValue(':content', $content, PDO::PARAM_STR);

		if($req->execute())
		{
			$_SESSION['new_article'] = "Votre article a bien a été créé !";
		}
	}

	public function deletePost($postId)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('DELETE FROM posts WHERE id = ?');
		$reqExecute = $req->execute(array(
			$postId
		));
	}



	//public function savePost($postId)
}
