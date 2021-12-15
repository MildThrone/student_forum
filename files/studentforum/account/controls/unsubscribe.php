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

    $sql = "DELETE FROM subscriptions WHERE forum_id=? AND user_id=?";

    // pdo query
    $stmt = $pdo->prepare($sql);
    try {
        $stmt->execute([$forum_id, $user_id]);

        header("Location: ../forum.php?id=$forum_id&unsub=success");
    } catch (PDOException $e) {
        die("An error occured. Try again");
    }
}