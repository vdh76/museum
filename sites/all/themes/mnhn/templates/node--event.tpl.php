<?php
$breacrumb=array();
$breacrumb[]=l('Accueil', '');
$breacrumb[]=l('Agenda', 'agenda');
drupal_set_breadcrumb($breacrumb);

	$date_debut=$node->field_event_date['und'][0]['value'];
	$date_fin=$node->field_event_date['und'][0]['value2'];
	
	if($date_debut>=time() && $date_fin<time()){
		$date=0;
	}elseif($date_debut<time() && $date_fin>time()){
		$date=time();
	}else{
		$date=$date_debut;
	}
	  
	print mnhn_agenda_calendar($date);
	
?>
