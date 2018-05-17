<?php
// Template Aventure Edito
/**
 * @file aventure_edito.tpl.php
 *
 *

 * 
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 */
 global $language;
 global $user;
 
$edito=variable_get('mnhn_aventure_edito_'.$language->language, array());
?>
 <div id="salut" class="box col1 moving" data-grid="">
<img src="/sites/all/themes/mnhn/pics/visuels/rat.png" alt="" class="illustr" />
<?php print nl2br($edito['value']);?>
</div>