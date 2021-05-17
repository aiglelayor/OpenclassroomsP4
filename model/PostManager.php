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
		$id_post = (int) $_GET['id'];
		$req = $db->prepare('SELECT id, title, content, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM posts WHERE id = ?');
		$req->execute([$postId]);
		$post = $req->fetch();

		return $post;
	}
}
