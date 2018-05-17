<?php
// Template Liste petit visuel
/**
 * @file liste-2.tpl.php
 *
 *
 * Available variables:
 * - $title 
 * - $subtitle
 * - $image
 * - $text
 * - $link
 * - $class
 * - $onglet
 * 
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 */
 global $language;

?>

<?php 
switch($class){
	case 'list':

		if(!empty($subtitle)){
			$title.='&nbsp;<span>'.$subtitle.'</span>';
		}
		$output='<div class="'.$class.'">';
		$output.='<h2>'.$title.'</h2>';
		$output.=$image;
		$output.='<div class="teaser">'.$text.'</div>';
		if(!empty($link)){ 
			$output.='>&nbsp;<a href="/'.$language->language.'/'.drupal_get_path_alias($link).'">'.t('More information').'</a>';
		 }
		$output.='</div>';
		$output.='<div class="clear"></div>';
		
	break;

	case 'list-big':

		if(!empty($subtitle)){
			$subtitle=str_replace("au","<br/>au",$subtitle);
		}
		$output='<div class="'.$class.'">';
		if(!empty($onglet)){
			$output.='<span class="category">'.$onglet.'</span>';
		}
		$output.=$image;
		$output.='<div>';
		$output.='<span class="title">'.$title.'</span>';
		$output.='<span class="subtitle">'.$subtitle.'</span>';
		$output.='<a class="more-link" href="/'.$language->language.'/'.drupal_get_path_alias($link).'">'.t('More information').'</a>';
		$output.='</div>';
		$output.='</div>';
		$output.='<br/>';
	break;	

	case 'list-small':

		$output='<div class="'.$class.'">';
		$output.=$image;
		$output.='<p class="title">'.$title.'</p>';
		$output.='<p class="subtitle">'.$subtitle.'</p>';
		$output.='<p class="link">>&nbsp;<a href="/'.$language->language.'/'.drupal_get_path_alias($link).'">'.t('More information').'</a></p>';
		$output.='</div>';
		
	break;
}
	print $output;
		 
?>
					
					

