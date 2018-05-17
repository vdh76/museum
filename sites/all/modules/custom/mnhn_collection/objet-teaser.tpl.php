<?php
// Template Objet
/**
 * @file objet.tpl.php
 *
 *
 * Available variables:
 * - $nid
 * - $image
 * - $title
 * - $chapo
 * - $ajax
 * 
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 */




global $language;
($ajax==1)?$link='javascript:;':$link='/'.$language->language.'/'.drupal_get_path_alias('node/'.$nid);
($objet==0)?$class='list_item_collection':'';

?>

  <div class="list_item <?php print $class?>" rel="<?php print $nid;?>">
      <a href="<?php print $link; ?>" class="link_collec_img"><?php print $image?></a>
      <div class="text">
           <h3> <a href="<?php print $link; ?>" class="link_collec_title"><?php print $title?></a></h3>
            <p><?php print $chapo?></p>
      </div>
      <a href="<?php print $link; ?>" class="link_collec"></a>
      <div class="objet_loading"></div>
   </div>                                         


