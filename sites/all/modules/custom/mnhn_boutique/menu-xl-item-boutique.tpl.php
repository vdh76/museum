<?php
// Template Menu XL Boutique
/**
 * @file menu-xl-item-boutique.tpl.php
 *
 *
 * Available variables:
 * - $boutique
 * 
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 */


//$menu_item=db_query('select options from menu_links  where mlid=:mlid',array(':mlid'=> MLID_AGENDA))->fetchField();
//print $menu_item;
//exit;
global $language;
$mlid_numeritheque=constant("MLID_BOUTIQUE_".strtoupper($language->language));
$options=db_query('select options from menu_links where mlid='.$mlid_numeritheque)->fetchField();
$description=unserialize($options);
?>
 <div class="bigmenu_left">
	<h2 class="title_bmenu_boutik"><?php print t('Explore the shop')?></h2>
    <div class="text">
       <p><?php print $description['attributes']['title']?></p>
       <a href="/<?php print $language->language?>/<?php print drupal_get_path_alias('boutique')?>" class="link"><?php print t('Shop now')?></a>
    </div>
</div>
<div id="entrees">
<?php print $boutique; ?>
</div>
