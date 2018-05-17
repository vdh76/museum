<?php 


/**
 * Export XML
 * Evénements Museum
 *
 *
 */	 
function mnhn_agenda_xml(){

	
	
   header('Content-Type: text/xml');
   header("Cache-Control: no-cache, must-revalidate");
   //header("Content-Disposition: attachment; filename=agenda_mnhn_lehavre_synhcro.xml");
    $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
	$xml .= "\t".'<evenements>'."\n";
   //and field_annee_pub_article_value=\'%s\'
   global $language;
  
   $result=db_query('SELECT nid from node where type=:type and language=:language',array(':type' => 'event', ':language' => $language->language));
  
	foreach($result as $row){
		$node=node_load($row->nid);
			
		$date_debut=$node->field_event_date['und'][0]['value'];
		$date_fin=$node->field_event_date['und'][0]['value2'];
		$tid=mnhn_content_get_tid($row->nid,3);
		$categorie=mnhn_content_get_term($tid);
		$tid_cible=$node->field_event_cible['und'][0]['tid'];
		$cible=mnhn_content_get_term($tid_cible);
		$horaire=$node->field_event_horaire['und'][0]['value'];
		$duree=$node->field_event_duree['und'][0]['value'];
        $public=$node->field_event_public['und'][0]['value'];
		$tarif=$node->field_event_tarif['und'][0]['value'];
		$lieu=$node->field_event_lieu['und'][0]['value'];
		$animateur=$node->field_event_animateur['und'][0]['value'];
		$description=$node->field_event_description['und'][0]['value'];
		$lien='http://'.$_SERVER["SERVER_NAME"].'/'.$language->language.'/'.drupal_get_path_alias('node/'.$row->nid).'#detail';
		$uri_carre=$node->field_event_visuel['und'][0]['uri'];
		$uri_file=$node->field_event_file['und'][0]['uri'];
		$description=$node->field_event_description['und'][0]['value'];
		$description = preg_replace("/&#?[a-z0-9]{2,8};/i","",$description);
		$i++;
		
		

   
   
   
		   $xml .= "\t\t".'<evenement>'."\n";
		   $xml .= "\t\t\t".'<id>'.$node->nid.'</id>'."\n";
		   $xml .= "\t\t\t".'<created>'.$node->created.'</created>'."\n";
		   $xml .= "\t\t\t".'<changed>'.$node->changed.'</changed>'."\n";
		   $xml .= "\t\t\t".'<statut>'.$node->status.'</statut>'."\n";
		   $xml .= "\t\t\t".'<titre>'.$node->title.'</titre>'."\n";
		   $xml .= "\t\t\t".'<lien>'.$lien.'</lien>'."\n";
		   $xml .= "\t\t\t".'<categorie>'.$categorie.'</categorie>'."\n";
		   $xml .= "\t\t\t".'<date_debut>'.$date_debut.'</date_debut>'."\n";
		   if($date_fin>$date_debut){
		  	 $xml .= "\t\t\t".'<date_fin>'.$date_fin.'</date_fin>'."\n";
		   }
		   $xml .= "\t\t\t".'<horaire>'.$horaire.'</horaire>'."\n";
           $xml .= "\t\t\t".'<duree>'.$duree.'</duree>'."\n";
           $xml .= "\t\t\t".'<public>'.$public.'</public>'."\n";
		   $xml .= "\t\t\t".'<tarif>'.$tarif.'</tarif>'."\n";
		   $xml .= "\t\t\t".'<lieu>'.$lieu.'</lieu>'."\n";
		   $xml .= "\t\t\t".'<detail>'.$description.'</detail>'."\n";
		   
 		   if($uri_carre!=''){
		   	 $xml .= "\t\t\t".'<visuel_carre>'.file_create_url($uri_carre).'</visuel_carre>'."\n";
		   }
		  
		if($uri_file!=''){
		   	 $xml .= "\t\t\t".'<fichier>'.file_create_url($uri_file).'</fichier>'."\n";
		   }
		  
		
		   foreach($node->field_keyword['und'] as $keyword){
		   		if($keyword['tid']>0){
		   			$tab_keyword[]=mnhn_content_get_term($keyword['tid']);	
		   		}
		   }
		   if(sizeof($tab_keyword['tid'])>0){
		   	$xml .= "\t\t\t".'<mot_cle>'.implode('-',$tab_keyword).'</mot_cle>'."\n";
		   }
		 $xml .= "\t\t".'</evenement>'."\n";   
	 }	   

	 $xml .= "\t".'</evenements>'."\n";
   
   echo $xml;
    	
		
}



