<?php 


/*
 * BO Collection
 * Texte schema interactif
 * 
 */
function mnhn_collection_admin_settings() {
	
	global $language;
	 $bloc = variable_get('mnhn_collection_txt_schema_'.$language->language, $defaults);
   	$form['mnhn_collection_txt_schema_'.$language->language] = array( 
    '#type' => 'text_format', 
    '#title' => t('Texte schéma interactif'), 
    '#required' => TRUE,
    '#cols' => 50,
    '#rows' => 15,
    '#default_value' => $bloc['value'],  
    '#format' => 'full_html'
   ); 
   
   
   
   

  return system_settings_form($form); 

}

/*
 * BO Collection
* Contenu Collection Lesueur
*
*/
function mnhn_collection_lesueur_admin_settings(){
	global $language;

	$form['mnhn_collection_lesueur_'.$language->language] = array(
			'#type' => 'textfield',
			'#title' => t('Collection Lesueur'),
			'#required' => TRUE,
			'#autocomplete_path' =>'mnhn/autocomplete/link',
			'#default_value' => variable_get('mnhn_collection_lesueur_'.$language->language, ''),
	);

	



	return system_settings_form($form);

}