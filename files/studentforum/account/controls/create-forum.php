<?php

session_start();
include "../dbh/dbh.php";
include "../dbh/db_functions.php";

if(isset($_POST['create-forum'])) {

    // get form details
    $forum_name = htmlspecialchars(ucwords(strtolower(trim($_POST['forum_name']))));
    $purpose = htmlspecialchars(ucwords(strtolower(trim($_POST['purpose']))));
    $user_id = $_SESSION['user_id'];

    if(empty($forum_name) || empty($purpose)) {
        header("Location: ../home.php?error=empty");
        exit();
    }
    else {

        // Check if forum name already exists
        if(already_exists('forums', 'forum_name', $forum_name) == true) {
            header("Location: ../home.php?error=nameExists");
            exit();
        }

        else {

            // generate timestamp
            $date_created = date('Y-m-d h:i:s');

            // prepare data to insert
            $data = array('forum_name'=>$forum_name,
                            'purpose'=>$purpose,
                            'user_id'=>$user_id,
                            'date_created'=>$date_created);

            $table = 'forums';
            
            if(add($data, $table) == true) {

                // subscribe user to forum (first get forum id for forum created)
                $forum = select_all_where('forums', 'forum_name', $forum_name);

                if(count($forum) < 1) {
                    header("Location: ../home.php?error=subFailed");
                    exit();
                }
                else {

                    $forum_id = $forum[0]['forum_id'];

                    // prepare data to insert
                    $data = array('forum_id'=>$forum_id,
                                    'user_id'=>$user_id);

                    $table = 'subscriptions';

                    // add subscription
                    if(add($data, $table) == true) {
                        header("Location: ../home.php?add=success");
                    }
                    else {
                        header("Location: ../home.php?error=subFailed");
                    }

                }
                

                
            }
            else{
                header("Location: ../home.php?error=failed");
            }
        }        
    }
    
}