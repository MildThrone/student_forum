<?php
include 'inc/header.php';
Session::CheckSession();

?>

<?php

if (isset($_GET['id'])) {
    $forumId = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);
//    $forumId = $_GET['id'];
}


if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['query'])) {
//    $updateForum = $forums->updateForum($forumId, $_POST);
    global $pdo;

    $keyword = $_GET['query'];

    $sql = "SELECT * FROM forums WHERE forum_name CONTAINS '$keyword'";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();

    if ($result) {
        foreach ($result as $item) {
            echo $item['forum_name'];
        }
    }
//    var_dump($_POST);

}


?>



<?php
include 'inc/footer.php';

?>
