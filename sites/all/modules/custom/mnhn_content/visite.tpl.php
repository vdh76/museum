<?php
// Template Bloc visite guidée
/**
 * @file visite.tpl.php
 *
 *
 * Available variables:
 * - $title 
 * - $description
 * 
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 */


?>
<div class="bloc_visite">
	<div class="bloc_visite_title"><?php print $title?></div>
	<div class="bloc_visite_border"></div>
	<div class="bloc_visite_description"><?php print $description; ?></div>
</div>