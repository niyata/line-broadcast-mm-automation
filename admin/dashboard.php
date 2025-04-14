<?php
session_start();
if (!isset($_SESSION["username"])) {
  header("Location: ../login.php");
  exit;
}
include_once "../template/admin-menu.php";
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>แดชบอร์ดผู้ดูแลระบบ</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2 class="mb-4">👋 สวัสดี, <?php echo $_SESSION["username"]; ?>!</h2>

  <div class="row g-4">
    <div class="col-md-6 col-lg-4">
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <h5 class="card-title">🗂 จัดการข้อความ</h5>
          <p class="card-text">ส่งข้อความธรรมดาหรือข้อความ Flex ไปยัง LINE Group</p>
          <a href="send-text.php" class="btn btn-outline-primary">เปิดหน้าส่งข้อความ</a>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-4">
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <h5 class="card-title">🎨 Flex Builder</h5>
          <p class="card-text">สร้าง Flex Message ผ่าน Builder UI</p>
          <a href="flex-builder.php" class="btn btn-outline-primary">เริ่มสร้าง Flex</a>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-4">
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <h5 class="card-title">⚙️ ตั้งค่าระบบ</h5>
          <p class="card-text">แก้ไขข้อมูลเชื่อมต่อ เช่น Google Sheet, LINE, Supabase</p>
          <a href="settings.php" class="btn btn-outline-primary">ตั้งค่าระบบ</a>
        </div>
      </div>
    </div>
  </div>
</div>

<footer class="text-center mt-5 text-muted">
  <hr>
  พัฒนาโดย <a href="https://www.facebook.com/niyatajayo" target="_blank">@niyatajayo</a>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
