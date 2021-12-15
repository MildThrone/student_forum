<?php

session_start();
include "../dbh/dbh.php";
include "../dbh/db_functions.php";

if(!isset($_GET['reply_id']) || empty($_GET['reply_id'])) {
    header("Location: ../home.php");
    exit();
} else {

    // get forum id
    $reply_id = trim($_GET['reply_id']);
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO reply_likes(reply_id, user_id) VALUES(?, ?)";

    if (user_liked($reply_id) == false) {
        $stmt = $pdo->prepare($sql);
        try {
            $stmt->execute([$reply_id, $user_id]);

//        header("Location: ../topic.php?id=$topic_id&like=success");
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } catch (PDOException $e) {
            die("An error occured. Try again");
        }
    } else {
        header("Location: ../topic.php?id=$reply_id");
    }

    // pdo query

}