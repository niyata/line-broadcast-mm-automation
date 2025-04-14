<?php
session_start();
if (isset($_SESSION["username"])) {
  header("Location: admin/dashboard.php");
  exit;
}

$errors = [];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $users = json_decode(file_get_contents("users.json"), true);
  foreach ($users as $user) {
    if ($user["username"] === $_POST["username"] &&
        password_verify($_POST["password"], $user["password"])) {
      $_SESSION["username"] = $user["username"];
      $_SESSION["role"] = $user["role"];
      header("Location: admin/dashboard.php");
      exit;
    }
  }
  $errors[] = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>เข้าสู่ระบบ</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
  <div class="card p-4 shadow" style="width: 100%; max-width: 400px;">
    <h3 class="text-center mb-4">🔐 เข้าสู่ระบบ</h3>
    <?php if ($errors): ?>
      <div class="alert alert-danger"><?php echo implode("<br>", $errors); ?></div>
    <?php endif; ?>
    <form method="post">
      <div class="mb-3">
        <label class="form-label">👤 ชื่อผู้ใช้</label>
        <input type="text" name="username" class="form-control" required autofocus>
      </div>
      <div class="mb-3">
        <label class="form-label">🔑 รหัสผ่าน</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <div class="d-grid">
        <button type="submit" class="btn btn-primary">เข้าสู่ระบบ</button>
      </div>
    </form>
    <p class="text-center text-muted mt-3 small">พัฒนาโดย <a href="https://www.facebook.com/niyatajayo" target="_blank">@niyatajayo</a></p>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<?php include('template/footer.php'); ?>
</body>
</html>
