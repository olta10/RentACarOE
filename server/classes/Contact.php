<?php
require_once 'Database.php';

class Contact {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->conn;
    }

    public function save($name, $email, $message) {
        $stmt = $this->conn->prepare(
            "INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)"
        );
        $stmt->bind_param("sss", $name, $email, $message);
        $stmt->execute();
        $stmt->close();
        return true;
    }

    public function getAllMessages() {
        $result = $this->conn->query(
            "SELECT * FROM contacts ORDER BY id DESC"
        );
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteMessage($id) {
        $stmt = $this->conn->prepare("DELETE FROM contacts WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        return true;
    }
}
?>
