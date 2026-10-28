<?php
require __DIR__ . '/../config/db.php';
$customers = $pdo->query("SELECT COUNT(*) c FROM customers")->fetch()['c'];
$jobs = $pdo->query("SELECT COUNT(*) c FROM jobs")->fetch()['c'];
$pending = $pdo->query("SELECT COUNT(*) c FROM jobs WHERE status='pending'")->fetch()['c'];
$files = $pdo->query("SELECT COUNT(*) c FROM files")->fetch()['c'];
$recent = $pdo->query("SELECT j.*,c.name customer,s.name service FROM jobs j JOIN customers c ON c.id=j.customer_id JOIN services s ON s.id=j.service_id ORDER BY j.id DESC LIMIT 10")->fetchAll();
?>
<!doctype html>
<html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Admin Dashboard</title><link rel="stylesheet" href="../assets/style.css"></head>
<body>
<nav><div class="brand">CB CLIMATE • ADMIN</div><div><a href="../">Website</a><a href="export.php">Export Database</a></div></nav>
<section class="section"><h1>Management Dashboard</h1>
<div class="stats">
<div class="stat"><b><?=$customers?></b><span>Customers</span></div>
<div class="stat"><b><?=$jobs?></b><span>Total Jobs</span></div>
<div class="stat"><b><?=$pending?></b><span>Pending Jobs</span></div>
<div class="stat"><b><?=$files?></b><span>Files</span></div>
</div>
<div class="card"><h2>Recent Service Requests</h2><table><tr><th>ID</th><th>Customer</th><th>Service</th><th>Status</th><th>Date</th></tr>
<?php foreach($recent as $r): ?><tr><td><?=$r['id']?></td><td><?=htmlspecialchars($r['customer'])?></td><td><?=htmlspecialchars($r['service'])?></td><td><span class="status"><?=$r['status']?></span></td><td><?=$r['created_at']?></td></tr><?php endforeach; ?>
</table></div>
<div class="card"><h2>File Organization</h2><p>Use the <b>uploads/</b> directory for job documents, customer photos, invoices and CCTV/AC project files. The database stores file metadata so records remain organized.</p></div>
</section>
</body></html>
