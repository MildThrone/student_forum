<?php

session_start();
include "../dbh/dbh.php";
include "../dbh/db_functions.php";

if(!isset($_GET['forum_id']) || empty($_GET['forum_id'])) {
    header("Location: ../home.php");
    exit();
}
else {

    // get forum id
    $forum_id = trim($_GET['forum_id']);
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO subscriptions(forum_id, user_id) VALUES(?, ?)";

    // pdo query
    $stmt = $pdo->prepare($sql);
    try {
        $stmt->execute([$forum_id, $user_id]);

        header("Location: ../forum.php?id=$forum_id&sub=success");
    } catch (PDOException $e) {
        die("An error occured. Try again");
    }
}