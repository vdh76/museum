<?php
// Template Evenement Homepage
/**
 * @file list_expo.tpl.php
 *
 *
 * Available variables:
 * - $nid
 * - $title
 * - $subtitle 
 * - $jour
 * - $mois
 * - $annee
 * - $theme
 * - $image
 * 
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 */
 global $language;

?>
<h3><?php print $title; ?></h3>
<div class="event">
    <div class="date_event">
        <p class="jour"><?php print $jour; ?></p>
        <p class="mois"><?php print $mois; ?></p>
        <p class="year"><?php print $annee; ?></p>
    </div>
    <div class="text_event">
        <h4><a href="/fr/<?php print drupal_get_path_alias('node/'.$nid)?>#detail" title="<?php print $title; ?>"><?php print $theme; ?></a></h4>
        <h3><a href="/fr/<?php print drupal_get_path_alias('node/'.$nid)?>#detail" title="<?php print $title; ?>"><?php print $title; ?></a></h3>
        <p><?php print mnhn_content_clean_teaser($subtitle,60); ?></p>
   </div>
   <a href="/fr/<?php print drupal_get_path_alias('node/'.$nid)?>#detail" title="<?php print $title; ?>"><?php !empty($image)?print $image:''; ?></a>
</div>
	
