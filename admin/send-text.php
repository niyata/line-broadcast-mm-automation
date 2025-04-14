<?php
session_start();
if (!in_array($_SESSION["role"], ["admin", "sender"])) {
  header("Location: ../login.php");
  exit;
}
include "../template/menu.php";
?>
<h2>📩 ส่งข้อความปกติผ่าน LINE OA</h2>
<form method="post" action="../submit.php">
  <label>ข้อความ:</label><br>
  <input type="text" name="message" required><br>
  <label>ลิงก์ภาพ (optional):</label><br>
  <input type="text" name="imageUrl"><br>
  <label>หมายเหตุ:</label><br>
  <textarea name="note"></textarea><br>
  <button type="submit">📨 ส่งข้อความ</button>
</form>
