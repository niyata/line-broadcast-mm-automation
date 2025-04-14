function handlePush(data) {
  const payload = {
    to: data.groupId,
    messages: [{
      type: "text",
      text: data.message
    }]
  };
  if (data.imageFullsize) {
    payload.messages.push({
      type: "image",
      originalContentUrl: data.imageFullsize,
      previewImageUrl: data.imageThumbnail || data.imageFullsize
    });
  }

  UrlFetchApp.fetch("https://api.line.me/v2/bot/message/push", {
    method: "post",
    contentType: "application/json",
    headers: {
      "Authorization": "Bearer " + data.lcat
    },
    payload: JSON.stringify(payload)
  });

  return ContentService.createTextOutput(JSON.stringify({ status: "sent" }))
    .setMimeType(ContentService.MimeType.JSON);
}