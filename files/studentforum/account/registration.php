<?php

include "dbh/dbh.php";

if(isset($_POST['register'])) {

    // get user inputs
    $first_name = ucwords(strtolower(trim($_POST['first_name'])));
    $other_names = ucwords(strtolower(trim($_POST['other_names'])));
    $email = trim($_POST['email']);
    $index_number = strtoupper(trim($_POST['index_number']));
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $profile_pic = "profile.jpg";

    // check for empty fields
    if(empty($first_name) || empty($other_names) || empty($email) || empty($index_number) || empty($password) || empty($confirm_password)) {
        header("Location: register.php?error=empty&first_name=$first_name&other_names=$other_names&email=$email&index_number=$index_number");
        exit();
    }
    else {

        // validate the fields
        if(!preg_match("/^[a-z A-Z]+$/", $first_name)) {
            header("Location: register.php?error=invalidFirstName&first_name=$first_name&other_names=$other_names&email=$email&index_number=$index_number");
            exit();
        }
        
        
        elseif(!preg_match("/^[a-z A-Z]+$/", $other_names)) {
            header("Location: register.php?error=invalidOtherNames&first_name=$first_name&other_names=$other_names&email=$email&index_number=$index_number");
            exit();
        }
        elseif(!preg_match("/^([a-zA-Z0-9\.-]+)@([a-zA-Z0-9-]+)\.([a-zA-Z]{2,5})(\.[a-zA-Z]{2,5})?$/", $email)) {
            header("Location: register.php?error=invalidEmail&first_name=$first_name&other_names=$other_names&email=$email&index_number=$index_number");
            exit();
        }
        
        elseif( (strlen($password) < 8) || (strlen($confirm_password) < 8) ) {
            header("Location: register.php?error=pwdLength&first_name=$first_name&other_names=$other_names&email=$email&index_number=$index_number");
            exit();
        }
        elseif($password != $confirm_password) {
            header("Location: register.php?error=pwdNotMatch&first_name=$first_name&other_names=$other_names&email=$email&index_number=$index_number");
            exit();
        }

        else {

            // Check if user email already exists in db
            $sql = "SELECT * FROM users WHERE email=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email]);

            $results = $stmt->fetchAll();

            if(count($results) > 0) {
                header("Location: register.php?error=emailExists&first_name=$first_name&other_names=$other_names&email=$email&index_number=$index_number");
            }

            else {

                // Check if user index number already exists in db
                $sql = "SELECT * FROM users WHERE index_number=?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$index_number]);

                $results = $stmt->fetchAll();

                if(count($results) > 0) {
                    header("Location: register.php?error=indexExists&first_name=$first_name&other_names=$other_names&email=$email&index_number=$index_number");
                }

                else {

                    // hash password
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
                    // Generate unique token
                    // $token = bin2hex(random_bytes(32));
                    // $hashedToken = password_hash($token, PASSWORD_DEFAULT);
                    
    
                    // INSERT DATA INTO DATABASE
    
                    try {
                        $sql = "INSERT INTO users (first_name, other_names, email, index_number, password, profile_pic) VALUES(?,?,?,?,?,?)";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([$first_name, $other_names, $email, $index_number, $hashedPassword, $profile_pic]);
    
                        header('Location: register.php?account=success');
                    } 
                    catch (PDOException $e) {
                        echo "An error occured, try again." . $e->getMessage();
                        exit();
                    }
    
    
                }
            }
            
        }

    }
}