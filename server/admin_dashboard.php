<?php
session_start();
require 'config.php';

if (!isset($_SESSION['role']) || strtolower($_SESSION['role']) !== 'admin') {
    header("Location: ../public/login.php");
    exit;
}

$stmt = $conn->query("SELECT id, name, email, role FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>
<style>
table { border-collapse: collapse; width: 100%; }
th, td { border: 1px solid #ddd; padding: 8px; }
th { background-color: #4CAF50; color: white; }
.admin { font-weight: bold; color: red; }
</style>
</head>
<body>
<h1>Admin Dashboard</h1>
<table>
<tr>
    <th>ID</th>
    <th>Full Name</th>
    <th>Email</th>
    <th>Role</th>
</tr>
<?php foreach ($users as $u): ?>
<tr>
    <td><?= htmlspecialchars($u['id']) ?></td>
    <td><?= htmlspecialchars($u['name']) ?></td>
    <td><?= htmlspecialchars($u['email']) ?></td>
    <td class="<?= strtolower($u['role']) === 'admin' ? 'admin' : '' ?>">
        <?= htmlspecialchars($u['role']) ?>
    </td>
</tr>
<?php endforeach; ?>
</table>
</body>
</html>
