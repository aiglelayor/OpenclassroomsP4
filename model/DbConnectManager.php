<?php

try {
	class DbConnectManager
	{

		protected function dbConnect()
		{
			$db = new PDO('mysql:host=localhost;dbname=blog_oc;charset=utf8', 'root', 'saradb', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			return $db;
			//var_dump($db);
			// Close it here
			// $sth = null;
			$db = null;
		die;
		}
	}
}
catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage() . "<br/>";
		die();
}