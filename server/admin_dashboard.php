<?php
session_start();
require_once '../server/classes/Car.php';
require_once '../server/classes/User.php';
require_once '../server/classes/Contact.php';

if (!isset($_SESSION['role']) || strtolower($_SESSION['role']) !== 'admin') {
    header("Location: ../public/login.php");
    exit;
}

$carObj     = new Car();
$userObj    = new User();
$contactObj = new Contact();

if (isset($_GET['delete_contact'])) {
    $contactObj->deleteMessage(intval($_GET['delete_contact']));
    header("Location: admin_dashboard.php");
    exit;
}

if (isset($_GET['delete_user'])) {
    $userObj->deleteUser(intval($_GET['delete_user']));
    header("Location: admin_dashboard.php");
    exit;
}

if (isset($_GET['delete_car'])) {
    $carObj->deleteCar(intval($_GET['delete_car']));
    header("Location: admin_dashboard.php");
    exit;
}

$cars     = $carObj->getAllCars();
$users    = $userObj->getAllUsers();
$contacts = $contactObj->getAllMessages();

$admins = [];
$others = [];

foreach ($users as $u) {
    if (strtolower($u['role']) === 'admin') {
        $admins[] = $u;
    } else {
        $others[] = $u;
    }
}

usort($others, function($a, $b) {
    return $a['id'] <=> $b['id'];
});

$users_sorted = array_merge($admins, $others);

usort($contacts, function($a, $b) {
    return strtotime($b['created_at']) <=> strtotime($a['created_at']);
});

usort($cars, function($a, $b) {
    return $b['id'] <=> $a['id'];
});
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>
<link rel="stylesheet" href="../css/style.css">
<style>
    body { font-family: Arial,sans-serif; background:#f4f6f8; margin:0; padding:0; }
    .container { max-width:1200px; margin:40px auto; padding:20px; background:#fff; border-radius:8px; box-shadow:0 2px 10px rgba(0,0,0,0.1); }
    h1,h2 { text-align:center; margin-bottom:20px; }
    .table { width:100%; border-collapse: collapse; margin-bottom:40px; }
    .table th, .table td { border:1px solid #ddd; padding:12px; text-align:left; }
    .table th { background:#4CAF50; color:#fff; }
    .table tr:nth-child(even) { background:#f9f9f9; }
    .admin-role { font-weight:bold; color:red; }
    .delete-btn { background:#e74c3c; color:#fff; padding:5px 10px; border:none; border-radius:4px; text-decoration:none; cursor:pointer; }
    .delete-btn:hover { background:#c0392b; }
    .logout-btn { float:right; background:#3498db; color:#fff; padding:8px 15px; border-radius:5px; text-decoration:none; margin-bottom:20px; display:inline-block; }
    .logout-btn:hover { background:#2980b9; }
    .edit-btn { background:#f39c12; color:#fff; padding:5px 10px; border-radius:4px; text-decoration:none; }
    .edit-btn:hover { background:#d35400; }
    img.car-img { width:100px; height:auto; border-radius:4px; }
</style>
</head>
<body>
<div class="container">
<h1>Admin Dashboard</h1>
<hr>
<a href="../public/logout.php" class="logout-btn">Logout</a>

<!-- CONTACT MESSAGES -->
<h2>Contact Messages</h2>
<?php if (!empty($contacts)): ?>
<table class="table">
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Message</th>
        <th>Sent At</th>
        <th>Action</th>
    </tr>
    <?php foreach ($contacts as $index => $c): ?>
        <tr>
            <td><?= $index + 1 ?></td>
            <td><?= htmlspecialchars($c['name'] ?? '') ?></td>
            <td><?= htmlspecialchars($c['email'] ?? '') ?></td>
            <td><?= nl2br(htmlspecialchars($c['message'] ?? '')) ?></td>
            <td><?= htmlspecialchars($c['created_at'] ?? '') ?></td>
            <td>
                <a href="?delete_contact=<?= $c['id'] ?>" class="delete-btn" onclick="return confirm('Delete this message?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php else: ?>
<p style="text-align:center; padding:20px; background:#fff3cd; color:#856404; border:1px solid #ffeeba; border-radius:5px;">
    Nuk ka ende mesazhe.
</p>
<?php endif; ?>

<!-- USERS LIST -->
<h2>Users List</h2>
<?php if (!empty($users_sorted)): ?>
<table class="table">
<tr>
    <th>#</th>
    <th>Full Name</th>
    <th>Email</th>
    <th>Role</th>
    <th>Actions</th>
</tr>
<?php foreach ($users_sorted as $index => $u): ?>
<tr>
    <td><?= $index + 1 ?></td>
    <td><?= htmlspecialchars($u['fullname'] ?? '') ?></td>
    <td><?= htmlspecialchars($u['email'] ?? '') ?></td>
    <td class="<?= strtolower($u['role'] ?? '')==='admin'?'admin-role':'' ?>"><?= htmlspecialchars($u['role'] ?? '') ?></td>
    <td>
        <a href="../server/edit_user.php?id=<?= $u['id'] ?>" class="edit-btn">Edit</a>
        <?php if($u['id'] != 1): ?>
            <a href="?delete_user=<?= $u['id'] ?>" class="delete-btn" onclick="return confirm('Delete this user?')">Delete</a>
        <?php endif; ?>
    </td>
</tr>
<?php endforeach; ?>
</table>
<?php else: ?>
<p style="text-align:center; padding:20px; background:#fff3cd; color:#856404; border:1px solid #ffeeba; border-radius:5px;">
    Nuk ka ende përdorues.
</p>
<?php endif; ?>

<!-- CARS LIST -->
<h2>Cars List</h2>
<?php if (!empty($cars)): ?>
<table class="table">
<tr>
    <th>#</th>
    <th>Brand</th>
    <th>Model</th>
    <th>Price</th>
    <th>Added By</th>
    <th>Image</th>
    <th>Actions</th>
</tr>
<?php foreach ($cars as $index => $car): ?>
<tr>
    <td><?= $index + 1 ?></td>
    <td><?= htmlspecialchars($car['brand'] ?? '') ?></td>
    <td><?= htmlspecialchars($car['model'] ?? '') ?></td>
    <td><?= htmlspecialchars($car['price'] ?? '') ?> €</td>
    <td><?= htmlspecialchars($car['user_name'] ?? 'Unknown') ?></td>
    <td>
        <?php if(!empty($car['image'])): ?>
            <img src="../public/uploads/<?= htmlspecialchars($car['image']) ?>" class="car-img">
        <?php else: ?>
            No Image
        <?php endif; ?>
    </td>
    <td>
        <a href="../server/edit_car.php?id=<?= $car['id'] ?>" class="edit-btn">Edit</a>
        <a href="?delete_car=<?= $car['id'] ?>" class="delete-btn" onclick="return confirm('Delete this car?')">Delete</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
<?php else: ?>
<p style="text-align:center; padding:20px; background:#fff3cd; color:#856404; border:1px solid #ffeeba; border-radius:5px;">
    Nuk ka ende makina të regjistruara.
</p>
<?php endif; ?>

</div>
</body>
</html>
