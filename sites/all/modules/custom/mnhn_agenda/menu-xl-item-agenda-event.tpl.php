<?php
// Template Menu XL Agenda Evenement
/**
 * @file menu-xl-item-agenda-event.tpl.php
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



$date_debut=$node->field_event_date['und'][0]['value'];
$date_fin=$node->field_event_date['und'][0]['value2'];
$date=mnhn_content_format_date_medium($date_debut,$date_fin);
$date_short_debut=mnhn_content_format_date_short($date_debut);
$tid=$node->field_event_type['und'][0]['tid'];	
$term=taxonomy_term_load($tid);
$theme=i18n_taxonomy_term_name($term, $language->language);
$uri=$node->field_event_visuel['und'][0]['uri'];   
if(!empty($uri)){
	
	
	$image=theme('image_style', array('style_name' => 'menu', 'path' => $uri));
	
}

?>
<div class="item_menu tid-<?php print $tid ?>">
     <div class="visuel">
          <a href="/fr/<?php print drupal_get_path_alias('node/'.$node->nid)?>#detail" title="<?php print $node->title; ?>"><?php print $image?></a>
          <div class="fc-event-over-date">
              <div><a href="/fr/<?php print drupal_get_path_alias('node/'.$node->nid)?>#detail" title="<?php print $node->title; ?>"><span class="day"><?php print $date_short_debut['d']?></span><br><span class="month"><?php print $date_short_debut['m']?></span><br><span class="year"><?php print $date_short_debut['y']?></span></a></div>
              <?php if($date_fin>$date_debut){
				$date_short_fin=mnhn_content_format_date_short($date_fin);
			?>
                <div class="between"><a href="/fr/<?php print drupal_get_path_alias('node/'.$node->nid)?>#detail"  title="<?php print $node->title; ?>"><span>&gt;</span></a></div>
           		<div><a href="/fr/<?php print drupal_get_path_alias('node/'.$node->nid)?>#detail"  title="<?php print $node->title; ?>"><span class="day"><?php print $date_short_fin['d']?></span><br><span class="month"><?php print $date_short_fin['m']?></span><br><span class="year"><?php print $date_short_fin['y']?></span></a></div>
      		<?php } ?>
      </div>
</div>
<h4><?php print $theme; ?> :</h4>
<h3><a href="/fr/<?php print drupal_get_path_alias('node/'.$node->nid)?>#detail"  title="<?php print $node->title; ?>"><?php print $node->title; ?></a></h3>
<p><?php print $node->field_event_sous_titre['und'][0]['value']?></p>
    <div class="links">
          <a href="/fr/<?php print drupal_get_path_alias('node/'.$node->nid)?>#detail" class="link"><?php print t('More details')?></a>
     </div>
</div>

