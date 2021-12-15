<?php

session_start();
include "../dbh/dbh.php";
include "../dbh/db_functions.php";







if(isset($_POST['upload'])) {

    
    if(!empty($_FILES['profile_upload']['name'])) {

        $file = $_FILES['profile_upload'];
        
        $file_folder = 'img';

        $file_upload_error = upload_file($file, $file_folder);

        if($file_upload_error == 0) {
            $doc_filename = $_SESSION['doc_filename'];
            $_SESSION['profile_pic'] = $doc_filename;

            $sql = "UPDATE users SET profile_pic=? WHERE id=?";

            // pdo query
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$doc_filename, $_SESSION['user_id']]);
        
            
            if(add($data, $table) == true) {
                unset($_SESSION['doc_filename']);
                header("Location: ../profile.php?updatePic=success");
                exit();
            }
            else{
                header("Location: ../profile.php?error=failed");
                exit();
            }    
        }
        else {
            header("Location: ../profile.php?upload=failed&error=$file_upload_error");
        }
        
        
    }

    else {
        header("Location: ../profile.php?error=file");
        exit();
    }
}




// elseif(isset($_POST['create-reply'])) {

//     // get form details
//     $forum_id = $_POST['forum_id'];
//     $topic_id = $_POST['topic_id'];
//     $description = $_POST['description'];
//     // echo htmlspecialchars($description) . "<br>";
    

//     if($description == "<p><br></p>") {
//         header("Location: ../topic.php?topic_id=$topic_id&error=empty");
//     }
//     else {

//         // clean data and insert into database
//         // generate timestamp
//         $date_posted = date('Y-m-d h:i:s');

//         // prepare data to insert
//         $data = array('topic_id'=>$topic_id,
//                         'forum_id'=>$forum_id,
//                         'description'=>$description,
//                         'user_id'=>$_SESSION['user_id'],
//                         'date_posted'=>$date_posted);

//         $table = 'replies';
        
//         if(add($data, $table) == true) {

//             // redirect to topic with success msg
//             header("Location: ../topic.php?topic_id=$topic_id&add=success");
//             exit();
//         }
//         else {
//             header("Location: ../topic.php?topic_id=$topic_id&error=failed");
//             exit();
//         }
//     }
    

// }







else {
    header("Location: ../home.php");
    exit();
}