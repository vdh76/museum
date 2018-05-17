<div class="visite-detail-wrapper">

<?php 


if($node->title){
	$output='<h1>'.$node->title.'</h1>';
}

if($node->field_visite_event['und'][0]['nid']>0){ 
	$output.='<div class="calendar-events">
					<div class="calendar-events-list select_month">';
					
						foreach($node->field_visite_event['und'] as $event){
							if($event['nid']>0){
								$event=node_load($event['nid']);
								$events.=theme('evenement', array('node' => $event,'template'=>'html'));
							}	
						} 
						$output.=$events;
						
					$output.='</div>
				
					<div id="calendar-events-details">
						<a href="javascript:;" onclick="backCalendarEventsList();" class="back"></a>
						<div class="calendar-events-details-body"></div>
					</div>	
				</div>';
}					
$output.='<div id="wrap_visite_detail">';
foreach($node->field_visite_bloc['und'] as $bloc_entity_id){
	$blocs[]=$bloc_entity_id['value'];
}

$field_bloc_item = entity_load('field_collection_item', $blocs);
	
	foreach ($field_bloc_item as $bloc ) {
	
		if(!empty($bloc->field_bloc_visite_title['und'][0]['value'])){
			$output.=theme('visite',array('title' => $bloc->field_bloc_visite_title['und'][0]['value'], 'description' => $bloc->field_bloc_visite_description['und'][0]['value']));
		}
		
	}	



print $output;
?>
</div>
</div>
<div class="clear"></div>
<br/><br/><br/>