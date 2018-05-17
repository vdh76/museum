<?php
// Template Menu XL Agenda
/**
 * @file menu-xl-item-agenda.tpl.php
 *
 *
 * Available variables:
 * - $events
 * 
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 */


//$menu_item=db_query('select options from menu_links  where mlid=:mlid',array(':mlid'=> MLID_AGENDA))->fetchField();
//print $menu_item;
//exit;
global $language;
$mlid_agenda=constant("MLID_AGENDA_".strtoupper($language->language));
$options=db_query('select options from menu_links where mlid='.$mlid_agenda)->fetchField();
$description=unserialize($options);
?>
 <div class="bigmenu_left">
	<h2 class="title_bmenu"><?php print t('This month at the Museum')?></h2>
    <div class="text">
       <p><?php print $description['attributes']['title']?></p>
       <a href="/<?php print $language->language?>/agenda" class="link"><?php print t('View all events')?></a>
    </div>
</div>
<div class="bigmenu_right">
<?php print $events; ?>
</div>
