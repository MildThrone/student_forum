<?php




date_default_timezone_set('Africa/Accra');
$current_date = date('Y-m-d');







function no_of_rows($table) {

    global $pdo;

    $sql = "SELECT * FROM $table";

    // pdo query
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $no_of_rows = count($stmt->fetchAll());

    return $no_of_rows;
}




function no_of_rows_where($table, $where_field, $where_keyword) {

    global $pdo;
    global $user_id;


    $sql = "SELECT * FROM $table WHERE $where_field = ?";

    // pdo query
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$where_keyword]);
    $no_of_rows = count($stmt->fetchAll());

    return $no_of_rows;
}



function no_of_rows_where_user($table, $where_field, $where_keyword) {

    global $pdo;
    global $user_id;


    $sql = "SELECT * FROM $table WHERE $where_field = ? AND user_id=?";

    // pdo query
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$where_keyword, $user_id]);
    $no_of_rows = count($stmt->fetchAll());

    return $no_of_rows;
}



function select_all($table) {

    global $pdo;
    global $user_id;

    $alt_link = new PDO('mysql:host='.DB_HOST.'; dbname=studentforum', DB_USER, DB_PASS);
    $alt_link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $alt_link->exec("SET CHARACTER SET utf8");

    $alt_pdo = $alt_link;


    $sql = "SELECT * FROM $table";

    // pdo query
//    $stmt = $pdo->prepare($sql);
    $stmt = $alt_pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    

    return $result;
}



function select_all_desc($table, $order_by_field) {

    global $pdo;
    global $user_id;


    $sql = "SELECT * FROM $table ORDER BY $order_by_field desc";

    // pdo query
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    

    return $result;
}




function select_all_where($table, $where_field, $where_keyword) {

    global $pdo;
    global $user_id;


    $sql = "SELECT * FROM $table WHERE $where_field = ?";

    // pdo query
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$where_keyword]);
    $result = $stmt->fetchAll();

    return $result;
}



function select_all_where_desc($table, $where_field, $where_keyword, $order_id_field) {

    global $pdo;
    global $user_id;


    $sql = "SELECT * FROM $table WHERE $where_field = ? ORDER BY $order_id_field desc";

    // pdo query
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$where_keyword]);
    $result = $stmt->fetchAll();

    return $result;
}




function select_all_limit_desc($table, $order_by_field, $limit) {

    global $pdo;
    global $user_id;


    $sql = "SELECT * FROM $table ORDER BY $order_by_field desc LIMIT $limit";

    // pdo query
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    

    return $result;
}



function select_all_where_limit_desc($table, $where_field, $where_keyword, $order_by_field, $limit) {

    global $pdo;
    global $user_id;


    $sql = "SELECT * FROM $table WHERE $where_field = ? ORDER BY $order_by_field desc LIMIT $limit";

    // pdo query
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$where_keyword]);
    $result = $stmt->fetchAll();

    return $result;
}



function already_exists($table, $where_field, $where_keyword) {

    global $pdo;
    global $user_id;


    $sql = "SELECT * FROM $table WHERE $where_field = ?";

    // pdo query
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$where_keyword]);
    $result = $stmt->fetchAll();
    
    if(count($result) < 1) {
        return false;
    }
    else {
        return true;
    }
}



function user_subscribed($forum_id) {

    global $pdo;


    $sql = "SELECT * FROM subscriptions WHERE forum_id = ? AND user_id=?";

    // pdo query
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$forum_id, $_SESSION['user_id']]);
    $result = $stmt->fetchAll();
    
    if(count($result) < 1) {
        return false;
    }
    else {
        return true;
    }
}

function user_liked($reply_id) {
    global $pdo;

    $sql = "SELECT * FROM reply_likes WHERE reply_id = ? AND user_id=?";

    // pdo query
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$reply_id, $_SESSION['user_id']]);
    $result = $stmt->fetchAll();

    if(count($result) < 1) {
        return false;
    }
    else {
        return true;
    }
}










function upload_file($file, $file_folder) {

    $file_name = $file['name'];
    $file_type = $file['type'];
    $file_tmp_name = $file['tmp_name'];
    $file_error = $file['error'];
    $file_size = $file['size'];

    // Specify allowed file types
    // $allowed_type = array('jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt');

    // Get file type of uploaded file
    $file_ext_extract = explode('.', $file_name);
    $file_new_name = $file_ext_extract[0];
    $file_ext = strtolower(end($file_ext_extract));


    $error = 0;

    // Check if there was an error
    if($file_error > 0){
        $error = 3;              
    }
    // Give unique new name to file (prefix with file extension)
    else{
        
        unset($file_ext_extract[count($file_ext_extract) - 1]);
        $file_name_only = implode("", $file_ext_extract);
        $file_new_name = $file_name_only . '_'. uniqid('', true) .'.' .$file_ext;
        
        // Specify new location to store file in
        $file_dir = "../$file_folder/$file_new_name";

        // move_uploaded_file($file_tmp_name, $file_dir)

        // Move file to upload folder
        if(move_uploaded_file($file_tmp_name, $file_dir)) {
            unset($_SESSION['doc_filename']);
            $_SESSION['doc_filename'] = $file_new_name;
        }
    }

    return $error;

}



function add($data, $table) {

    global $pdo;
    $data_len = count($data);
    $placeholders = array();

    for ($i=0; $i < $data_len; $i++) { 
        $placeholders[$i] = "?";
    }


    $sql = 'INSERT INTO ' .$table. '('. implode(", ", array_keys($data)) .') VALUES (' . implode(", ", array_values($placeholders)) .')';

    
    

    // pdo query     

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array_values($data));
        
        
        return true;
        
    } catch (PDOException $e) {
        return false;
    }

}



function send_mail($to, $subject, $body) {

     // send using PHP mailer
                

     $from = 'info@thylies.com';
     $from_name = 'Thylies, Inc';
     

     $mail = new PHPMailer();
     $mail->IsSMTP();
     $mail->SMTPAuth = true; 
                             
     $mail->SMTPSecure = 'ssl'; 
     $mail->Host = 'smtp.thylies.com';
     $mail->Port = 465;  
     $mail->Username = 'info@thylies.com';
     $mail->Password = 'Un0549f7d';
                             
     $mail->IsHTML(true);
     $mail->WordWrap = 50;
     $mail->From = "info@thylies.com";
     $mail->FromName = $from_name;
     $mail->Sender = $from;
     $mail->AddReplyTo($from, $from_name);
     $mail->Subject = $subject;
     $mail->Body = $body;
     $mail->AddAddress($to);
     $resultMail = $mail->Send();

     if (!$resultMail) {
         echo "<script>alert('Please try sending email Later, Error Occured while Processing...');</script>";
     } else {
         return true;
     }
}



function generate_case_no() {

    global $pdo;

    $generated_id = strtoupper("CASE" . substr(md5(microtime()),rand(0,26),5));

    $generated_id_search = $generated_id;


    $sql = "SELECT * FROM cases WHERE case_no=?";
    
    // pdo query
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$generated_id_search]);

    $result = count($stmt->fetchAll());

    while($result > 0) {
        $generated_id = strtoupper("CASE" . substr(md5(microtime()),rand(0,26),5));
        $generated_id_search = $generated_id;

        $sql = "SELECT * FROM cases WHERE case_no=?";
        
        // pdo query
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$generated_id_search]);

        $result = count($stmt->fetchAll());
    }

    // generate unique booking id
    return $generated_id;
}
































