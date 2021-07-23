<?php

try {
	class DbConnectManager
	{

		protected function dbConnect()
		{
			$db = new PDO('mysql:host=localhost;dbname=blog_oc;charset=utf8', 'root', 'saradb', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			return $db;

			// Close it here
			$sth = null;
			$dbh = null;
		}

	}
}
catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage() . "<br/>";
		die();
}