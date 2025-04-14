<?php session_start(); ?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>Medited Media (MM Automation)</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header>
  <h1>🚀 Medited Media</h1>
  <h3>MM Automation Platform</h3>
</header>

<nav>
  <a href="index.php">หน้าแรก</a>
  <?php if (!isset($_SESSION["username"])): ?>
    <a href="login.php">หน้าล็อกอิน</a>
  <?php endif; ?>
  <a href="about.php">เกี่ยวกับฉัน</a>
  <a href="apps.php">โปรแกรมแนะนำ</a>
  <a href="community.php">การมีส่วนร่วม</a>
</nav>

<div class="container">
  <div class="card">
    <h2>👋 ยินดีต้อนรับสู่ระบบ Automation แจ้งเตือนผ่าน LINE</h2>
    <p>แพลตฟอร์มนี้ช่วยให้การสื่อสารระหว่างองค์กรและกลุ่มเป้าหมายผ่าน LINE กลายเป็นเรื่องง่ายและอัตโนมัติ</p>
    <ul>
      <li>✅ ระบบสิทธิ์แยกตามบทบาท</li>
      <li>✅ ส่งข้อความ + รูปภาพ + Flex Message</li>
      <li>✅ ดึงข้อมูลจาก Google Sheet</li>
      <li>✅ ระบบตั้งค่าและติดตั้งแบบ CMS</li>
      <li>✅ พร้อมรองรับการเติบโต</li>
    </ul>
  </div>
</div>

<footer>
  พัฒนาโดย <a href="https://www.facebook.com/niyatajayo" target="_blank">@niyatajayo</a>
</footer>

</body>
</html>
