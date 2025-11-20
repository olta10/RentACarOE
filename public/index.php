<?php
require_once "/config.php";

$stmt = $pdo->query("SELECT id, title, short_desc, slug FROM services ORDER BY created_at DESC LIMIT 3");
$services = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="sq">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Rent-a-Car - Home</title>
<link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

<header class="site-header">
    <div class="container">
        <h1><a href="index.php">Rent-a-Car</a></h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="about.php">Rreth nesh</a>
            <a href="services.php">Shërbimet</a>
            <a href="contact.php">Kontakti</a>

            <?php if(!isset($_SESSION['user_id'])): ?>
                <a href="login.php">Hyr</a>
                <a href="register.php">Regjistrohu</a>
            <?php else: ?>
                <span>Mirësevjen, <?= htmlspecialchars($_SESSION['user_name']) ?></span>
                <a href="logout.php">Dil</a>
            <?php endif; ?>
        </nav>
    </div>
</header>

<main class="container">

<section class="hero">
    <h2>Makina të besueshme. Çmime të mira.</h2>
    <p>Merr makinë me qira shpejt, lehtë dhe me çmime konkurruese.</p>
</section>

<section>
<h3>Shërbimet tona</h3>
<div class="cards">
<?php foreach($services as $s): ?>
<article class="card">
    <h4><?= htmlspecialchars($s['title']) ?></h4>
    <p><?= htmlspecialchars($s['short_desc']) ?></p>
    <a class="btn" href="service_detail.php?slug=<?= urlencode($s['slug']) ?>">Detaje</a>
</article>
<?php endforeach; ?>
</div>
</section>

</main>

<footer class="site-footer container">
    <p>© <?= date('Y') ?> Rent-a-Car. Të gjitha të drejtat.</p>
</footer>

</body>
</html>
