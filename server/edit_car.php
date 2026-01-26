<?php
session_start();
require_once '../server/classes/Car.php';
require_once '../server/classes/User.php';

if (!isset($_SESSION['role']) || strtolower($_SESSION['role']) !== 'admin') {
    die("Access denied.");
}

$carObj  = new Car();
$userObj = new User();

$id = intval($_GET['id'] ?? 0);
$car = $carObj->getCarById($id);
if (!$car) die("Car not found");

$users = $userObj->getAllUsers();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $brand   = trim($_POST['brand'] ?? '');
    $model   = trim($_POST['model'] ?? '');
    $year    = intval($_POST['year'] ?? 0);
    $price   = floatval($_POST['price'] ?? 0);
    $user_id = intval($_POST['user_id'] ?? 0);

    $carObj->updateCar($id, $brand, $model, $year, $price, $user_id);
    header("Location: admin_dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Car</title>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');
    body { font-family: 'Inter', sans-serif; background: #f0f2f5; margin:0; padding:0; }
    .container { max-width: 500px; margin: 60px auto; padding: 30px; background:#fff; border-radius:12px; box-shadow:0 8px 25px rgba(0,0,0,0.1); }
    h1 { text-align:center; margin-bottom:25px; font-weight:600; color:#333; }
    form { display:flex; flex-direction:column; gap:18px; }
    label { font-weight:600; color:#555; }
    input, select { padding:12px 14px; border-radius:8px; border:1px solid #ccc; font-size:16px; width:100%; box-sizing:border-box; transition:border-color 0.2s, box-shadow 0.2s; }
    input:focus, select:focus { outline:none; border-color:#f39c12; box-shadow:0 0 5px rgba(243,156,18,0.3); }
    button { padding:12px; background:linear-gradient(135deg,#f39c12,#d35400); border:none; border-radius:8px; color:#fff; font-size:16px; font-weight:600; cursor:pointer; transition:background 0.3s; }
    button:hover { background:linear-gradient(135deg,#d35400,#b03a00); }
    a.back-btn { display:block; margin-top:15px; text-align:center; text-decoration:none; color:#3498db; font-weight:500; }
    a.back-btn:hover { text-decoration:underline; }
</style>
</head>
<body>
<div class="container">
    <h1>Edit Car</h1>
    <form method="post">
        <label for="brand">Brand:</label>
        <input type="text" name="brand" id="brand" value="<?= htmlspecialchars($car['brand'] ?? '') ?>" required>

        <label for="model">Model:</label>
        <input type="text" name="model" id="model" value="<?= htmlspecialchars($car['model'] ?? '') ?>" required>

        <label for="year">Year:</label>
        <input type="number" name="year" id="year" value="<?= htmlspecialchars($car['year'] ?? '') ?>" required>

        <label for="price">Price (€):</label>
        <input type="number" name="price" id="price" step="0.01" value="<?= htmlspecialchars($car['price'] ?? '') ?>" required>

        <label for="user_id">Added By (User):</label>
        <select name="user_id" id="user_id" required>
            <?php foreach($users as $u): ?>
                <option value="<?= $u['id'] ?>" <?= ($car['created_by'] ?? 0)==$u['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($u['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Update Car</button>
    </form>
    <a href="admin_dashboard.php" class="back-btn">← Back to Dashboard</a>
</div>
</body>
</html>
