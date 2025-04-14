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
  <title>ส่ง Flex Message ไปยัง LINE Group</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
  <h2 class="mb-4">💬 ส่ง Flex Message ไปยัง LINE Group</h2>

  <form id="flexForm">
    <div class="mb-3">
      <label class="form-label">เลือกกลุ่ม LINE</label>
      <select id="groupSelect" class="form-select" required></select>
    </div>

    <div id="groupInfo" class="mb-3 small text-muted"></div>

    <div class="mb-3">
      <label class="form-label">Flex Message JSON</label>
      <textarea id="flexJson" class="form-control" rows="10" required placeholder='{ "type": "bubble", ... }'></textarea>
    </div>

    <button type="button" class="btn btn-primary" onclick="submitFlex()">📤 ส่ง Flex</button>
  </form>

  <div id="result" class="mt-4"></div>
</div>

<script>
let groupData = [];

function loadGroups() {
  fetch("../groups.json").then(res => res.json()).then(data => {
    groupData = data;
    const select = document.getElementById("groupSelect");
    data.forEach((row, i) => {
      const opt = document.createElement("option");
      opt.value = i;
      opt.text = row["ชื่อกอง"] + " - " + row["ชื่อสำนัก"];
      select.appendChild(opt);
    });
  });
}

function submitFlex() {
  const index = document.getElementById("groupSelect").value;
  if (index === "") return alert("กรุณาเลือกกลุ่ม");
  const row = groupData[index];

  const flex = document.getElementById("flexJson").value;
  try { JSON.parse(flex); } catch {
    alert("รูปแบบ JSON ไม่ถูกต้อง");
    return;
  }

  const payload = {
    to: row["LINE Group ID"],
    messages: [{ type: "flex", altText: "📦 Flex Message", contents: JSON.parse(flex) }]
  };

  fetch("https://api.line.me/v2/bot/message/push", {
    method: "POST",
    headers: {
      "Authorization": "Bearer " + row["LCAT"],
      "Content-Type": "application/json"
    },
    body: JSON.stringify(payload)
  }).then(r => {
    if (r.status === 200) {
      document.getElementById("result").innerHTML = "<div class='alert alert-success'>✅ ส่ง Flex สำเร็จ</div>";
    } else {
      document.getElementById("result").innerHTML = "<div class='alert alert-danger'>❌ ไม่สามารถส่ง Flex ได้</div>";
    }
  });
}

window.onload = loadGroups;
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<?php include('template/footer.php'); ?>
</body>
</html>
