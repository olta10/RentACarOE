<?php
require_once 'Database.php';

class Contact extends Database {

    public function getAllMessages() {
        return $this->conn->query("SELECT * FROM contacts ORDER BY created_at DESC")->fetchAll();
    }

    public function deleteMessage($id) {
        $stmt = $this->conn->prepare("DELETE FROM contacts WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
?>
