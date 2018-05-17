<?php 

/**
 * BO aventure Museum
 *
 */
function mnhn_aventure_admin_settings() {
	
   global $language;
   
   $form['homepage'] = array(
   		'#type' => 'fieldset',
   		'#title' => t('Homepage'),
   );
   
   $bloc_homepage = variable_get('mnhn_bloc_aventure_'.$language->language, $defaults);
   $form['homepage']['mnhn_bloc_aventure_'.$language->language] = array(
   		'#type' => 'text_format',
   		'#title' => t('Bloc aventure'),
   		'#required' => TRUE,
   		'#cols' => 20,
   		'#rows' => 5,
   		'#default_value' => $bloc_homepage['value'],
   		'#format' => 'full_html'
   );
   
    $form['edito'] = array( 
    '#type' => 'fieldset', 
    '#title' => t('Edito'), 
   ); 
  
    $bloc_edito = variable_get('mnhn_aventure_edito_'.$language->language, $defaults);
	$form['edito']['mnhn_aventure_edito_'.$language->language] = array( 
    '#type' => 'text_format', 
    '#cols' => 50,
    '#rows' => 5,
    '#default_value' => $bloc_edito['value'], 
    '#format' => 'full_html'
   ); 
	
	$form['aventure'] = array(
			'#type' => 'fieldset',
			'#title' => t('Pars à l\'aventure'),
	);
	 
	 
	$form['aventure']['mnhn_aventure_link_'.$language->language] = array(
			'#type' => 'textfield',
			'#title' => t('Contenu aventure'),
			'#required' => TRUE,
			'#autocomplete_path' =>'mnhn-aventure/autocomplete/link',
			'#default_value' => variable_get('mnhn_aventure_link_'.$language->language, ''),
	);
   
    $form['expo'] = array( 
    '#type' => 'fieldset', 
    '#title' => t('L\'expo du moment'), 
   ); 
   

    $bloc_expo = variable_get('mnhn_aventure_expo_edito_'.$language->language, $defaults);
	$form['expo']['mnhn_aventure_expo_edito_'.$language->language] = array( 
    '#title' => 'Accroche', 
	'#type' => 'text_format', 
    '#cols' => 50,
    '#rows' => 5,
    '#default_value' => $bloc_expo['value'], 
    '#format' => 'full_html'
   ); 
   
   $form['expo']['mnhn_aventure_expo_title_'.$language->language] = array( 
    '#title' => 'Nom de l\'exposition', 
	'#type' => 'textfield', 
    '#default_value' => variable_get('mnhn_aventure_expo_title_'.$language->language, ''), 
   ); 
   
   
   $filepath_expo_image=str_replace('public://','sites/default/files/',variable_get('mnhn_aventure_expo_image_url_'.$language->language,''));
	 		
	   if($filepath_expo_image!=''){
	   	
	   		$info=mnhn_content_get_image_info($filepath_expo_image);
	   		
	   		//(substr($image,0,3)=='ban')? $witdh=' width="400px"': $witdh='';
	   		
	   		$form['expo']['mnhn_aventure_expo_visuel_'.$language->language] = array( 
	   			'#type' => 'item',
	   		    '#title' => 'Image',
	   		 	'#description' => '<div>'.theme('image_style', array('style_name' => 'bloc', 'path' => variable_get('mnhn_aventure_expo_image_url_'.$language->language,''))).'<p>  '.$info['nom'].' - '.$info['poids'].' - '.$info['largeur'].'x'.$info['hauteur'].'</p></div>',
	   		
	   		);

	   		$form['expo']['delete_image_expo'] = array(
	   			'#type' =>  'checkbox',  
				'#title' => 'Supprimer', 
	   		); 
	   		
	   		$form['expo']['old_image_expo'] = array(
	   			'#type' => 'hidden',  
	   			'#value' => variable_get('mnhn_aventure_expo_image_url_'.$language->language,''),
	   		); 
	   }
		 
   $form['expo']['mnhn_aventure_expo_image_'.$language->language] = array( 
	    '#title' => 'Uploader un visuel',
        '#description' => 'format : jpg, png', 
	    '#type' => 'file', 
	    '#required' => FALSE,
   );
   
   $form['expo']['mnhn_aventure_expo_link_'.$language->language] = array( 
    '#type' => 'textfield', 
    '#title' => t('Contenu article'), 
    '#required' => TRUE,
    '#autocomplete_path' =>'mnhn-aventure/autocomplete/link',
    '#default_value' => variable_get('mnhn_aventure_expo_link_'.$language->language, ''), 
   ); 
   
    $form['abeilles'] = array( 
    '#type' => 'fieldset', 
    '#title' => t('Découvre le monde des abeilles'), 
   ); 
   
    $bloc_abeille = variable_get('mnhn_aventure_abeilles_edito_'.$language->language, $defaults);
	$form['abeilles']['mnhn_aventure_abeilles_edito_'.$language->language] = array( 
    '#title' => 'Accroche', 
	'#type' => 'text_format', 
    '#cols' => 50,
    '#rows' => 5,
    '#default_value' => $bloc_abeille['value'], 
    '#format' => 'full_html'
   ); 
   
   $form['abeilles']['mnhn_aventure_abeilles_link_'.$language->language] = array( 
    '#type' => 'textfield', 
    '#title' => t('Contenu article'), 
    '#required' => TRUE,
    '#autocomplete_path' =>'mnhn-aventure/autocomplete/link',
    '#default_value' => variable_get('mnhn_aventure_abeilles_link_'.$language->language, ''), 
   ); 
   
   $form['anniversaire'] = array( 
    '#type' => 'fieldset', 
    '#title' => t('Fête ton anniversaire'), 
   ); 
   
   
   $form['anniversaire']['mnhn_aventure_anniversaire_link_'.$language->language] = array( 
    '#type' => 'textfield', 
    '#title' => t('Contenu article'), 
    '#required' => TRUE,
    '#autocomplete_path' =>'mnhn-aventure/autocomplete/link',
    '#default_value' => variable_get('mnhn_aventure_anniversaire_link_'.$language->language, ''), 
   ); 
   
   $form['collections'] = array( 
    '#type' => 'fieldset', 
    '#title' => t('Explore les collections'), 
   ); 
   
   
   $form['collections']['mnhn_aventure_collection_link_'.$language->language] = array( 
    '#type' => 'textfield', 
    '#title' => t('Contenu article'), 
    '#required' => TRUE,
    '#autocomplete_path' =>'mnhn-aventure/autocomplete/link',
    '#default_value' => variable_get('mnhn_aventure_collection_link_'.$language->language, ''), 
   ); 
    
 $form['#submit'][]='mnhn_aventure_admin_settings_submit';
  return system_settings_form($form); 

}


/**
 * Submit handler for private file upload form.
 */
function mnhn_aventure_admin_settings_submit($form, &$form_state) {

		global $language;
		
  

		  $validators = array('file_validate_is_image' => array());
		  $file = file_save_upload('mnhn_aventure_expo_image_'.$language->language, $validators, 'public://aventure/');
		  if($form_state['values']['delete_image_expo']){
			  if($form_state['values']['delete_image_expo']==1){
			  
			  		db_query("DELETE FROM {file_managed} WHERE uri=:uri", array(':uri' => $form_state['values']['old_image_expo']));
			         unlink(str_replace('public://','sites/default/files/',$form_state['values']['old_image_expo']));
			          variable_set('mnhn_aventure_expo_image_url_'.$language->language,'');
			  }
		  }
		  if ($file) {
		   			
		         	variable_set('mnhn_aventure_expo_image_url_'.$language->language,$file->uri);
		         	
		         	
		         	$file->status = FILE_STATUS_PERMANENT;
			 	 	file_save($file);
		          // suppression ancien fichier
		          if($form_state['values']['delete_image_expo']){
			          if($form_state['values']['old_image_expo']!=$file->uri && $form_state['values']['delete_image_expo']==0){
			          	db_query("DELETE FROM {file_managed} WHERE uri=:uri", array(':uri' => $form_state['values']['old_image_expo']));
			          	unlink(str_replace('public://','sites/default/files/',$form_state['values']['old_image_expo']));
			          }  
		          }
		  }
  
 	
 	
 	
 	//print variable_get('bloc_image_542','');
	//exit;
 	
}



