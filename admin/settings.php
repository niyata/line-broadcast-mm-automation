<?php
session_start();
if ($_SESSION["role"] !== "admin") {
  header("Location: ../login.php");
  exit;
}

include_once "../template/admin-menu.php";
$settings = json_decode(file_get_contents("../settings.json"), true);
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $settings = [
    "sheet_url" => $_POST["sheet_url"],
    "gas_url" => $_POST["gas_url"],
    "supabase_url" => $_POST["supabase_url"],
    "supabase_key" => $_POST["supabase_key"],
    "line_token" => $_POST["line_token"],
    "liff_id" => $_POST["liff_id"]
  ];
  file_put_contents("../settings.json", json_encode($settings, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
  $success = "✅ บันทึกการตั้งค่าสำเร็จแล้ว";
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>ตั้งค่าระบบ</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
  <h2 class="mb-4">⚙️ ตั้งค่าระบบ</h2>

  <?php if ($success): ?>
    <div class="alert alert-success"><?php echo $success; ?></div>
  <?php endif; ?>

  <form method="post">
    <div class="mb-3">
      <label class="form-label">🔗 Google Sheet URL</label>
      <input type="url" name="sheet_url" value="<?php echo $settings["sheet_url"] ?? ""; ?>" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">🔗 Google Apps Script URL</label>
      <input type="url" name="gas_url" value="<?php echo $settings["gas_url"] ?? ""; ?>" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">🧠 Supabase API URL</label>
      <input type="url" name="supabase_url" value="<?php echo $settings["supabase_url"] ?? ""; ?>" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">🔑 Supabase API Key</label>
      <input type="text" name="supabase_key" value="<?php echo $settings["supabase_key"] ?? ""; ?>" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">💬 LINE Channel Access Token</label>
      <input type="text" name="line_token" value="<?php echo $settings["line_token"] ?? ""; ?>" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">🧩 LIFF ID</label>
      <input type="text" name="liff_id" value="<?php echo $settings["liff_id"] ?? ""; ?>" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">💾 บันทึกการตั้งค่า</button>
  </form>
</div>

<footer class="text-center mt-5 text-muted">
  <hr>
  พัฒนาโดย <a href="https://www.facebook.com/niyatajayo" target="_blank">@niyatajayo</a>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
