<div class="page-detail-wrapper">

<?php 


if($node->title){
	$output='<h1>'.$node->title.'</h1>';
}

if(!empty($node->field_ecard_sous_titre['und'][0]['value'])){
	$output.='<div class="chapo">'.$node->field_ecard_sous_titre['und'][0]['value'].'</div>';
}

$uri=$node->field_ecard_visuel['und'][0]['uri'];
if(!empty($uri)){
	$output.='<img src="'.file_create_url($uri).'" width="590"  alt="'.$node->field_ecard_visuel['und'][0]['alt'].'">';
}

print $output;
?>
</div>
<div class="clear"></div>
<br/><br/><br/>