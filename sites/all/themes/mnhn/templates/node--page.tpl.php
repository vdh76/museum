<div class="page-header">
<?php 
if($node->title){
	print '<h1>'.$node->title.'</h1>';
}
?>
<?php 
$uri=$node->field_page_visuel['und'][0]['uri'];
if(!empty($uri)){
	print '<img src="'.file_create_url($uri).'" width="575" height="212" alt="'.$node->field_page_visuel['und'][0]['alt'].'">';
}

?>
<?php 
if(!empty($node->field_page_chapo['und'][0]['value'])){
	print '<div class="chapo"><p>'.nl2br($node->field_page_chapo['und'][0]['value']).'</p></div>';
}
?>
</div>
<div class="page-detail-wrapper">
                    

<?php 


if($node->field_page_bloc['und'][0]['value']>0){
	foreach($node->field_page_bloc['und'] as $bloc_entity_id){
		$blocs[]=$bloc_entity_id['value'];
	}
	
	$output.=mnhn_content_bloc_page($blocs);
}
$output.=mnhn_content_list_keywords($node->field_keyword['und']); 
print $output;
?>
</div>
