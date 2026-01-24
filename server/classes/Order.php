<?php
require_once 'Database.php';

class Order extends Database {

    public function getAllOrders() {
        return $this->conn->query("
            SELECT orders.*, users.name AS user_name
            FROM orders
            LEFT JOIN users ON orders.user_id = users.id
            ORDER BY orders.created_at DESC
        ")->fetchAll();
    }
}
?>
