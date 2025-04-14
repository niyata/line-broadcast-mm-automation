function doGet(e) {
  return ContentService.createTextOutput("LINE Bot Webhook Active");
}

function doPost(e) {
  const data = JSON.parse(e.postData.contents);
  const type = data.type || "push";

  switch (type) {
    case "push":
      return handlePush(data);
    case "reply":
      return handleReply(data);
    case "getGroups":
      return ContentService.createTextOutput(JSON.stringify(getGroups()))
        .setMimeType(ContentService.MimeType.JSON);
    default:
      return ContentService.createTextOutput("Unknown request type").setMimeType(ContentService.MimeType.TEXT);
  }
}