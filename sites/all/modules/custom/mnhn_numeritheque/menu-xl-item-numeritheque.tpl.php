<?php
// Template Menu XL Numérithèque
/**
 * @file menu-xl-item-numeritheque.tpl.php
 *
 *
 * Available variables:
 * - $numeritheque
 * 
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 */


//$menu_item=db_query('select options from menu_links  where mlid=:mlid',array(':mlid'=> MLID_AGENDA))->fetchField();
//print $menu_item;
//exit;
global $language;
$mlid_numeritheque=constant("MLID_NUMERITHEQUE_".strtoupper($language->language));
$options=db_query('select options from menu_links where mlid='.$mlid_numeritheque)->fetchField();
$description=unserialize($options);
?>
 <div class="bigmenu_left">
	<h2 class="title_bmenu_numtk"><?php print t('Explore the resources')?></h2>
    <div class="text">
       <p><?php print $description['attributes']['title']?></p>
       <a href="/<?php print $language->language?>/<?php print drupal_get_path_alias('numeritheque')?>" class="link"><?php print t('View all resources')?></a>
    </div>
</div>
<div id="entrees">
<?php print $numeritheque; ?>
</div>
