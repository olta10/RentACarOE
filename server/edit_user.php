<?php
session_start();
require 'config.php';

if (!isset($_SESSION['role']) || strtolower($_SESSION['role']) !== 'admin') {
    die("Access denied.");
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    die("Invalid user ID.");
}

$stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("User not found");
}

$success_msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Merr vlerat nga forma POST
    $fullname  = trim($_POST['fullname'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $role      = $_POST['role'] ?? '';

    if($id == 1) $role = 'admin';

    $stmt = $conn->prepare("UPDATE users SET fullname=?, email=?, role=? WHERE id=?");
    $stmt->execute([$fullname, $email, $role, $id]);

    $success_msg = "User updated successfully!";

    $user['fullname'] = $fullname;
    $user['email']    = $email;
    $user['role']     = $role;
}

$display_fullname = $user['fullname'] ?? '';
$display_email    = $user['email'] ?? '';
$display_role     = $user['role'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit User</title>
<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');
body { font-family: 'Inter', sans-serif; background: #f0f2f5; margin:0; padding:0; }
.container { max-width: 450px; margin: 60px auto; padding: 30px; background: #fff; border-radius: 12px; box-shadow: 0 8px 25px rgba(0,0,0,0.1); }
h1 { text-align: center; margin-bottom: 25px; font-weight: 600; color: #333; }
form { display: flex; flex-direction: column; gap: 18px; }
label { font-weight: 600; color: #555; }
input, select { padding: 12px 14px; border-radius: 8px; border: 1px solid #ccc; font-size: 16px; width: 100%; box-sizing: border-box; transition: border-color 0.2s, box-shadow 0.2s; }
input:focus, select:focus { outline: none; border-color: #3498db; box-shadow: 0 0 5px rgba(52,152,219,0.3); }
button { padding: 12px; background: linear-gradient(135deg, #3498db, #2980b9); border: none; border-radius: 8px; color: #fff; font-size: 16px; font-weight: 600; cursor: pointer; transition: background 0.3s; }
button:hover { background: linear-gradient(135deg, #2980b9, #1c5980); }
a.back-btn { display: block; margin-top: 15px; text-align: center; text-decoration: none; color: #3498db; font-weight: 500; }
a.back-btn:hover { text-decoration: underline; }
.success-msg { text-align:center; color: green; font-weight:600; margin-bottom:15px; }
</style>
</head>
<body>
<div class="container">
<h1>Edit User</h1>

<?php if(!empty($success_msg)) echo "<p class='success-msg'>{$success_msg}</p>"; ?>

<form method="post">
    <label for="fullname">Full Name:</label>
    <input type="text" name="fullname" id="fullname" value="<?= htmlspecialchars($display_fullname) ?>" required>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?= htmlspecialchars($display_email) ?>" required>

    <label for="role">Role:</label>
    <?php if($id == 1): ?>
        <input type="text" value="admin" readonly style="padding:12px 14px; border-radius:8px; border:1px solid #ccc; font-size:16px; width:100%; box-sizing:border-box;">
        <input type="hidden" name="role" value="admin">
    <?php else: ?>
        <select name="role" id="role" required>
            <option value="user" <?= $display_role=='user'?'selected':'' ?>>User</option>
            <option value="admin" <?= $display_role=='admin'?'selected':'' ?>>Admin</option>
        </select>
    <?php endif; ?>

    <button type="submit">Update User</button>
</form>
<a href="admin_dashboard.php" class="back-btn">← Back to Dashboard</a>
</div>
</body>
</html>
