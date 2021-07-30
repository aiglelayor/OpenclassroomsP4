<?php

class DbConnectManager
{
  private $PDO;

  function __construct()
  {
    try {
      $this->PDO = new PDO('mysql:host=localhost;dbname=blog_oc;charset=utf8', 'root', 'saradb', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage() . "<br/>";
      die();
    }
  }

  function dbConnect()
  {
    return $this->PDO;
  }

  function dbDisconnect()
  {
    $this->PDO = null;
  }
}
