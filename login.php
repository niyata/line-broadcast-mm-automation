<?php
session_start();
$users = json_decode(file_get_contents(__DIR__ . "/config/users.json"), true);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  foreach ($users as $user) {
    if ($user["username"] === $_POST["username"] && $user["password"] === $_POST["password"]) {
      $_SESSION["username"] = $user["username"];
      $_SESSION["role"] = $user["role"];

      // ✅ Redirect ตามบทบาท
      if ($user["role"] === "admin") {
        header("Location: admin/dashboard.php");
      } elseif ($user["role"] === "content_manager") {
        header("Location: settings.php");
      } else {
        header("Location: form.html");
      }
      exit;
    }
  }
  echo "❌ เข้าสู่ระบบไม่สำเร็จ";
}
?>
<form method="post">
  <h3>🔐 เข้าสู่ระบบ</h3>
  <input name="username" placeholder="ชื่อผู้ใช้">
  <input name="password" type="password" placeholder="รหัสผ่าน">
  <button type="submit">เข้าสู่ระบบ</button>
</form>
