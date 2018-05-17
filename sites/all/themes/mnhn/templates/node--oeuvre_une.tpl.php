<div class="page-detail-wrapper">

<?php 
if(arg(0)!='collections'){
	drupal_add_js(
	'jQuery(function() {
		jQuery(".menu-vertical li.first li.last").addClass("activ");
	});'
	,
	'inline');
}

if($node->title){
	$output='<h1>'.$node->title.'</h1>';
}

$uri=$node->field_oeuvre_une_visuel['und'][0]['uri'];
if(!empty($uri)){
	$output.='<img src="'.file_create_url($uri).'" width="590" height="140" alt="'.$node->field_oeuvre_une['und'][0]['alt'].'">';
}

if(!empty($node->field_oeuvre_une_chapo['und'][0]['value'])){
	$output.='<div class="chapo">'.nl2br($node->field_oeuvre_une_chapo['und'][0]['value']).'</div>';
}

foreach($node->field_page_bloc['und'] as $bloc_entity_id){
	$blocs[]=$bloc_entity_id['value'];
}

$output.=mnhn_content_bloc_page($blocs);

print $output;

?>
</div>
<div class="clear"></div>
<br/><br/><br/>