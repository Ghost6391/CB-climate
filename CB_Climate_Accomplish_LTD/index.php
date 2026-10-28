<?php
require __DIR__ . '/config/db.php';
$services = $pdo->query("SELECT * FROM services ORDER BY id DESC")->fetchAll();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>CB Climate Accomplish LTD</title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<nav>
  <div class="brand">CB CLIMATE ACCOMPLISH LTD</div>
  <div><a href="#services">Services</a><a href="#contact">Request Service</a><a class="btn" href="admin/">Admin Login</a></div>
</nav>
<header class="hero">
  <div>
    <span class="badge">AC • CCTV • TECHNICAL SERVICES</span>
    <h1>Climate control and security solutions you can trust.</h1>
    <p>Sales, professional AC installation, repair, maintenance and CCTV installation for homes and businesses.</p>
    <a class="btn" href="#contact">Request a Service</a>
  </div>
</header>
<section id="services" class="section">
<h2>Our Services</h2>
<div class="grid">
<?php foreach($services as $s): ?>
<div class="card"><h3><?=htmlspecialchars($s['name'])?></h3><p><?=htmlspecialchars($s['description'])?></p></div>
<?php endforeach; ?>
</div>
</section>
<section id="contact" class="section light">
<h2>Request a Service</h2>
<form method="post" action="api/request.php" class="form">
<input name="name" placeholder="Full name" required>
<input name="phone" placeholder="Phone number" required>
<input name="email" type="email" placeholder="Email">
<input name="address" placeholder="Service address">
<select name="service_id" required>
<option value="">Select service</option>
<?php foreach($services as $s): ?><option value="<?=$s['id']?>"><?=htmlspecialchars($s['name'])?></option><?php endforeach; ?>
</select>
<textarea name="problem" placeholder="Describe the problem or service you need" required></textarea>
<button class="btn" type="submit">Send Request</button>
</form>
</section>
<footer>© <?=date('Y')?> CB Climate Accomplish LTD. All rights reserved.</footer>
</body>
</html>
