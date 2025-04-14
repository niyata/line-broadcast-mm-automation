<?php
$settings = json_decode(file_get_contents(__DIR__ . '/../settings.json'), true);
?>
<script>
  window.APP_CONFIG = {
    liffId: "<?php echo $settings['liff_id'] ?? ''; ?>",
    lineToken: "<?php echo $settings['line_token'] ?? ''; ?>"
  };
</script>
