<?php
if (file_exists(__DIR__ . "/../config/installed.lock")) {
  header("Location: ../index.php");
  exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $config = [
    "sheet_url" => $_POST["sheet_url"],
    "webhook_url" => $_POST["webhook_url"],
    "upload_url" => $_POST["upload_url"]
  ];
  file_put_contents(__DIR__ . "/../config/settings.json", json_encode($config, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

  $default_users = [[
    "username" => "admin",
    "password" => "admin123",
    "role" => "admin"
  ]];
  file_put_contents(__DIR__ . "/../config/users.json", json_encode($default_users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
  file_put_contents(__DIR__ . "/../config/installed.lock", "installed");

  echo "✅ ติดตั้งระบบสำเร็จแล้ว! <a href='../login.php'>เข้าสู่ระบบ</a>";
  exit;
}
?>
<h2>🚀 ติดตั้งระบบแจ้งเตือน LINE OA (v1.0.7)</h2>
<form method="post">
  <label>📊 Google Sheet API URL</label><br>
  <input name="sheet_url" required><br>
  <label>📡 Webhook URL</label><br>
  <input name="webhook_url" required><br>
  <label>🖼 Upload Script URL</label><br>
  <input name="upload_url" required><br><br>
  <button type="submit">✅ ติดตั้งระบบ</button>
</form>
