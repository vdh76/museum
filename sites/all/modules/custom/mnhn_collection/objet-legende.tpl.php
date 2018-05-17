<?php
// Template Objet
/**
 * @file objet_legende.tpl.php
 *
 *
 * Available variables:
 * - $nid
 * - $image
 * - $title
 * - $chapo
 * - $class
 * 
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 */
global $language;

$zone_objet=variable_get('objet_'.$nid, '0');
$class_fixed='';
if($zone_objet==0){
	$zone_objet='-9999,-9999';
}else{
	$class_fixed='fixed';
}

?>
<div rel="objet_<?php print $nid ?>" class="tip edit_marker <?php print $class_fixed ?>" data-coords="<?php print $zone_objet; ?>">
	  <div class="tip_init handler <?php print $class?>">
	  	<?php print $image;?>
	  	<h3><?php print $title?></h3>
	  </div>
	  <div class="tip_hover">		
	      <h3><?php print $title?></h3>
	      <?php print $image;?>
	      <div class="text_popup">
	      	<p><?php print mnhn_content_clean_teaser($chapo,110)?></p>
	        <a href="javascript:;" class="link_objet" rel="<?php print $nid?>"><?php print t('Scope note') ?></a>
	     </div>
     </div>
</div>