<?php

define('HOST_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'studentforum');

// use PDO to make connection to database


    

    $dsn = "mysql:host=" . HOST_SERVER . ";dbname=" . DB_NAME;
    
    
    
    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        // $conn = mysqli_connect(HOST_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }
    