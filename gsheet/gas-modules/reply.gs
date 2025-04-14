function handleReply(data) {
  const payload = {
    replyToken: data.replyToken,
    messages: [{
      type: "text",
      text: data.message
    }]
  };

  UrlFetchApp.fetch("https://api.line.me/v2/bot/message/reply", {
    method: "post",
    contentType: "application/json",
    headers: {
      "Authorization": "Bearer " + data.lcat
    },
    payload: JSON.stringify(payload)
  });

  return ContentService.createTextOutput(JSON.stringify({ status: "replied" }))
    .setMimeType(ContentService.MimeType.JSON);
}