<?php
if (file_exists("installed.lock")) {
  header("Location: login.php");
  exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $config = [
    "sheet_url" => $_POST["sheet_url"],
    "gas_url" => $_POST["gas_url"],
    "supabase_url" => $_POST["supabase_url"],
    "supabase_key" => $_POST["supabase_key"],
    "liff_id" => $_POST["liff_id"],
    "line_token" => $_POST["line_token"]
  ];
  file_put_contents("settings.json", json_encode($config, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

  $admin = [
    "username" => "admin",
    "password" => password_hash($_POST["admin_password"], PASSWORD_DEFAULT),
    "role" => "admin"
  ];
  file_put_contents("users.json", json_encode([$admin], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

  file_put_contents("installed.lock", "true");
  header("Location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>ติดตั้งระบบ MM Automation</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container">
  <div class="card">
    <h2>🔧 ติดตั้งระบบแจ้งเตือนผ่าน LINE</h2>
    <form method="post">
      <label>📄 Google Sheet URL</label>
      <input type="url" name="sheet_url" required>

      <label>🔗 Google Apps Script Webhook URL</label>
      <input type="url" name="gas_url" required>

      <label>🧠 Supabase API URL</label>
      <input type="url" name="supabase_url" required>

      <label>🗝️ Supabase API Key</label>
      <input type="text" name="supabase_key" required>

      <label>💬 LINE Channel Access Token</label>
      <input type="text" name="line_token" required>

      <label>🧩 LIFF ID</label>
      <input type="text" name="liff_id" required>

      <label>🔐 ตั้งรหัสผ่านผู้ดูแลระบบ</label>
      <input type="password" name="admin_password" required>

      <br><br>
      <button type="submit">✅ ติดตั้งระบบ</button>
    </form>
  </div>
</div>
</body>
</html>
