<?php

include "config/config.php";


// Class Databse

class  Database{

  public $pdo;
     public $alt_pdo;

  // Construct Class
  public function __construct(){

    if (!isset($this->pdo)) {
      try {
        $link = new PDO('mysql:host='.DB_HOST.'; dbname='.DB_NAME, DB_USER, DB_PASS);
        $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $link->exec("SET CHARACTER SET utf8");
        $this->pdo  =  $link;

          $alt_link = new PDO('mysql:host='.DB_HOST.'; dbname=studentforum', DB_USER, DB_PASS);
          $alt_link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $alt_link->exec("SET CHARACTER SET utf8");

          $this->alt_pdo = $alt_link;
      } catch (PDOException $e) {
        die("Connection error...".$e->getMessage());
      }

    }


  }








}
