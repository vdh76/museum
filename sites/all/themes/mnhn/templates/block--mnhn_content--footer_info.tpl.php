<?php
/**
 * @file
 * Zen theme's implementation to display a block.
 *
 * Available variables:
 * - $title: Block title.
 * - $content: Block content.
 * - $block->module: Module that generated the block.
 * - $block->delta: An ID for the block, unique within each module.
 * - $block->region: The block region embedding the current block.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - block: The current template type, i.e., "theming hook".
 *   - block-[module]: The module generating the block. For example, the user
 *     module is responsible for handling the default user navigation block. In
 *     that case the class would be "block-user".
 *   - first: The first block in the region.
 *   - last: The last block in the region.
 *   - odd: An odd-numbered block in the region's list of blocks.
 *   - even: An even-numbered block in the region's list of blocks.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Helper variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $block_zebra: Outputs 'odd' and 'even' dependent on each block region.
 * - $zebra: Same output as $block_zebra but independent of any block region.
 * - $block_id: Counter dependent on each block region.
 * - $id: Same output as $block_id but independent of any block region.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 * - $block_html_id: A valid HTML ID and guaranteed unique.
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 * @see zen_preprocess_block()
 * @see template_process()
 * @see zen_process_block()
 */
global $language;
?>

<div class="footer_info">
	<p class="title address"><?php print t("Address")?></p>
	<p><?php print nl2br(variable_get('mnhn_footer_adresse_'.$language->language, ''));?></p>
</div>	
<div class="footer_info">
	<p class="title time"><?php print t("Hours")?></p>
	<p><?php print nl2br(variable_get('mnhn_footer_horaire_'.$language->language, ''));?></p>
</div>	
<div class="footer_info last">
	<p class="title close"><?php print t("Closing")?></p>
	<p><?php print nl2br(variable_get('mnhn_footer_fermeture_'.$language->language, ''));?></p>
</div>	
<?php 

$link_vimeo=variable_get('mnhn_bloc_en_ligne_vimeo', '');
$link_twitter=variable_get('mnhn_bloc_en_ligne_twitter', '');
$link_facebook=variable_get('mnhn_bloc_en_ligne_facebook', '');
$link_flickr=variable_get('mnhn_bloc_en_ligne_flickr', '');
$link_google_plus=variable_get('mnhn_bloc_en_ligne_google', '');
  print '<div class="reso_footer">
	<a href="/'.$language->language.'/rss.xml" target="_blank" title="Flux RSS"><img src="/'.drupal_get_path('theme','mnhn').'/css/images/picto_rss.png"></a>
	<a href="'.$link_vimeo.'" target="_blank" title="Vimeo"><img src="/'.drupal_get_path('theme','mnhn').'/css/images/picto_vimeo.png"></a>
	<a href="'.$link_twitter.'" target="_blank" title="Twitter"><img src="/'.drupal_get_path('theme','mnhn').'/css/images/picto_twitter.png"></a>
	<a href="'.$link_facebook.'" target="_blank" title="Facebook"><img src="/'.drupal_get_path('theme','mnhn').'/css/images/picto_facebook.png"></a>
	<a href="'.$link_flickr.'" target="_blank" title="Flickr"><img src="/'.drupal_get_path('theme','mnhn').'/css/images/picto_flickr.png"></a>
	<a href="'.$link_google_plus.'" target="_blank" title="Google plus"><img src="/'.drupal_get_path('theme','mnhn').'/css/images/picto_google_plus.png"></a>
</div>
';


?>

