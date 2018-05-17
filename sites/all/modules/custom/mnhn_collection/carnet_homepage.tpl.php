<?php
// Template Carnet Homepage
/**
 * @file list_expo.tpl.php
 *
 *
 * Available variables:
 * - $nid
 * - $title
 * - $image
 * 
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 */
 global $language;

?>
<div class="item_carnet">
   <a href="/<?php print $language->language?>/<?php print drupal_get_path_alias('node/'.$nid)?>" title="<?php print $title; ?>"><?php print $image; ?></a>
   <h3><?php print t('Charles-Alexandre Lesueur\'s travels')?></h3>
   <h2><a href="/<?php print $language->language?>/<?php print drupal_get_path_alias('node/'.$nid)?>" title="<?php print $title; ?>"><?php print $title; ?></a></h2>
</div>

	
