<?php
// Template Menu XL Collection
/**
 * @file menu-xl-item-collection.tpl.php
 *
 *
 * Available variables:
 * - $collections
 * 
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 */



global $language;
$link_collection = variable_get('mnhn_bloc_link_collection_'.$language->language, '');
$mlid_collection=constant("MLID_COLLECTION_".strtoupper($language->language));
$options=db_query('select options from menu_links where mlid='.$mlid_collection)->fetchField();
$description=unserialize($options);
$ouverture_bdd_collection=variable_get('mnhn_bdd_collection', '');

if($user->uid==0 && $ouverture_bdd_collection==0){
	$nid_deploiement=variable_get('mnhn_deploiement_'.$language->language, '');
	$nid_deploiement=mnhn_content_autocomplete_nid($nid_deploiement);
	$link_collection = '/'.drupal_get_path_alias('node/'.$nid_deploiement);
	
}else{
	$link_collection = variable_get('mnhn_bloc_link_collection_'.$language->language, '');
}
?>

<div id="collections_generale">
     <h2 class="title_bmenu2"><?php print t('Explore collections')?></h2>
     <div class="text">
           <p><?php print $description['attributes']['title'];?></p>
           <a href="<?php print $link_collection?>" class="link" target="_blank"><?php print t('View online collections')?></a>
    </div>
</div>
<?php print $collections; ?>
                       


