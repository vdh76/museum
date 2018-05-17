<?php 

/**
 * BO MUMA
 * Fermeture Hebdo // Fermeture exceptionnelle
 *
 *
 */
function mnhn_agenda_calendar_admin_hebdo_settings() {
	

	 $form['mnhn_calendar_close_week_wrap'] = array( 
    '#type' => 'fieldset', 
    '#title' => t('Fermeture hebdomadaire'), 
   ); 

   $form['mnhn_calendar_close_week_wrap']['mnhn_calendar_close_week'] = array( 
    '#type' => 'radios', 
    
    '#options' => array(
			  'Lundi',
			  'Mardi',
			  'Mercredi',
			  'Jeudi',
			  'Vendredi',
			  'Samedi',
			  'Dimanche'),
    '#required' => TRUE,
   '#default_value' => variable_get('mnhn_calendar_close_week', ''), 
   ); 
   
  
  
   $form['mnhn_calendar_close_excp_wrap'] = array( 
    '#type' => 'fieldset', 
    '#title' => t('Fermeture exceptionnelle'),
   ); 

   
   for($i=1;$i<11;$i++){
	    $form['mnhn_calendar_close_excp_wrap']['mnhn_calendar_close_excp_'.$i] = array( 
	    '#type' => 'textfield', 
	     
	    '#size' => 5,
	    '#maxlength' => 5,
	    '#default_value' => variable_get('mnhn_calendar_close_excp_'.$i, ''), 
	    '#description' => 'format jj/mm (exemple 01/01)'
	   );
   } 
  
  
 
   

  return system_settings_form($form); 

}


?>