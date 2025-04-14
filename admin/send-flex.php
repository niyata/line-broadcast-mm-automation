<?php
session_start();
if (!in_array($_SESSION["role"], ["admin", "sender"])) {
  header("Location: ../login.php");
  exit;
}
include "../template/menu.php";
?>
<h2>🎨 ส่ง Flex Message</h2>
<form method="post" action="../submit.php">
  <label>Flex JSON:</label><br>
  <textarea name="flexJson" rows="12" style="width:100%;font-family:monospace;"></textarea><br>
  <button type="submit">🚀 ส่ง Flex Message</button>
</form>
