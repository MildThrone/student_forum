<?php

session_start();
include "../dbh/dbh.php";
include "../dbh/db_functions.php";

if(isset($_POST['create-topic'])) {

    // get form details
    $forum_id = $_POST['forum_id'];
    $topic_title = $_POST['topic_title'];
    $description = $_POST['description'];
    // echo htmlspecialchars($description) . "<br>";
    

    if(empty($topic_title) || $description == "<p><br></p>") {
        header("Location: ../forum.php?id=$forum_id&error=empty");
    }
    else {

        // clean data and insert into database
        // generate timestamp
        $date_posted = date('Y-m-d h:i:s');

        // prepare data to insert
        $data = array('topic_title'=>$topic_title,
                        'description'=>$description,
                        'forum_id'=>$forum_id,
                        'user_id'=>$_SESSION['user_id'],
                        'date_posted'=>$date_posted);

        $table = 'topics';
        
        if(add($data, $table) == true) {

            // redirect to forums with success msg
            header("Location: ../forum.php?id=$forum_id&add=success");
            exit();
        }
        else {
            header("Location: ../forum.php?id=$forum_id&error=failed");
            exit();
        }
    }
    

}

else {
    header("Location: ../home.php");
    exit();
}