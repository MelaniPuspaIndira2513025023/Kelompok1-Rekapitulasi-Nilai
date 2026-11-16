<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard</title>
<style>
  body { margin:0; min-height:100vh; display:grid; place-items:center; background:#eef2f1;
         font-family:"Segoe UI",system-ui,Arial,sans-serif; color:#1c2b2a; padding:20px; }
  .card { background:#fff; border:1px solid #c9d6d3; border-radius:12px; padding:36px 32px;
          max-width:420px; width:100%; }
  h1 { margin:0 0 8px; font-size:1.5rem; }
  p { color:#5d6f6d; margin:0 0 24px; }
  a { display:inline-block; padding:10px 18px; background:#0f6b5c; color:#fff;
      text-decoration:none; border-radius:8px; font-weight:600; }
  a:hover { background:#0a4f44; }
</style>
</head>
<body>
  <main class="card">
    <h1>Halo, <?= htmlspecialchars($_SESSION["nama"]) ?></h1>
    <p>Kamu berhasil masuk.</p>
    <a href="logout.php">Keluar</a>
  </main>
</body>
</html>
