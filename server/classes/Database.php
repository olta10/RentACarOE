<?php
class Database {
    public $conn;

    public function __construct() {
        require __DIR__ . '/../config.php'; 

        $this->conn = new mysqli($host, $user, $pass, $db);

        if ($this->conn->connect_error) {
            die("Database connection failed: " . $this->conn->connect_error);
        }
    }
}
?>
