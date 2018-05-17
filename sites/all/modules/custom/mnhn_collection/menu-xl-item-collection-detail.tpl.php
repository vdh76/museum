<?php
// Template Menu XL Exposition Détail
/**
 * @file menu-xl-item-exposition-detail.tpl.php
 *
 *
 * Available variables:
 * - $image
 * - $link
 * - $title
 * 
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 */

?>

<div class="link_collec">
       <a href="/<?php print $link?>" title="<?php print $title; ?>"><?php print $image; ?></a>
     <a href="/<?php print $link?>" class="link" title="<?php print $title; ?>"><?php print $title; ?></a>
</div>


