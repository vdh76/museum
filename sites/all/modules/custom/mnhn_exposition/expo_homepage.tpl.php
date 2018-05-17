<?php
// Template Exposition Homepage
/**
 * @file list_expo.tpl.php
 *
 *
 * Available variables:
 * - $nid
 * - $title
 * - $type
 * - $subtitle 
 * - $date
 * - $image
 * - $chapo
 * 
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 */
 global $language;
$title='<strong>'.$title.'</strong>';
	if($subtitle!=''){
		$title.='<br/> '.$subtitle;
	}
?>
<div class="diapo">
    <?php print $image; ?>
    <div class="bkg_expo_home"></div>
    <div class="text">
    	<h3><a href="/<?php print $language->language;?>/<?php print drupal_get_path_alias('node/'.$nid);?>"><?php print $type; ?></a></h3>
	   <h2><a href="/<?php print $language->language;?>/<?php print drupal_get_path_alias('node/'.$nid);?>"><?php print $title; ?></a></h2>                                   
	   <p class="date"><a href="/<?php print $language->language;?>/<?php print drupal_get_path_alias('node/'.$nid);?>"><?php print $date; ?></a></p>
	   <p class="resume"><a href="/<?php print $language->language;?>/<?php print drupal_get_path_alias('node/'.$nid);?>"><?php print mnhn_content_clean_teaser($chapo,180); ?></a></p>
	   <a href="/<?php print $language->language;?>/<?php print drupal_get_path_alias('node/'.$nid);?>" class="link_gallery"><?php print t('More details') ?></a>
   </div>
</div>

	
