<?php
session_start();
if (!in_array($_SESSION["role"], ["admin", "content"])) {
  header("Location: ../login.php");
  exit;
}
include_once "../template/admin-menu.php";
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>Flex Builder</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    textarea { font-family: monospace; }
    #previewFlex { background: #f5f5f5; border-radius: 10px; padding: 1em; }
  </style>

  <link rel="stylesheet" href="../assets/css/flex-builder.css">
  <script defer src="../assets/js/flex-builder.js">
function saveToSupabase() {
  const json = document.getElementById("jsonOutput").value;
  fetch("../api/save-favorite.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ userId: "mock-user", json: json })
  })
  .then(res => res.text())
  .then(res => alert("✅ บันทึกสำเร็จ"))
  .catch(err => alert("❌ เกิดข้อผิดพลาด"));
}

function testSend() {
  const json = JSON.parse(document.getElementById("jsonOutput").value);
  const payload = {
    to: "USER_OR_GROUP_ID",
    messages: [{ type: "flex", altText: "Flex ทดสอบ", contents: json }]
  };
  fetch("https://api.line.me/v2/bot/message/push", {
    method: "POST",
    headers: {
      "Authorization": "Bearer YOUR_LINE_CHANNEL_ACCESS_TOKEN",
      "Content-Type": "application/json"
    },
    body: JSON.stringify(payload)
  }).then(r => {
    if (r.ok) alert("✅ ส่งทดสอบสำเร็จ");
    else alert("❌ ส่งไม่สำเร็จ");
  });
}
</script>
</head>
<body>
<div class="container py-5">
  <h2 class="mb-4">🎨 Flex Message Builder (Beta)</h2>
  <p>วาง JSON แล้วดูพรีวิวตัวอย่าง (ยังไม่ใช่แบบ Drag & Drop)</p>

  <div class="mb-3">
  <div class="d-flex gap-2 mb-3">
    <button class="btn btn-outline-success" onclick="saveToSupabase()">💾 Save Flex</button>
    <button class="btn btn-outline-primary" onclick="testSend()">🚀 Test ส่งให้ตัวเอง</button>
  </div>
    <label class="form-label">📦 Flex Message JSON</label>
    <textarea id="flexJson" class="form-control" rows="10" placeholder='{ "type": "bubble", ... }'></textarea>
  </div>

  <div class="mb-3">
  <div class="d-flex gap-2 mb-3">
    <button class="btn btn-outline-success" onclick="saveToSupabase()">💾 Save Flex</button>
    <button class="btn btn-outline-primary" onclick="testSend()">🚀 Test ส่งให้ตัวเอง</button>
  </div>
    <button class="btn btn-primary" onclick="previewFlex()">👁 พรีวิว</button>
  </div>

  <h5 class="mt-4">👁 พรีวิว Flex Message</h5>
  <pre id="previewFlex">(ยังไม่มีตัวอย่าง)</pre>
</div>

<footer class="text-center mt-5 text-muted">
  <hr>
  พัฒนาโดย <a href="https://www.facebook.com/niyatajayo" target="_blank">@niyatajayo</a>
</footer>

<script>
function previewFlex() {
  const box = document.getElementById("previewFlex");
  try {
    const obj = JSON.parse(document.getElementById("flexJson").value);
    box.textContent = JSON.stringify(obj, null, 2);
  } catch (e) {
    box.innerHTML = "<span class='text-danger'>❌ รูปแบบ JSON ไม่ถูกต้อง</span>";
  }
}

function saveToSupabase() {
  const json = document.getElementById("jsonOutput").value;
  fetch("../api/save-favorite.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ userId: "mock-user", json: json })
  })
  .then(res => res.text())
  .then(res => alert("✅ บันทึกสำเร็จ"))
  .catch(err => alert("❌ เกิดข้อผิดพลาด"));
}

function testSend() {
  const json = JSON.parse(document.getElementById("jsonOutput").value);
  const payload = {
    to: "USER_OR_GROUP_ID",
    messages: [{ type: "flex", altText: "Flex ทดสอบ", contents: json }]
  };
  fetch("https://api.line.me/v2/bot/message/push", {
    method: "POST",
    headers: {
      "Authorization": "Bearer YOUR_LINE_CHANNEL_ACCESS_TOKEN",
      "Content-Type": "application/json"
    },
    body: JSON.stringify(payload)
  }).then(r => {
    if (r.ok) alert("✅ ส่งทดสอบสำเร็จ");
    else alert("❌ ส่งไม่สำเร็จ");
  });
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
function saveToSupabase() {
  const json = document.getElementById("jsonOutput").value;
  fetch("../api/save-favorite.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ userId: "mock-user", json: json })
  })
  .then(res => res.text())
  .then(res => alert("✅ บันทึกสำเร็จ"))
  .catch(err => alert("❌ เกิดข้อผิดพลาด"));
}

function testSend() {
  const json = JSON.parse(document.getElementById("jsonOutput").value);
  const payload = {
    to: "USER_OR_GROUP_ID",
    messages: [{ type: "flex", altText: "Flex ทดสอบ", contents: json }]
  };
  fetch("https://api.line.me/v2/bot/message/push", {
    method: "POST",
    headers: {
      "Authorization": "Bearer YOUR_LINE_CHANNEL_ACCESS_TOKEN",
      "Content-Type": "application/json"
    },
    body: JSON.stringify(payload)
  }).then(r => {
    if (r.ok) alert("✅ ส่งทดสอบสำเร็จ");
    else alert("❌ ส่งไม่สำเร็จ");
  });
}
</script>
</body>
</html>
