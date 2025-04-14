<?php session_start(); ?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>Medited Media (MM Automation)</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">MM Automation</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">หน้าแรก</a></li>
        <?php if (!isset($_SESSION["username"])): ?>
          <li class="nav-item"><a class="nav-link" href="login.php">หน้าล็อกอิน</a></li>
        <?php endif; ?>
        <li class="nav-item"><a class="nav-link" href="about.php">เกี่ยวกับฉัน</a></li>
        <li class="nav-item"><a class="nav-link" href="apps.php">โปรแกรมแนะนำ</a></li>
        <li class="nav-item"><a class="nav-link" href="community.php">การมีส่วนร่วม</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container my-5">
  <div class="text-center">
    <h1 class="display-5">ยินดีต้อนรับสู่ระบบแจ้งเตือน LINE OA</h1>
    <p class="lead">แพลตฟอร์มที่ช่วยให้หน่วยงานสามารถสื่อสารกับกลุ่มเป้าหมายผ่าน LINE ได้อย่างมีประสิทธิภาพ</p>
  </div>

  <div class="row mt-4">
    <div class="col-md-6 mb-3">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title">✅ ระบบสิทธิ์</h5>
          <p class="card-text">แยกหน้าที่ผู้ใช้ตามสิทธิ์ เช่น แอดมิน, ผู้ส่ง, ผู้จัดเนื้อหา</p>
        </div>
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title">✅ รองรับข้อความ, รูป, Flex</h5>
          <p class="card-text">ส่งข้อความทุกรูปแบบผ่าน LINE OA ได้ง่ายและสะดวก</p>
        </div>
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title">✅ เชื่อม Google Sheet</h5>
          <p class="card-text">ดึงข้อมูลกลุ่มและสิทธิ์จาก Google Sheet แบบเรียลไทม์</p>
        </div>
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title">✅ CMS ติดตั้งง่าย</h5>
          <p class="card-text">ติดตั้งและใช้งานง่ายเหมือน WordPress หรือ Joomla</p>
        </div>
      </div>
    </div>
  </div>
</div>

<footer class="bg-light text-center py-3 border-top mt-5">
  พัฒนาโดย <a href="https://www.facebook.com/niyatajayo" target="_blank">@niyatajayo</a>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
