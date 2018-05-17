<?php
// Template Menu XL Item
/**
 * @file menu-xl-item.tpl.php
 *
 *
 * Available variables:
 * - $main_link 
 * - $image
 * - $title
 * - $description
 * - $links
 * 
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 */

?>
<div class="item_menu">
	<div class="visuel">
		<?php print l($image,$main_link,array('html'=>TRUE, array('title' => $title))); ?>
	</div>
	<h3><?php print l($title,$main_link,array(array('title' => $title))); ?></h3>
	<?php if(!empty($description)){ ?>
		<p><?php print $description?></p>
	<?php } ?>
	<div class="links">
		<?php print $links ?>
	</div>
</div>