<?php
// Template Menu XL Exposition Détail
/**
 * @file menu-xl-item-exposition-detail.tpl.php
 *
 *
 * Available variables:
 * - $node
 * 
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 */


global $language;

$type=$node->field_exposition_type['und'][0]['value'];
($type=='expo')? $type_expo=t('Exhibition'):$type_expo=t('Event');
$date_debut=$node->field_exposition_date['und'][0]['value'];
$date_fin=$node->field_exposition_date['und'][0]['value2'];
$date=mnhn_content_format_date_medium($date_debut,$date_fin);
$date_short_debut=mnhn_content_format_date_short($date_debut);
$subtitle=$node->field_exposition_sous_titre['und'][0]['value'];

$titre=$node->title;
if(!empty($subtitle)){
	$titre.=', '.$subtitle;
}

$uri=$node->field_exposition_visuel['und'][0]['uri'];   
if(!empty($uri)){
	//$ext = substr(strtolower(strrchr(basename($uri), ".")),1);
	//$uri=substr($uri,0,strlen($uri)-4).'_0.'.$ext;
	
	//$type_image=mnhn_content_get_image_type(file_create_url($uri),430/300);
	
	$image=theme('image_style', array('style_name' => 'menu', 'path' => $uri));
	
}


?>
<div class="item_menu tid-1">
     <div class="visuel">
          <a href="/<?php print $language->language?>/<?php print drupal_get_path_alias('node/'.$node->nid)?>#detail" title="<?php print $titre; ?>"><?php print $image?></a>
          <div class="fc-event-over-date">
              <div><a href="/<?php print $language->language?>/<?php print drupal_get_path_alias('node/'.$node->nid)?>#detail" title="<?php print $titre; ?>"><span class="day"><?php print $date_short_debut['d']?></span><br><span class="month"><?php print $date_short_debut['m']?></span><br><span class="year"><?php print $date_short_debut['y']?></span></a></div>
              <?php if($date_fin>$date_debut){
				$date_short_fin=mnhn_content_format_date_short($date_fin);
			?>
                <div class="between"><a href="/<?php print $language->language?>/<?php print drupal_get_path_alias('node/'.$node->nid)?>#detail" title="<?php print $titre; ?>"><span>&gt;</span></a></div>
           		<div><a href="/<?php print $language->language?>/<?php print drupal_get_path_alias('node/'.$node->nid)?>#detail" title="<?php print $titre; ?>"><span class="day"><?php print $date_short_fin['d']?></span><br><span class="month"><?php print $date_short_fin['m']?></span><br><span class="year"><?php print $date_short_fin['y']?></span></a></div>
      		<?php } ?>
      </div>
</div>
<h4><?php print $type_expo; ?> :</h4>
<h3><a href="/<?php print $language->language?>/<?php print drupal_get_path_alias('node/'.$node->nid)?>#detail" title="<?php print $titre; ?>"><?php print $titre; ?></a></h3>
<p><?php print mnhn_content_teaser($node->field_exposition_chapo['und'][0], 90)?></p>
    <div class="links">
          <a href="/<?php print $language->language?>/<?php print drupal_get_path_alias('node/'.$node->nid)?>#detail" class="link"><?php print t('More details') ?></a>
     </div>
</div>

