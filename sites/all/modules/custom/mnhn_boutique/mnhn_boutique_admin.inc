<?php 


/*
 * BO Boutique
 * Paramétrage poids
 * 
 */
function mnhn_boutique_poids_admin_settings(){
	
	$form['carton'] = array(
			'#type' => 'fieldset',
			'#title' => t('Emballage carton'),
	);
	
	$form['carton']['mnhn_boutique_carton_poids'] = array(
			'#type' => 'textfield',
			'#title' => t('Poids'),
			'#description' => t('en gramme'),
			'#default_value' => variable_get('mnhn_boutique_carton_poids', '0'),
	);
	
	$form['carton']['mnhn_boutique_carton_tranche'] = array(
			'#type' => 'textfield',
			'#title' => t('Tranche'),
			'#description' => t('en gramme'),
			'#default_value' => variable_get('mnhn_boutique_carton_tranche', '0'),
	);
	
	$form['tranche'] = array(
			'#type' => 'fieldset',
			'#title' => t('Tranche de poids'),
	);
	
	for($i=1;$i<=15;$i++){
		
		$form['tranche']['mnhn_boutique_tranche_poids_'.$i] = array(
				'#type' => 'textfield',
				'#title' => t('Tranche '.$i),
				'#description' => t('en gramme'),
				'#default_value' => variable_get('mnhn_boutique_tranche_poids_'.$i, '0'),
		);
		
	}
	
	return system_settings_form($form);
}


/*
 * BO Boutique
* Prix par zone
*
*/
function mnhn_boutique_prix_admin_settings() {
	
   global $language;
   
	   $zone=arg(3);
	   if($zone=='fr' || $zone=='ue'){
	   	$countries=country_get_list();
		   	$form['zone']['mnhn_boutique_'.$zone.'_countries'] = array(
		   			'#type' => 'select',
		   			'#title' => t('Liste des pays '),
		   			'#options' => $countries,
		   			'#multiple' => TRUE,
		   			'#size' => 20,
		   			'#default_value' => variable_get('mnhn_boutique_'.$zone.'_countries', array()),
		   	);
	   }
	   $old_tranche=0;
	   for($i=1;$i<=15;$i++){
	   		$tranche=variable_get('mnhn_boutique_tranche_poids_'.$i, '0');
	   		
	   		if($tranche>0){
	   			
		   		$form['tranche']['mnhn_boutique_tranche_'.$zone.'_'.$i] = array(
		   			'#type' => 'textfield',
		   			'#title' => t('Tranche '.$old_tranche.'-'.$tranche.' g'),
		   			'#description' => t('en euros (exemple 0.53)'),
		   			'#default_value' => variable_get('mnhn_boutique_tranche_'.$zone.'_'.$i, '0'),
		   		);
		   		
		   		/*
		   		$form['tranche']['mnhn_boutique_tranche_'.$zone.'_type_'.$i] = array(
		   				'#type' => 'textfield',
		   				'#title' => t('Type'),
		   				'#description' => t('Ecopli, Lettre prioritaire, Lettre eco internationale'),
		   				'#default_value' => variable_get('mnhn_boutique_tranche_'.$zone.'_type_'.$i, ''),
		   		);
		   		*/
		   		$old_tranche=$tranche;
	   		}
	   		
	   		
	   	
	   	
	   }
	   
	   
  
  return system_settings_form($form); 

}


/*
 * BO Boutique
* Configuration générale
*
*/
function mnhn_boutique_configuration_settings() {

	global $language;
	
	$form['mnhn_boutique_cgv_'.$language->language] = array(
			'#type' => 'textfield',
			'#title' => t('Conditions générales de ventes'),
			'#required' => TRUE,
			'#autocomplete_path' =>'mnhn/autocomplete/link',
			'#default_value' => variable_get('mnhn_boutique_cgv_'.$language->language, ''),
	);
	
	$form['mnhn_boutique_email'] = array(
			'#type' => 'textfield',
			'#title' => t('Destinataire email commande'),
			'#default_value' => variable_get('mnhn_boutique_email', ''),
	);

	$form['mnhn_boutique_produit_une_'.$language->language] = array(
			'#type' => 'textfield',
			'#title' => t('Produit à la une'),
			'#autocomplete_path' =>'boutique/autocomplete',
			'#default_value' => variable_get('mnhn_boutique_produit_une_'.$language->language, ''),
	);
	
	$form['poids_max'] = array(
			'#type' => 'fieldset',
			'#title' => t('Poids maximum de commande'),
	);
	$form['poids_max']['mnhn_boutique_poids_max_'.$language->language] = array(
			'#type' => 'textfield',
			'#title' => t('Poids maximum'),
			'#required' => TRUE,
			'#description' => 'en gramme',
			'#default_value' => variable_get('mnhn_boutique_poids_max_'.$language->language, '0'),
	);
	$form['poids_max']['mnhn_boutique_poids_max_message_'.$language->language] = array(
			'#type' => 'textarea',
			'#title' => t('Message d\'alerte'),
			'#required' => TRUE,
			'#default_value' => variable_get('mnhn_boutique_poids_max_message_'.$language->language, ''),
	);
	 
	
	$form['tipi'] = array(
			'#type' => 'fieldset',
			'#title' => t('TIPI'),
	);
	
	$form['tipi']['mnhn_boutique_tipi_statut'] = array(
			'#type' => 'select',
			'#title' => t('Statut'),
			'#options' => array('Test','Activation','Production'),
			'#default_value' => variable_get('mnhn_boutique_tipi_statut', 'Test'),
	);
	 
	$bloc_tipi = variable_get('mnhn_boutique_tipi_'.$language->language, $defaults);
	$form['tipi']['mnhn_boutique_tipi_'.$language->language] = array(
			'#type' => 'text_format',
			'#title' => t('Ecran en attente paiement'),
			'#required' => TRUE,
			'#cols' => 20,
			'#rows' => 5,
			'#default_value' => $bloc_tipi['value'],
			'#format' => 'full_html'
	);


	 

	return system_settings_form($form);

}

