<?php 


/**
 * BO CONTACT
 * Destinataire email + Liste des objets
 *
 *
 */
function mnhn_contact_admin_mail_settings() {
	$objet=mnhn_content_objet();
	
	$form['mnhn_contact_mail'] = array( 
    '#type' => 'fieldset', 
    '#title' => t('Destinataire email'), 
   ); 
	
	foreach($objet as $key => $value){
		if($key!="0"){
				$form['mnhn_contact_mail']['mnhn_contact_mail_'.$key] = array( 
			    '#type' => 'textfield', 
			    '#title' => t($value), 
			    '#required' => TRUE,
			    '#default_value' => variable_get('mnhn_contact_mail_'.$key, ''), 
			   ); 
		}
	}
	

  return system_settings_form($form); 

}

/**
 * BO CONTACT
 * Texte footer
 *
 *
 */
function mnhn_contact_admin_textes_settings() {
	
	
	
	global $language;
   //print_r(variable_get('mnhn_contact_bloc', ''));
   //exit;
   $defaults = array(
    'value' => '',
    'format' => filter_default_format(),
  );
  $bloc = variable_get('mnhn_contact_bloc_'.$language->language, $defaults);
   

   $form['mnhn_contact_bloc_'.$language->language] = array( 
    '#type' => 'text_format', 
    '#title' => t('Bloc footer formulaire'), 
    '#required' => TRUE,
    '#cols' => 50,
    '#rows' => 10,
    '#default_value' => $bloc['value'], 
    '#format' => 'full_html'
   ); 
   
   
   
   
   
  
   
  
  
   
 
   

  return system_settings_form($form); 

}


?>