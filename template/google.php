<?php echo '<?xml version="1.0" encoding="utf-8"?>'; ?>
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:g="http://base.google.com/ns/1.0">
  <?php foreach ($_records as $_entry): ?>
  <entry>
    <id><![CDATA[<?php echo $_entry['sku']; ?>]]></id>
    <title><![CDATA[<?php echo $_entry['name']; ?>]]></title>
    <summary><![CDATA[<?php echo $_entry['description']; ?>]]></summary>
    <!-- Google product category -->
    <link><![CDATA[<?php echo $_entry['path']; ?>]]></link>
    <?php foreach ($_entry['image'] as $_idx => $_image): ?>
    <?php if ($_idx === 0): ?>
    <g:image_link><![CDATA[<?php echo $_image['file']; ?>]]></g:image_link>
    <?php else: ?>
    <g:additional_image_link><![CDATA[<?php echo $_image['file']; ?>]]></g:additional_image_link>
    <?php endif; ?>
    <?php endforeach; ?>

    <g:availability><![CDATA[<?php echo $_entry['stock']; ?>]]></g:availability>
    <g:price><![CDATA[<?php echo $_entry['price']; ?>]]></g:price>
    <g:brand><![CDATA[<?php echo $_entry['brand']; ?>]]></g:brand>

  </entry>
  <?php endforeach; ?>
</feed>