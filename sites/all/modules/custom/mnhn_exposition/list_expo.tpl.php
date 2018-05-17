<?php
// Template Liste petit visuel
/**
 * @file list_expo.tpl.php
 *
 *
 * Available variables:
 * - $nid
 * - $title 
 * - $subtitle
 * - $date
 * - $image
 * - $chapo
 * - $type
 * - $period
 * 
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 */
 global $language;

?>
<?php 
if($type=='a_la_une'){
	$title='<strong>'.$title.'</strong>';
	if($subtitle!=''){
		$title.='<br/> '.$subtitle;
	}
	?>
	<div class="a_la_une">
		<?php print $image; ?>
		<div class="text">
			<h2></h2>
	   		<h1><?php print $title; ?></h1>
	   		<p class="dates"><?php print $date; ?></p>
	   		<p><?php print mnhn_content_clean_teaser($chapo,150); ?></p>
	   		<a href="/<?php print $language->language;?>/<?php print drupal_get_path_alias('node/'.$nid);?>" class="link"><?php print t('More details') ?></a>
	   </div>
	</div>
<?php }else{ 
if($subtitle!=''){
	$title.=', '.$subtitle;
}
	?>
	 <div class="item">
	     <?php print $image; ?>
	     <div class="text">
	          <h4><?php print $title; ?></h4>
	          <h5><?php print $date; ?></h5>
	          <p><?php print $chapo; ?></p>
	          <a href="/<?php print $language->language;?>/<?php print drupal_get_path_alias('node/'.$nid);?>" class="link"><?php print t('More details') ?></a>
	   </div>
	</div>
<?php } ?>