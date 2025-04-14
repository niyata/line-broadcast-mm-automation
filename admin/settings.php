<?php
session_start();
if ($_SESSION["role"] !== "admin") {
  header("Location: ../login.php");
  exit;
}
include "../template/menu.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  file_put_contents("../config/settings.json", json_encode($_POST, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
  echo "<p style='color:green;'>✅ บันทึกเรียบร้อย</p><a href='settings.php'>← กลับ</a>";
  exit;
}

$settings = file_exists("../settings.json") ? json_decode(file_get_contents("../config/settings.json"), true) : [];
?>
<h2>⚙️ ตั้งค่าระบบ</h2>
<form method="post">
  <label>📊 Google Sheet API URL</label><br>
  <input type="text" name="sheet_url" value="<?= $settings['sheet_url'] ?? '' ?>"><br>
  <label>📡 Webhook URL (Google Script)</label><br>
  <input type="text" name="webhook_url" value="<?= $settings['webhook_url'] ?? '' ?>"><br>
  <label>🖼️ Upload URL (Google Script)</label><br>
  <input type="text" name="upload_url" value="<?= $settings['upload_url'] ?? '' ?>"><br><br>
  <button type="submit">💾 บันทึกการตั้งค่า</button>
</form>
