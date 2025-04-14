function getUserTime() {
  const now = new Date();
  return Utilities.formatDate(now, Session.getScriptTimeZone(), "HH:mm");
}