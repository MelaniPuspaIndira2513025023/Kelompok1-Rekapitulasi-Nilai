<?php
session_start();
if (isset($_SESSION["user_id"])) {
    header("Location: dashboard.php");
    exit;
}

require "koneksi.php";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama     = trim($_POST["nama"] ?? "");
    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($nama === "" || $username === "" || $password === "") {
        $error = "Isi nama lengkap, username, dan password.";
    } else {
        $stmt = mysqli_prepare($conn, "SELECT id, password FROM users WHERE username = ?");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

        if (!$row) {
            // Username baru: otomatis dibuat, jadi bebas diisi apa saja
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $ins = mysqli_prepare($conn, "INSERT INTO users (username, password, nama) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($ins, "sss", $username, $hash, $nama);
            mysqli_stmt_execute($ins);
            $user_id = mysqli_insert_id($conn);
        } elseif (password_verify($password, $row["password"])) {
            // Username sudah ada dan password cocok
            $user_id = $row["id"];
            $upd = mysqli_prepare($conn, "UPDATE users SET nama = ? WHERE id = ?");
            mysqli_stmt_bind_param($upd, "si", $nama, $user_id);
            mysqli_stmt_execute($upd);
        } else {
            $error = "Username ini sudah dipakai dengan password lain. Pakai username lain.";
        }

        if ($error === "") {
            session_regenerate_id(true);
            $_SESSION["user_id"] = $user_id;
            $_SESSION["nama"]    = $nama;
            header("Location: dashboard.php");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Masuk</title>
<style>
  :root {
    --bg: #eef2f1;
    --panel: #ffffff;
    --ink: #1c2b2a;
    --muted: #5d6f6d;
    --line: #c9d6d3;
    --accent: #0f6b5c;
    --accent-dark: #0a4f44;
    --danger: #b3261e;
    --danger-bg: #fbeae8;
  }
  * { box-sizing: border-box; }
  body {
    margin: 0; min-height: 100vh; display: grid; place-items: center;
    background: var(--bg); color: var(--ink);
    font-family: "Segoe UI", system-ui, -apple-system, Arial, sans-serif;
    padding: 20px;
  }
  .card {
    width: 100%; max-width: 380px; background: var(--panel);
    border: 1px solid var(--line); border-radius: 12px; padding: 36px 32px;
  }
  h1 { margin: 0 0 6px; font-size: 1.6rem; }
  p.sub { margin: 0 0 24px; color: var(--muted); }
  label { display: block; margin-bottom: 6px; font-weight: 600; font-size: .95rem; }
  input {
    width: 100%; padding: 11px 12px; margin-bottom: 18px; font-size: 1rem;
    border: 1px solid var(--line); border-radius: 8px; background: #fff; color: var(--ink);
  }
  input:focus { outline: 3px solid rgba(15,107,92,.25); border-color: var(--accent); }
  button {
    width: 100%; padding: 12px; font-size: 1rem; font-weight: 600; cursor: pointer;
    border: 0; border-radius: 8px; background: var(--accent); color: #fff;
  }
  button:hover { background: var(--accent-dark); }
  button:focus-visible { outline: 3px solid rgba(15,107,92,.35); outline-offset: 2px; }
  .error {
    background: var(--danger-bg); color: var(--danger); border-radius: 8px;
    padding: 10px 12px; margin-bottom: 18px; font-size: .92rem;
  }
</style>
</head>
<body>
  <main class="card">
    <h1>Masuk</h1>
    <p class="sub">Isi data di bawah. Akun baru dibuat otomatis.</p>

    <?php if ($error): ?>
      <div class="error" role="alert"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" autocomplete="on">
      <label for="nama">Nama lengkap</label>
      <input type="text" id="nama" name="nama" required autofocus maxlength="100"
             value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>">

      <label for="username">Username</label>
      <input type="text" id="username" name="username" required maxlength="50"
             value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">

      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>

      <button type="submit">Masuk</button>
    </form>
  </main>
</body>
</html>
