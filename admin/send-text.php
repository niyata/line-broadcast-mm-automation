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
  <title>ส่งข้อความไปยัง LINE Group</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    #linePreview { background: #f1f1f1; border-radius: 1rem; padding: 1rem; margin-top: 1rem; }
  </style>
</head>
<body>
<div class="container py-5">
  <h2 class="mb-4">📨 ส่งข้อความไปยัง LINE Group</h2>

  <form id="messageForm">
    <div class="mb-3">
      <label class="form-label">เลือกกลุ่ม LINE</label>
      <select id="groupSelect" class="form-select" required></select>
    </div>

    <div id="groupInfo" class="mb-3 small text-muted"></div>

    <div class="mb-3">
      <label class="form-label">ข้อความ</label>
      <input type="text" id="message" class="form-control" oninput="updatePreview()" required>
    </div>

    <div class="mb-3">
      <label class="form-label">ลิงก์ภาพ (ถ้ามี)</label>
      <input type="url" id="imageUrl" class="form-control" oninput="updatePreview()">
    </div>

    <div class="mb-3">
      <label class="form-label">หมายเหตุ (ไม่บังคับ)</label>
      <textarea id="note" class="form-control" rows="2" oninput="updatePreview()"></textarea>
    </div>

    <div class="d-flex gap-2">
      <button type="button" class="btn btn-outline-secondary" onclick="loadSample()">📥 ทดสอบส่ง</button>
      <button type="button" class="btn btn-primary" onclick="submitForm()">📢 เผยแพร่</button>
    </div>
  </form>

  <div id="linePreview">
    <strong>👁 พรีวิว:</strong>
    <div id="previewMessages" class="mt-2 text-dark">— ไม่มีข้อความ —</div>
  </div>

  <div id="result" class="mt-3"></div>
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

function updatePreview() {
  const msg = document.getElementById("message").value;
  const img = document.getElementById("imageUrl").value;
  const note = document.getElementById("note").value;
  let html = "";

  if (msg) html += `<div class='alert alert-light border'>📩 ${msg}</div>`;
  if (img) html += `<div><img src="${img}" class="img-fluid rounded mb-2"></div>`;
  if (note) html += `<small class='text-muted'>📝 ${note}</small>`;
  if (!html) html = "— ไม่มีข้อความ —";

  document.getElementById("previewMessages").innerHTML = html;
}

function loadSample() {
  document.getElementById("message").value = "📢 ตัวอย่างข้อความสำหรับทดสอบระบบ";
  document.getElementById("imageUrl").value = "https://www.training.com.au/wp-content/uploads/Full-Stack-Developer-1.jpeg";
  document.getElementById("note").value = "📝 หมายเหตุ: ส่งทดสอบโดยผู้ใช้งาน";
  document.getElementById("groupSelect").selectedIndex = 1;
  updatePreview();
}

function submitForm() {
  const index = document.getElementById("groupSelect").value;
  if (index === "") return alert("กรุณาเลือกกลุ่ม");

  const row = groupData[index];
  if (row["เปิด-ปิด (กลุ่ม)"] !== "✅") return alert("กลุ่มนี้ปิดรับแจ้งเตือน");

  const now = new Date();
  const time = now.toTimeString().substring(0,5);
  const [start, end] = row["ช่วงเวลา"].split("–");
  if (time < start || time > end) {
    alert(`⏰ อยู่นอกช่วงเวลาแจ้งเตือนที่กำหนด (${start} - ${end})`);
    return;
  }

  const payload = {
    message: document.getElementById("message").value,
    groupId: row["LINE Group ID"],
    imageFullsize: document.getElementById("imageUrl").value,
    imageThumbnail: document.getElementById("imageUrl").value,
    note: document.getElementById("note").value,
    lcat: row["LCAT"],
    timestamp: now.toISOString()
  };

  fetch("../submit.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(payload)
  }).then(r => r.text()).then(res => {
    document.getElementById("result").innerHTML = `<div class="alert alert-success">✅ ส่งสำเร็จ</div>`;
  }).catch(err => {
    document.getElementById("result").innerHTML = `<div class="alert alert-danger">❌ ${err}</div>`;
  });
}

window.onload = loadGroups;
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<?php include('template/footer.php'); ?>
</body>
</html>
