<?php
session_start();
if ($_SESSION["role"] !== "admin") {
  header("Location: ../login.php");
  exit;
}
include "../template/menu.php";
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="container">
  <div class="card">
    <h2>📊 ระบบ Dashboard</h2>
    <p>ยินดีต้อนรับ <strong><?= $_SESSION["username"] ?></strong></p>
  </div>

  <div class="card">
    <h3>🔎 สถานะการเชื่อมต่อ</h3>
    <ul>
      <li>📄 Google Sheet: <span style='color:green;'>✓ พร้อมใช้งาน</span></li>
      <li>🖼 Google Drive Folder ID: <span style='color:green;'>✓ เข้าถึงได้</span></li>
      <li>🔐 LINE Token: <span style='color:red;'>✗ หมดอายุ</span></li>
    </ul>
    <p style="font-size:0.9em;color:#999;">* การตรวจสอบนี้เป็น placeholder — สามารถเชื่อม API จริงในเวอร์ชันถัดไป</p>
  </div>
</div>
<footer>
  พัฒนาโดย <a href="https://www.facebook.com/niyatajayo" target="_blank">@niyatajayo</a>
</footer>
</body>
</html>
