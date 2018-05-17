<?php 

function mnhn_content_lettre_subscription(){
	global $language;
	$message=variable_get('mnhn_letter_subscription_'.$language->language, '');
	$output='<h1>La Lettre du mnhn</h1><br/><br/>'.$message['value'];
	
	return $output;
}

function mnhn_content_lettre_subscription_confirmation(){
	global $language;
	$message=variable_get('mnhn_letter_subscription_confirmation_'.$language->language, '');
	$output='<h1>La Lettre du mnhn</h1><br/><br/>'.$message['value'];	
	return $output;
}

function mnhn_content_lettre_unsubscription(){
	global $language;
	$message=variable_get('mnhn_letter_unsubscription_'.$language->language, '');
	$output='<h1>La Lettre du mnhn</h1><br/><br/>'.$message['value'];	
	return $output;
}

function mnhn_content_admin_maichimp_settings() {
	
	global $language;
	 $bloc = variable_get('mnhn_letter_subscription_'.$language->language, $defaults);
   $form['mnhn_letter_subscription_'.$language->language] = array( 
    '#type' => 'text_format', 
    '#title' => t('Ecran inscription'), 
    '#required' => TRUE,
    '#cols' => 50,
    '#rows' => 15,
    '#default_value' => $bloc['value'],  
    '#format' => 'full_html'
   ); 
   
    $bloc = variable_get('mnhn_letter_subscription_confirmation_'.$language->language, $defaults);
   $form['mnhn_letter_subscription_confirmation_'.$language->language] = array( 
    '#type' => 'text_format', 
    '#title' => t('Ecran confirmation inscription'), 
    '#required' => TRUE,
    '#cols' => 50,
    '#rows' => 15,
    '#default_value' => $bloc['value'],  
    '#format' => 'full_html'
   ); 
   
    $bloc = variable_get('mnhn_letter_unsubscription_'.$language->language, $defaults);
   $form['mnhn_letter_unsubscription_'.$language->language] = array( 
    '#type' => 'text_format', 
    '#title' => t('Ecran confirmation désinscription'), 
    '#required' => TRUE,
    '#cols' => 50,
    '#rows' => 15,
    '#default_value' => $bloc['value'],  
    '#format' => 'full_html'
   ); 
   
   
   
   

  return system_settings_form($form); 

}

 

?>