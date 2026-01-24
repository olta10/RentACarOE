<?php
require_once 'Database.php';

class Car extends Database {

    public function addCar($brand, $model, $year, $price, $user_id, $image = null) {
        $year  = intval($year);
        $price = floatval($price);
        if($year < 1900 || $year > date("Y")+1) die("Invalid year");
        if($price <= 0) die("Price must be positive");

        $stmt = $this->conn->prepare(
            "INSERT INTO cars (brand, model, year, price, created_by, image, created_at)
             VALUES (:brand, :model, :year, :price, :user_id, :image, NOW())"
        );

        return $stmt->execute([
            ':brand'   => $brand,
            ':model'   => $model,
            ':year'    => $year,
            ':price'   => $price,
            ':user_id' => $user_id,
            ':image'   => $image
        ]);
    }

    public function getAllCars() {
        return $this->conn->query(
            "SELECT cars.*, users.name AS user_name 
             FROM cars 
             JOIN users ON cars.created_by = users.id 
             ORDER BY cars.id DESC"
        )->fetchAll();
    }

    public function deleteCar($id) {
        $stmt = $this->conn->prepare("DELETE FROM cars WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function deleteMedia($id) {
        $stmt = $this->conn->prepare("UPDATE cars SET media = NULL WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function getCarById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM cars WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
}
?>
