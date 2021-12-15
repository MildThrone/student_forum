<?php

session_start();
include "../dbh/dbh.php";



// get details

if(isset($_POST['change_password'])) {    

    
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $new_password2 = $_POST['new_password2'];
    $user_id = $_SESSION['user_id'];
    

    if(empty($old_password) || empty($new_password) || empty($new_password2)) {

        header("Location: ../profile.php?error=empty");
        exit();
    }
    else {
        
        $sql = "SELECT * FROM users WHERE id = ?";
    
        // QUERY USING PDOStatement
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id]);

        $result = $stmt->fetchAll();
        
        if(count($result) < 1) {
            // die("User not found");
            header('Location: ../profile.php?error=userNotFound');
            exit();
            
        }
        else {

            foreach ($result as $user) {
                $user_password = $user['password'];

                if(password_verify($old_password, $user_password) == false) {
                    header('Location: ../profile.php?error=invalidPassword');
                    exit();
                }
                elseif(password_verify($old_password, $user_password) == true) {

                    // check new passwords
                    if($new_password != $new_password2) {

                        header("Location: ../profile.php?error=passwordMatch");
                        exit();

                    }
                    elseif(strlen($new_password) < 8) {
                        header("Location: ../profile.php?error=passwordLength");
                    }
                    else {
                        // encrypt new password
                        $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                        // UPDATE DATABASE

                        $sql = "UPDATE users SET password = ? WHERE id = ?";

                        try {
                            // query using PDO
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute([$new_password_hash, $user_id]);

                            header("Location: ../profile.php?update=success");

                        } catch (PDOException $e) {
                            echo "An error occured, try again." . $e->getMessage();
                            exit();
                        }
                    }
                }
            }
        }
    }

}
