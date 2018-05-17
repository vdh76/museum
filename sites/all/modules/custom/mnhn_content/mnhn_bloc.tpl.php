<?php
// Template Bloc colonne de droite
/**
 * @file mnhn_bloc.tpl.php
 *
 *
 * Available variables:
 * - $bloc_id
 * - $title 
 * - $content
 * - $state
 * 
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 */
global $language;
if($state==2){
	$class_state='accordeon closed';
	$class_bottom='picto_bottom';
	$class_bloc='closed';
}

if($state==1){
	$class_state='accordeon';
}


?>
<div class="wrap_bloc_mnhn wrap_<?php print $bloc_id?>">
	<div class="bloc_mnhn <?php print $class_bloc?>" id="<?php print $bloc_id?>">
		<h3 class="<?php print $class_state?>"><?php print $title?></h3>
		<?php print $content; ?>
	</div>
</div>
