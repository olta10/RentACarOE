<?php
require_once 'Database.php';

class User extends Database {

    public function __construct() {
        parent::__construct(); 
    }

    public function login($email, $password) {
        $stmt = $this->conn->prepare(
            "SELECT * FROM users WHERE email = ? LIMIT 1"
        );
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        if (!$user) {
            return false;
        }

        if (!password_verify($password, $user['password'])) {
            return false;
        }

        return $user;
    }

    public function getAllUsers() {
        $sql = "SELECT id, fullname, email, role, created_at 
                FROM users 
                ORDER BY id DESC";

        $result = $this->conn->query($sql);

        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }

        return $users;
    }

    public function getUserById($id) {
        $stmt = $this->conn->prepare(
            "SELECT id, fullname AS name, email, role, created_at 
             FROM users 
             WHERE id = ? LIMIT 1"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        return $user;
    }

    public function updateUser($id, $name, $email, $role) {
        if ($id == 1) return false;

        $stmt = $this->conn->prepare(
            "UPDATE users 
             SET fullname = ?, email = ?, role = ? 
             WHERE id = ?"
        );
        $stmt->bind_param("sssi", $name, $email, $role, $id);
        $success = $stmt->execute();
        $stmt->close();

        return $success;
    }

    public function deleteUser($id) {
        if ($id == 1) return false; 

        $stmt = $this->conn->prepare(
            "DELETE FROM users WHERE id = ?"
        );
        $stmt->bind_param("i", $id);
        $success = $stmt->execute();
        $stmt->close();

        return $success;
    }
}
