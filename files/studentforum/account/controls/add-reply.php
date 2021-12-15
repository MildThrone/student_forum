<?php

session_start();
include "../dbh/dbh.php";
include "../dbh/db_functions.php";

if(isset($_POST['create-reply'])) {

    // get form details
    $forum_id = $_POST['forum_id'];
    $topic_id = $_POST['topic_id'];
    $description = $_POST['description'];
    // echo htmlspecialchars($description) . "<br>";
    

    if($description == "<p><br></p>") {
        header("Location: ../topic.php?topic_id=$topic_id&error=empty");
    }
    else {

        // clean data and insert into database
        // generate timestamp
        $date_posted = date('Y-m-d h:i:s');

        // prepare data to insert
        $data = array('topic_id'=>$topic_id,
                        'forum_id'=>$forum_id,
                        'description'=>$description,
                        'user_id'=>$_SESSION['user_id'],
                        'date_posted'=>$date_posted);

        $table = 'replies';
        
        if(add($data, $table) == true) {

            // redirect to topic with success msg
            header("Location: ../topic.php?topic_id=$topic_id&add=success");
            exit();
        }
        else {
            header("Location: ../topic.php?topic_id=$topic_id&error=failed");
            exit();
        }
    }
    

}





elseif(isset($_POST['upload'])) {

    // get form details
    $forum_id = $_POST['forum_id'];
    $topic_id = $_POST['topic_id'];

    
    if(!empty($_FILES['document_upload']['name'])) {

        $file = $_FILES['document_upload'];
        
        $file_folder = 'documents';

        $file_upload_error = upload_file($file, $file_folder);

        if($file_upload_error == 0) {
            $doc_filename = $_SESSION['doc_filename'];

            $description = '<p><a href="documents/'.$doc_filename.'" target="_blank"><i class="fa fa-file-alt"></i> '.$doc_filename.'</a></p>
                            <p><a href="documents/'.$doc_filename.'" target="_blank">View Document</a> or <a href="documents/'.$doc_filename.'" target="_blank" download>Download</a></p>';

            $date_posted = date('Y-m-d h:i:s');

            // prepare data to insert
            $data = array('topic_id'=>$topic_id,
                            'forum_id'=>$forum_id,
                            'description'=>$description,
                            'user_id'=>$_SESSION['user_id'],
                            'date_posted'=>$date_posted);

            $table = 'replies';
        
            
            if(add($data, $table) == true) {
                unset($_SESSION['doc_filename']);
                header("Location: ../topic.php?topic_id=$topic_id&add=success");
                exit();
            }
            else{
                header("Location: ../topic.php?topic_id=$topic_id&error=failed");
                exit();
            }    
        }
        else {
            header("Location: ../topic.php?topic_id=$topic_id&upload=failed&error=$file_upload_error");
        }
        
        
    }

    else {
        header("Location: ../topic.php?topic_id=$topic_id&error=file");
        exit();
    }
}







else {
    header("Location: ../home.php");
    exit();
}