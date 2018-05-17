<?php
// Template Liste visuels exposition
/**
 * @file exposition_visuel_liste.tpl.php
 *
 *
 * Available variables:
 * - $image
 * - $titre
 * - $sstitre
 * - $lien
 * - $position
 * - $oeuvre_id
 * 
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 */
$titre=mnhn_content_clean_teaser($titre,25);
($position==3)? $class='last':'';
if(!empty($sstitre)){
	$sstitre=mnhn_content_clean_teaser($sstitre,50);
	$titre.='&nbsp;<span>'.$sstitre.'</span>';
}
?>
 <div class="item">
   <div class="illustr">
     <a href="<?php print $lien;?>" class="zoom_link" title="<?php print strip_tags($titre); ?>" rel="visuel_<?php print $oeuvre_id; ?>">
      <?php print $image; ?>
     </a>
   </div>
   <a href="<?php print $lien;?>" class="zoom_link" title="<?php print strip_tags($titre); ?>" rel="visuel_<?php print $oeuvre_id; ?>">
     <h4><?php print $titre?></h4>
   </a> 
</div>
