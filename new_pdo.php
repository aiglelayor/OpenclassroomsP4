<?php
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=blog_oc;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}
	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}
	$reponse = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(
	date_creation, \'%d%m%Y à %Hh%imin%ss\') AS date_creation_fr FROM
	billets ORDER BY ID DESC LIMIT 5');	

?>