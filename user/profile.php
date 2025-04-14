<?php session_start(); ?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>โปรไฟล์ผู้ใช้งาน</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
<?php include_once("../template/load-env.php"); ?>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .profile-img { border-radius: 50%; width: 120px; height: 120px; object-fit: cover; }
  </style>
</head>
<body>
<div class="container py-5">
  <h2 class="mb-4">👤 โปรไฟล์ผู้ใช้งานจาก LINE</h2>

  <div class="row">
    <div class="col-md-4 text-center">
      <img id="pictureUrl" class="profile-img" src="" alt="Profile">
    </div>
    <div class="col-md-8">
      <ul class="list-group">
        <li class="list-group-item"><strong>ชื่อที่แสดง:</strong> <span id="displayName">-</span></li>
        <li class="list-group-item"><strong>อีเมล:</strong> <span id="email">-</span></li>
        <li class="list-group-item"><strong>User ID:</strong> <span id="userId">-</span></li>
        <li class="list-group-item"><strong>Group ID:</strong> <code>(จากระบบ)</code></li>
        <li class="list-group-item"><strong>Channel Token:</strong> <code>(จากระบบ)</code></li>
        <li class="list-group-item"><strong>สถานะ Bot:</strong> <span id="botStatus">⏳ กำลังตรวจสอบ...</span></li>
      </ul>
    </div>
  </div>

  <div class="mt-4">
    <h4>⭐ Flex Message ที่คุณชื่นชอบ</h4>
    <div class="row" id="favFlex">
      <div class="col-md-6"><div class="card p-3">Flex Template #1</div></div>
      <div class="col-md-6"><div class="card p-3">Flex Template #2</div></div>
    </div>
  </div>
</div>

<footer class="text-center mt-5 text-muted">
  <hr>
  พัฒนาโดย <a href="https://www.facebook.com/niyatajayo" target="_blank">@niyatajayo</a>
</footer>

<script>
const LIFF_ID = window.APP_CONFIG.liffId;

async function init() {
  await liff.init({ liffId: LIFF_ID });
  if (!liff.isLoggedIn()) {
    liff.login();
    return;
  }

  const profile = await liff.getProfile();
  document.getElementById("displayName").textContent = profile.displayName;
  document.getElementById("pictureUrl").src = profile.pictureUrl;
  document.getElementById("userId").textContent = profile.userId;

  const decoded = liff.getDecodedIDToken();
  document.getElementById("email").textContent = decoded.email || "-";

  fetch("../api/check-line-status.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ lcat: "YOUR_LINE_TOKEN" })
  })
  .then(res => res.json())
  .then(res => {
    document.getElementById("botStatus").textContent =
      res.http_code === 200 ? "✅ พร้อมใช้งาน" : "❌ ไม่พร้อมใช้งาน";
  });
}

init();
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
