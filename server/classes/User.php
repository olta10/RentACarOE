<?php
require_once "Database.php";

class User extends Database {

    public function register($name, $email, $password, $role = 'user') {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO users (name, email, password, role, created_at) VALUES (:name, :email, :password, :role, NOW())");
        return $stmt->execute([
            ':name'     => $name,
            ':email'    => $email,
            ':password' => $hash,
            ':role'     => $role
        ]);
    }

    public function login($email, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false; 
    }

    public function getAllUsers() {
        return $this->conn->query("SELECT id, name, email, role FROM users ORDER BY id DESC")->fetchAll();
    }

    public function deleteUser($id) {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function getUserById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
}
?>
