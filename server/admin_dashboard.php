<?php
session_start();
require '../server/config.php';

if (!isset($_SESSION['role']) || strtolower($_SESSION['role']) !== 'admin') {
    echo "Access denied. You will be redirected in 2 seconds.";
    header("Refresh:2; url=../public/login.php"); 
    exit;
}
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $stmt = $conn->prepare("DELETE FROM contacts WHERE id = :id");
    $stmt->execute([':id' => $delete_id]);
    header("Location: admin_dashboard.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM contacts ORDER BY created_at DESC");
$stmt->execute();
$contacts = $stmt->fetchAll();

$stmt2 = $conn->prepare("SELECT id, name, email, role FROM users ORDER BY id DESC");
$stmt2->execute();
$users = $stmt2->fetchAll();

$stmt3 = $conn->query("
    SELECT * FROM orders
    ORDER BY created_at DESC
");
$orders = $stmt3->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>
<link rel="stylesheet" href="../css/style.css">
<style>
body { font-family: Arial, sans-serif; background:#f4f6f8; margin:0; padding:0; }
.container { max-width:1200px; margin:40px auto; padding:20px; background:#fff; border-radius:8px; box-shadow:0 2px 10px rgba(0,0,0,0.1);}
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
.order-btn { background:#27ae60; color:#fff; padding:5px 10px; border-radius:4px; text-decoration:none; }
.order-btn:hover { background:#1e8449; }
</style>
</head>
<body>

<div class="container">
    <h1>Admin Dashboard</h1>
    <a href="../public/logout.php" class="logout-btn">Logout</a>

    <!-- CONTACT MESSAGES -->
    <h2>Contact Messages</h2>
    <?php if($contacts): ?>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Sent At</th>
            <th>Action</th>
        </tr>
        <?php foreach($contacts as $c): ?>
        <tr>
            <td><?= $c['id'] ?></td>
            <td><?= htmlspecialchars($c['name']) ?></td>
            <td><?= htmlspecialchars($c['email']) ?></td>
            <td><?= nl2br(htmlspecialchars($c['message'])) ?></td>
            <td><?= $c['created_at'] ?></td>
            <td>
                <a href="admin_dashboard.php?delete_id=<?= $c['id'] ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this message?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php else: ?>
        <p style="text-align:center;">No messages found.</p>
    <?php endif; ?>

    <!-- USERS LIST -->
    <h2>Users List</h2>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
        <?php foreach($users as $u): ?>
        <tr>
            <td><?= htmlspecialchars($u['id']) ?></td>
            <td><?= htmlspecialchars($u['name']) ?></td>
            <td><?= htmlspecialchars($u['email']) ?></td>
            <td class="<?= strtolower($u['role'])==='admin'?'admin-role':'' ?>"><?= htmlspecialchars($u['role']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <!-- ORDERS -->
    <h2>Orders</h2>
    <?php if($orders): ?>
    <table class="table">
        <tr>
            <th>Order ID</th>
            <th>User</th>
            <th>Service</th>
            <th>Quantity</th>
            <th>Preferences</th>
            <th>Ordered At</th>
        </tr>
        <?php foreach($orders as $o): ?>
        <tr>
            <td><?= $o['id'] ?></td>
            <td><?= htmlspecialchars($o['user_name']) ?></td>
            <td><?= htmlspecialchars($o['service_name']) ?></td>
            <td><?= $o['quantity'] ?></td>
            <td><?= htmlspecialchars($o['preferences']) ?></td>
            <td><?= $o['created_at'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php else: ?>
        <p style="text-align:center;">No orders found.</p>
    <?php endif; ?>

</div>

</body>
</html>
