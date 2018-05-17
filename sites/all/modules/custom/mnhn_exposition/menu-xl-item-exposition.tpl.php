<?php
// Template Menu XL Exposition
/**
 * @file menu-xl-item-exposition.tpl.php
 *
 *
 * Available variables:
 * - $expositions
 * 
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 */


//$menu_item=db_query('select options from menu_links  where mlid=:mlid',array(':mlid'=> MLID_AGENDA))->fetchField();
//print $menu_item;
//exit;
global $language;
$mlid_exposition=constant("MLID_EXPOSITION_".strtoupper($language->language));
$options=db_query('select options from menu_links where mlid='.$mlid_exposition)->fetchField();
$description=unserialize($options);
?>
 <div class="bigmenu_left">
	<h2 class="title_bmenu"><?php print t('Explore exhibitions')?></h2>
    <div class="text">
       <p><?php print $description['attributes']['title']?></p>
       <a href="/<?php print $language->language?>/<?php print drupal_get_path_alias('expositions'); ?>" class="link"><?php print t('View all events'); ?></a>
       <a href="/<?php print $language->language?>/expositions-itinerantes" class="link"><?php print 'Voir toutes les expositions itinérantes'; ?></a>
    </div>
</div>
<div class="bigmenu_right">
<?php print $expositions; ?>
</div>
