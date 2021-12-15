<?php

//include 'lib/Database.php';
//include_once 'lib/Session.php';
//include 'Users.php';

class Forums {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getCreator($id) {
        $sql = "SELECT * FROM users WHERE id = :id LIMIT 1";
        $stmt = $this->db->alt_pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        if ($result) {
            return $result->first_name . " " . $result->other_names;
        } else {
            return false;
        }

    }

    public function removeForumbyId($id) {
        $query = $this->db->alt_pdo->prepare("DELETE FROM topics WHERE forum_id = :forum_id ");
        $query->bindValue(':forum_id', $id);
        $query->execute();

        $query = $this->db->alt_pdo->prepare("DELETE FROM subscriptions WHERE forum_id = :forum_id ");
        $query->bindValue(':forum_id', $id);
        $query->execute();

        $query = $this->db->alt_pdo->prepare("DELETE FROM replies WHERE forum_id = :forum_id ");
        $query->bindValue(':forum_id', $id);
        $query->execute();

        $sql = "DELETE FROM forums WHERE forum_id = :forum_id ";
        $stmt = $this->db->alt_pdo->prepare($sql);
        $stmt->bindValue(':forum_id', $id);
        $result = $stmt->execute();
        if ($result) {
            $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success !</strong> Forum Deleted Successfully !</div>';
            return $msg;
        }else{
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error !</strong> Data not Deleted !</div>';
            return $msg;
        }
    }

    public function updateForum($forumId, $data) {

    }

    public function getLikeCount() {

    }

}