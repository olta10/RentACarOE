<?php
require_once 'Database.php';

class Car {
    private $conn;

    public function __construct() {
        $db = new Database();   
        $this->conn = $db->conn;
    }

    public function addCar($brand, $model, $year, $price, $user_id, $image = null) {
        $stmt = $this->conn->prepare(
            "INSERT INTO cars (brand, model, year, price, created_by, image)
             VALUES (?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("ssiiss", $brand, $model, $year, $price, $user_id, $image);
        $stmt->execute();
        $stmt->close();
        return true;
    }

public function getAllCars() {
    $sql = "
        SELECT 
            cars.*, 
            users.fullname AS user_name
        FROM cars
        JOIN users ON cars.created_by = users.id
        ORDER BY cars.id DESC
    ";

    $result = $this->conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}


    public function deleteCar($id) {
        $stmt = $this->conn->prepare("DELETE FROM cars WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        return true;
    }

    public function getCarById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM cars WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $car = $result->fetch_assoc();
        $stmt->close();
        return $car;
    }
}
?>
