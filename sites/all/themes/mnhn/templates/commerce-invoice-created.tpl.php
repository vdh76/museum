<?php

/**
 * @file
 */
?>
<?php if ($created): ?>
  <div class="commerce-invoice-created">
      <strong><?php print $label; ?></strong> <?php print substr($created,0,10); ?>
  </div>
<?php endif; ?>
