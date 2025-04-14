<?php
session_start();
if (!isset($_SESSION["username"])) {
  header("Location: login.php");
  exit;
}
include "../template/menu.php";
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>Flex Message Editor</title>
  <style>
    body { font-family: sans-serif; padding: 2em; background: #f4f4f4; }
    textarea { width: 100%; height: 300px; font-family: monospace; }
    iframe { width: 100%; height: 400px; border: 1px solid #ccc; margin-top: 1em; }
    button { padding: 10px 20px; margin-top: 10px; }
  </style>
</head>
<body>
  <h2>🎨 Flex Message Editor</h2>
  <form id="editorForm">
    <textarea id="flexJson">{
  "type": "bubble",
  "hero": {
    "type": "image",
    "url": "https://example.com/image.jpg",
    "size": "full",
    "aspectRatio": "20:13",
    "aspectMode": "cover"
  },
  "body": {
    "type": "box",
    "layout": "vertical",
    "contents": [
      { "type": "text", "text": "ตัวอย่าง Flex", "weight": "bold", "size": "xl" },
      { "type": "text", "text": "รายละเอียดเพิ่มเติม", "wrap": true }
    ]
  }
}</textarea><br>
    <button type="button" onclick="previewFlex()">👁 ดูพรีวิว</button>
    <button type="button" onclick="copyJson()">📋 คัดลอก JSON</button>
  </form>

  <iframe id="previewFrame" srcdoc="<p style='text-align:center;'>🖼 ตัวอย่างจะปรากฏที่นี่</p>"></iframe>

  <script>
    function previewFlex() {
      const json = document.getElementById("flexJson").value;
      const previewFrame = document.getElementById("previewFrame");
      previewFrame.srcdoc = `<pre style='white-space:pre-wrap;'>` + json + `</pre>`;
    }

    function copyJson() {
      const textarea = document.getElementById("flexJson");
      textarea.select();
      document.execCommand("copy");
      alert("✅ คัดลอกเรียบร้อยแล้ว");
    }
  </script>
</body>
</html>
