<?php
session_start();
include "dbh/dbh.php";

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($email) || empty($password)) {
        header("Location: index.php?error=empty&email=$email");
        exit();
    }
    else {
        // if(!preg_match("/^([a-zA-Z0-9\.-]+)@([a-zA-Z0-9-]+)\.([a-z]{2,5})(\.[a-z]{2,5})?$/", $email)) {
        //     header("Location: index.php?error=email&email=$email");
        //     exit();
        // }
        

        // check if user exists in db
        $sql = "SELECT * FROM users WHERE email=? OR index_number=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email, $email]);

        $users = $stmt->fetchAll();
        
        if(count($users) < 1) {
            header("Location: index.php?error=user&email=$email");
            exit();
        }
        else {
            
            // verify password
            foreach ($users as $user) {
                
                $hashedPassword = $user['password'];

                $verify_password = password_verify($password, $hashedPassword);

                if($verify_password === false) {
                    header("Location: index.php?error=password&email=$email");
                    exit();
                }
                elseif($verify_password === true) {
                    session_start();
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['index_number'] = $user['index_number'];
                    $_SESSION['first_name'] = $user['first_name'];
                    $_SESSION['other_names'] = $user['other_names'];
                    $_SESSION['profile_pic'] = $user['profile_pic'];
                    
                    
                    header("Location: home.php");
                    
                }
            }
        }

    }
}