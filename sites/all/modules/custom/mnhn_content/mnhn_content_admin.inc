<?php 

/*
 * 
 * BO - FOOTER
 * 
 */
function mnhn_content_footer_admin_settings() {
	
   global $language;
   
    $form['mnhn_footer_contact_'.$language->language] = array( 
    '#type' => 'textarea', 
    '#title' => t('Contact'), 
    '#required' => TRUE,
    '#cols' => 50,
    '#rows' => 5,
    '#default_value' => variable_get('mnhn_footer_contact_'.$language->language, ''), 
    '#format' => 'plain_text'
   ); 
   
   $form['mnhn_footer_horaire_'.$language->language] = array( 
    '#type' => 'textarea', 
    '#title' => t('Horaires'), 
    '#required' => TRUE,
    '#cols' => 50,
    '#rows' => 5,
    '#default_value' => variable_get('mnhn_footer_horaire_'.$language->language, ''), 
    '#format' => 'plain_text'
   ); 
   
   $form['mnhn_footer_fermeture_'.$language->language] = array( 
    '#type' => 'textarea', 
    '#title' => t('Fermetures'), 
    '#required' => TRUE,
    '#cols' => 50,
    '#rows' => 5,
    '#default_value' => variable_get('mnhn_footer_fermeture_'.$language->language, ''), 
    '#format' => 'plain_text'
   ); 
	
   $form['mnhn_footer_adresse_'.$language->language] = array( 
    '#type' => 'textarea', 
    '#title' => t('Adresse'), 
    '#required' => TRUE,
    '#cols' => 50,
    '#rows' => 5,
    '#default_value' => variable_get('mnhn_footer_adresse_'.$language->language, ''), 
    '#format' => 'plain_text'
   ); 
   
   $form['mnhn_footer_map_'.$language->language] = array( 
    '#type' => 'textarea', 
    '#title' => t('Access / Map'), 
    '#required' => TRUE,
    '#cols' => 50,
    '#rows' => 5,
    '#default_value' => variable_get('mnhn_footer_map_'.$language->language, ''), 
    '#format' => 'plain_text'
   ); 
   
    
  
    
   
   
 
   

  return system_settings_form($form); 

}


/*
 *
* BO - FOOTER
*
*/
function mnhn_content_menu_admin(){
	$menu=menu_tree_all_data("menu-menu-principal");
	
	$list = array();
	
	foreach($menu as $item){
		
		$list_child = array();
		foreach($item['below'] as $item_child){
			//print_r($item_child);
			$item_description='';
			$text='';
			$uri='';
			
			$image='';
			$uri=variable_get('menu_image_'.$item_child['link']['mlid'],'');
			$text=variable_get('menu_text_'.$item_child['link']['mlid'],'');
			if(!empty($uri)){
				$image=theme('image_style', array('style_name' => 'menu', 'path' => variable_get('menu_image_'.$item_child['link']['mlid'],'')));
			}
			if(!empty($text) || !empty($uri) ){
				$item_description='<div>'.$image.'<p>'.nl2br($text).'</p></div>';
			}
			$list_child['items'][] = l($item_child['link']['link_title'],'admin/config/mnhn/menu/'.$item_child['link']['mlid']).$item_description;
		}
		$list['items'][] = $item['link']['link_title'].theme('item_list',$list_child);
	}
	$output = theme('item_list',$list);
	return $output;
	
}


function mnhn_content_menu_edit_admin_form() {
	
	$form['#attributes'] = array('enctype' => "multipart/form-data");
	$form['#redirect'] = 'admin/config/mnhn/menu';
    //$form['#validate'] = array('thrust_contenu_images_form_validate');
    $mlid=arg(4);
    
    $menu_title=db_query('SELECT link_title from menu_links where mlid=:mlid',array(':mlid'=>$mlid))->fetchField();
    
    $form['title'] = array( 
   				'#type' => 'item',
	   		 	'#title' => '<h2>'.$menu_title.'</h2>',
	   	); 
   	 $filepath_image=str_replace('public://','sites/default/files/',variable_get('menu_image_'.$mlid,''));
 		
	   if($filepath_image!=''){
	   	
	   		$info=mnhn_content_get_image_info($filepath_image);
	   		
	   		//(substr($image,0,3)=='ban')? $witdh=' width="400px"': $witdh='';
	   		
	   		$form['visuel_'.$mlid] = array( 
	   			'#type' => 'item',
	   		 	'#description' => '<div>'.theme('image_style', array('style_name' => 'menu', 'path' => variable_get('menu_image_'.$mlid,''))).'<p>  '.$info['nom'].' - '.$info['poids'].' - '.$info['largeur'].'x'.$info['hauteur'].'</p></div>',
	   		);

	   		$form['delete'] = array(
	   			'#type' =>  'checkbox',  
				'#title' => 'Supprimer', 
	   		); 
	   		
	   		$form[$mlid.'_old'] = array(
	   			'#type' => 'hidden',  
	   			'#value' => variable_get('menu_image_'.$mlid,''),
	   		); 
	   }
	 
	   $form['menu_image_'.$mlid] = array( 
		    '#title' => 'Upload a new file',
		    '#type' => 'file', 
		    '#required' => FALSE,
	   );
	   
	  $form['menu_text_'.$mlid] = array( 
		    '#type' => 'textarea', 
		    '#title' => t('Texte'), 
		    '#required' => TRUE,
		    '#cols' => 50,
		    '#rows' => 3,
		    '#default_value' => variable_get('menu_text_'.$mlid, ''), 
		    '#format' => 'plain_text'
   		); 
	   	
	   		
   		$form['submit'] = array( 
		    '#type' => 'submit', 
		    '#value' => t('Valider'), 
   		); 		
    
    

  return $form; 

}


/*
 *
* BO - INFOS PRATIQUES
*
*/
function mnhn_content_bloc_infos_pratiques_admin_settings(){
	global $language;
	 $bloc = variable_get('mnhn_bloc_info_pratique_'.$language->language, $defaults);
	 $form['mnhn_bloc_info_pratique_'.$language->language] = array( 
    '#type' => 'text_format', 
    '#title' => t('Informations pratiques'), 
    '#required' => TRUE,
    '#cols' => 50,
    '#rows' => 20,
    '#default_value' => $bloc['value'],  
    '#format' => 'full_html'
   ); 
   
    return system_settings_form($form); 
	
}

/*
 *
* BO - VENIR AU MUSEUM
*
*/
function mnhn_content_bloc_venir_museum_admin_settings(){
	global $language;
	 $bloc = variable_get('mnhn_bloc_venir_museum_'.$language->language, $defaults);
	 $form['mnhn_bloc_venir_museum_'.$language->language] = array( 
    '#type' => 'text_format', 
    '#title' => t('Venir au Muséum'), 
    '#required' => TRUE,
    '#cols' => 50,
    '#rows' => 10,
    '#default_value' => $bloc['value'],  
    '#format' => 'full_html'
   ); 
	 
	 $form['mnhn_bloc_venir_museum_link_'.$language->language] = array(
	 		'#type' => 'textfield',
	 		'#title' => t('Contenu'),
	 		'#required' => TRUE,
	 		'#autocomplete_path' =>'mnhn/autocomplete/link',
	 		'#default_value' => variable_get('mnhn_bloc_venir_museum_link_'.$language->language, ''),
	 );
   
    return system_settings_form($form); 
	
}


/*
 *
* BO - DEPLOIEMENT
*
*/
function mnhn_content_admin_deploiement_settings(){
	global $language;

	$form['mnhn_deploiement_'.$language->language] = array(
			'#type' => 'textfield',
			'#title' => t('Page contenu en attente de déploiement'),
			'#required' => TRUE,
			'#autocomplete_path' =>'mnhn/autocomplete/link',
			'#default_value' => variable_get('mnhn_deploiement_'.$language->language, ''),
	);
	
	$form['mnhn_boutique'] = array(
			'#type' => 'checkbox',
			'#title' => t('Ouverture boutique'),
			'#default_value' => variable_get('mnhn_boutique', ''),
	);
	
	$form['mnhn_resa'] = array(
			'#type' => 'checkbox',
			'#title' => t('Ouverture réservation'),
			'#default_value' => variable_get('mnhn_resa', ''),
	);
	
	$form['mnhn_bdd_collection'] = array(
			'#type' => 'checkbox',
			'#title' => t('Ouverture base de données des collections'),
			'#default_value' => variable_get('mnhn_bdd_collection', ''),
	);
	
	$form['mnhn_en'] = array(
			'#type' => 'checkbox',
			'#title' => t('Ouverture EN'),
			'#default_value' => variable_get('mnhn_en', ''),
	);
	
	$form['mnhn_de'] = array(
			'#type' => 'checkbox',
			'#title' => t('Ouverture DE'),
			'#default_value' => variable_get('mnhn_de', ''),
	);
	
	
	 
	return system_settings_form($form);

}


/*
 *
* BO - LIEN BDD COLLECTION
*
*/
function mnhn_content_bloc_collecs_admin_settings(){
	global $language;
	 
	 $form['mnhn_bloc_link_collection_'.$language->language] = array( 
    '#type' => 'textfield', 
    '#title' => t('Lien BDD collections en ligne'), 
    '#required' => TRUE,
    '#default_value' => variable_get('mnhn_bloc_link_collection_'.$language->language, '')
   ); 
   
    return system_settings_form($form); 
	
}


/*
 *
* BO - BLoc online
*
*/
function mnhn_content_online_admin_settings(){
	
	 $form['mnhn_bloc_en_ligne_flickr'] = array( 
    '#type' => 'textfield', 
    '#title' => t('Flickr'), 
    '#required' => TRUE,
    '#default_value' => variable_get('mnhn_bloc_en_ligne_flickr', ''), 
   ); 
   
    $form['mnhn_bloc_en_ligne_facebook'] = array( 
    '#type' => 'textfield', 
    '#title' => t('Facebook'), 
    '#required' => TRUE,
    '#default_value' => variable_get('mnhn_bloc_en_ligne_facebook', ''), 
   ); 
   
    $form['mnhn_bloc_en_ligne_twitter'] = array( 
    '#type' => 'textfield', 
    '#title' => t('Twitter'), 
    '#required' => TRUE,
    '#default_value' => variable_get('mnhn_bloc_en_ligne_twitter', ''), 
   ); 
	
	 $form['mnhn_bloc_en_ligne_dailymotion'] = array( 
    '#type' => 'textfield', 
    '#title' => t('Daylimotion'), 
    '#required' => TRUE,
    '#default_value' => variable_get('mnhn_bloc_en_ligne_dailymotion', ''), 
   ); 
   
    $form['mnhn_bloc_en_ligne_netvibes'] = array( 
    '#type' => 'textfield', 
    '#title' => t('Netvibes'), 
    '#required' => TRUE,
    '#default_value' => variable_get('mnhn_bloc_en_ligne_netvibes', ''), 
   ); 
   
    return system_settings_form($form); 
	
}


/*
 *
* BO - BLOC SECTIONS
*
*/
function mnhn_content_bloc_admin_settings() {
	
	global $language;
	
	drupal_add_js('jQuery(function() {
	
					jQuery("#mnhn-content-bloc-admin-settings .collapsible").each(function(){
						  	var id=jQuery(this).parent().parent().attr("id");
						  	
						  	if(jQuery(this).is(":checked")){
						  		jQuery("#"+id+"-state").show();
						  		jQuery("#"+id+"-wrapper").show();
						  	}else{
						  		jQuery("#"+id+"-state").hide();
						  		jQuery("#"+id+"-wrapper").hide();
						  	}
						  
						});
				
					
				  	jQuery("#mnhn-content-bloc-admin-settings .collapsible").click(function(){
					  	var id=jQuery(this).parent().parent().attr("id");
					  	
					  	if(jQuery(this).is(":checked")){
					  		jQuery("#"+id+"-state").show();
					  		jQuery("#"+id+"-wrapper").show();
					  	}else{
					  		jQuery("#"+id+"-state").hide();
					  		jQuery("#"+id+"-wrapper").hide();
					  	}
					  
					});
						  	
	});','inline');
	
   $site=array();
  
  
   $menu_header=menu_tree_all_data("menu-dedies");
   $menu_principal=menu_tree_all_data("menu-menu-principal");
   $menu = array_merge($site,$menu_header,$menu_principal );
   $menu['blog-fr'] = array('link' => array('mlid'=> 'blog-fr', 'link_title'=>'Blog','language'=>'fr'));
   $menu['contact-fr'] = array('link' => array('mlid'=> 'contact-fr', 'link_title'=>'Contact','language'=>'fr'));
   $menu['sitemap-fr'] = array('link' => array('mlid'=> 'sitemap-fr', 'link_title'=>'Sitemap','language'=>'fr'));
   $menu['panier-fr'] = array('link' => array('mlid'=> 'panier-fr', 'link_title'=>'Panier','language'=>'fr'));
   $menu['user-fr'] = array('link' => array('mlid'=> 'user-fr', 'link_title'=>'Compte','language'=>'fr'));
   $menu['lettre-fr'] = array('link' => array('mlid'=> 'lettre-fr', 'link_title'=>'Archives Lettre du Muséum','language'=>'fr'));
   $menu['search-fr'] = array('link' => array('mlid'=> 'search-fr', 'link_title'=>'Recherche','language'=>'fr'));
    
   
   
   $menu['blog-en'] = array('link' => array('mlid'=> 'blog-fr', 'link_title'=>'Blog','language'=>'en'));
   $menu['contact-en'] = array('link' => array('mlid'=> 'contact-en', 'link_title'=>'Contact','language'=>'en'));
   $menu['sitemap-en'] = array('link' => array('mlid'=> 'sitemap-en', 'link_title'=>'Sitemap','language'=>'en'));
   $menu['panier-en'] = array('link' => array('mlid'=> 'panier-en', 'link_title'=>'Panier','language'=>'en'));
   $menu['user-en'] = array('link' => array('mlid'=> 'user-en', 'link_title'=>'Compte','language'=>'en'));
   $menu['lettre-en'] = array('link' => array('mlid'=> 'lettre-en', 'link_title'=>'Archives Lettre du Muséum','language'=>'en'));
   $menu['search-en'] = array('link' => array('mlid'=> 'search-en', 'link_title'=>'Recherche','language'=>'en'));
 
   $menu['blog-de'] = array('link' => array('mlid'=> 'blog-de', 'link_title'=>'Blog','language'=>'en'));
   $menu['contact-de'] = array('link' => array('mlid'=> 'contact-de', 'link_title'=>'Contact','language'=>'de'));
   $menu['sitemap-de'] = array('link' => array('mlid'=> 'sitemap-de', 'link_title'=>'Sitemap','language'=>'de'));
   $menu['panier-de'] = array('link' => array('mlid'=> 'panier-de', 'link_title'=>'Panier','language'=>'de'));
   $menu['user-de'] = array('link' => array('mlid'=> 'user-de', 'link_title'=>'Compte','language'=>'de'));
   $menu['lettre-de'] = array('link' => array('mlid'=> 'lettre-de', 'link_title'=>'Archives Lettre du Muséum','language'=>'de'));
   $menu['search-de'] = array('link' => array('mlid'=> 'search-de', 'link_title'=>'Recherche','language'=>'de'));
   
   
   $form['#attributes'] = array('enctype' => "multipart/form-data");
   $form['#submit'][]='mnhn_content_bloc_admin_settings_submit';
   
	foreach($menu as $item){
		if($item['link']['language']==$language->language){
			$form['mnhn_rubrique_'.$item['link']['mlid']] = array( 
			    '#type' => 'fieldset', 
			    '#title' => $item['link']['link_title'], 
			    '#collapsed' => TRUE,
				'#collapsible' => TRUE,
			   ); 
				
			 
				mnhn_content_bloc_element_form($form,$item,$item['link']['mlid']);
		}
	  
	   
	  
	}	
		
  return system_settings_form($form); 

}

/*
 *
* BO - BLOC SECTIONS
*
*/
function mnhn_content_bloc_element_form(&$form,$item,$mlid_default){
	
	   $blocs=mnhn_content_bloc_liste();
	   
	   $options=array();
	   $i=0;
	   foreach($blocs as $key => $value){
			
			
			 // '#default_value' => variable_get('mnhn_bloc_'.$item['link']['mlid'], ''), 
			
			($value[1]==1)?$class_state='collapsible':$class_state='';
			$class_state='collapsible';
			
		   $form['mnhn_rubrique_'.$item['link']['mlid']]['mnhn_bloc_'.$item['link']['mlid'].'_'.$key] = array( 
			    '#prefix' => '<div class="mnhn_bloc_item_wrapper">', 
		   		'#type' => 'checkboxes', 
			    '#options' => array($key => strip_tags($value[0])), 
		   		'#default_value' => variable_get('mnhn_bloc_'.$mlid_default.'_'.$key, array()),
		  		'#attributes' => array('class' => array($class_state)),
		   		'#weight' => $i,
			   ); 
			   
			  if($value[1]==1){
				 $form['mnhn_rubrique_'.$item['link']['mlid']]['mnhn_bloc_'.$item['link']['mlid'].'_'.$key.'_state'] = array( 
				    '#type' => 'select', 
				    '#options' => array(1=>'déplié',2=>'replié'), 
			   		'#default_value' => variable_get('mnhn_bloc_'.$mlid_default.'_'.$key.'_state', array()),
				 	'#weight' => $i+1,
				    '#suffix' => '</div>', 
				   );  
			  }
				   
			if($key=='bloc_libre'){
				$form['mnhn_rubrique_'.$item['link']['mlid']]['mnhn_bloc_'.$item['link']['mlid'].'_'.$key.'_title'] = array( 
				    '#prefix' => '<div class="mnhn_bloc_libre" id="edit-mnhn-bloc-'.$item['link']['mlid'].'-'.str_replace('_','-',$key).'-wrapper">', 
					'#title' => 'Titre', 
					'#type' => 'textfield', 
			   		'#default_value' => variable_get('mnhn_bloc_'.$mlid_default.'_'.$key.'_title', ''),
					'#weight' => $i+2,
				   ); 

				
				
					//print variable_get('bloc_image_'.$item['link']['mlid'],'');
					//exit;
		  			
	
					$filepath_bloc_image=str_replace('public://','sites/default/files/',variable_get('bloc_image_url_'.$mlid_default,''));
	 		
				   if($filepath_bloc_image!=''){
				   	
				   		$info=mnhn_content_get_image_info($filepath_bloc_image);
				   		
				   		//(substr($image,0,3)=='ban')? $witdh=' width="400px"': $witdh='';
				   		
				   		$form['mnhn_rubrique_'.$item['link']['mlid']]['visuel_bloc_'.$item['link']['mlid']] = array( 
				   			'#type' => 'item',
				   		     '#title' => 'Image',
				   		 	'#description' => '<div>'.theme('image_style', array('style_name' => 'bloc', 'path' => variable_get('bloc_image_url_'.$mlid_default,''))).'<p>  '.$info['nom'].' - '.$info['poids'].' - '.$info['largeur'].'x'.$info['hauteur'].'</p></div>',
				   			'#weight' => $i+3,
				   		);
			
				   		$form['mnhn_rubrique_'.$item['link']['mlid']]['delete_image_'.$item['link']['mlid']] = array(
				   			'#type' =>  'checkbox',  
							'#title' => 'Supprimer',
				   			'#weight' => $i+4, 
				   		); 
				   		
				   		$form[$item['link']['mlid'].'_image_old'] = array(
				   			'#type' => 'hidden',  
				   			'#value' => variable_get('bloc_image_url_'.$mlid_default,''),
				   		); 
				   }
		 
				   $form['mnhn_rubrique_'.$item['link']['mlid']]['bloc_image_'.$item['link']['mlid']] = array( 
					    '#title' => 'Uploader un visuel',
				        '#description' => 'format : jpg, png', 
					    '#type' => 'file', 
					    '#required' => FALSE,
				   		'#weight' => $i+5,
				   );
		   
					
				 
		   			
					
				  
				   
				   
				$form['mnhn_rubrique_'.$item['link']['mlid']]['mnhn_bloc_'.$item['link']['mlid'].'_'.$key.'_texte'] = array( 
				 	'#title' => 'Texte',
				    '#type' => 'textarea',
					'#cols' => 50,
   					'#rows' => 5, 
			   		'#default_value' => variable_get('mnhn_bloc_'.$mlid_default.'_'.$key.'_texte', ''),
					'#weight' => $i+6,
					'#suffix' => '</div>', 
				   );     
				
			}		   	   
				   
				   
				   
			

 
			    
			
			$i+=10;
	   }
	   
	  // return $form;
	
	
	
}


/**
 * Submit handler for private file upload form.
 */
function mnhn_content_bloc_admin_settings_submit($form, &$form_state) {

	
	
   $menu_header=menu_tree_all_data("menu-dedies");
   $menu_principal=menu_tree_all_data("menu-menu-principal");
   $menu = array_merge($menu_principal, $menu_header);
   
   $menu['blog-fr'] = array('link' => array('mlid'=> 'blog-fr', 'link_title'=>'Blog','language'=>'fr'));
   $menu['contact-fr'] = array('link' => array('mlid'=> 'contact-fr', 'link_title'=>'Contact','language'=>'fr'));
   $menu['sitemap-fr'] = array('link' => array('mlid'=> 'sitemap-fr', 'link_title'=>'Sitemap','language'=>'fr'));
   $menu['panier-fr'] = array('link' => array('mlid'=> 'panier-fr', 'link_title'=>'Panier','language'=>'fr'));
   $menu['user-fr'] = array('link' => array('mlid'=> 'user-fr', 'link_title'=>'Compte','language'=>'fr'));
   $menu['lettre-fr'] = array('link' => array('mlid'=> 'lettre-fr', 'link_title'=>'Lettre du Muséum','language'=>'fr'));
   $menu['search-fr'] = array('link' => array('mlid'=> 'search-fr', 'link_title'=>'Recherche','language'=>'fr'));
    
   $menu['blog-en'] = array('link' => array('mlid'=> 'blog-en', 'link_title'=>'Blog','language'=>'en'));
   $menu['contact-en'] = array('link' => array('mlid'=> 'contact-en', 'link_title'=>'Contact','language'=>'en'));
   $menu['sitemap-en'] = array('link' => array('mlid'=> 'sitemap-en', 'link_title'=>'Sitemap','language'=>'en'));
   $menu['panier-en'] = array('link' => array('mlid'=> 'panier-en', 'link_title'=>'Panier','language'=>'en'));
   $menu['user-en'] = array('link' => array('mlid'=> 'user-en', 'link_title'=>'Compte','language'=>'en'));
   $menu['lettre-en'] = array('link' => array('mlid'=> 'lettre-en', 'link_title'=>'Lettre du Muséum','language'=>'en'));
   $menu['search-en'] = array('link' => array('mlid'=> 'search-en', 'link_title'=>'Recherche','language'=>'en'));
  
   $menu['blog-de'] = array('link' => array('mlid'=> 'blog-de', 'link_title'=>'Blog','language'=>'de'));
   $menu['contact-de'] = array('link' => array('mlid'=> 'contact-de', 'link_title'=>'Contact','language'=>'de'));
   $menu['sitemap-de'] = array('link' => array('mlid'=> 'sitemap-de', 'link_title'=>'Sitemap','language'=>'de'));
   $menu['panier-de'] = array('link' => array('mlid'=> 'panier-de', 'link_title'=>'Panier','language'=>'de'));
   $menu['user-de'] = array('link' => array('mlid'=> 'user-de', 'link_title'=>'Compte','language'=>'de'));
   $menu['lettre-de'] = array('link' => array('mlid'=> 'lettre-de', 'link_title'=>'Lettre du Muséum','language'=>'de'));
   $menu['search-de'] = array('link' => array('mlid'=> 'search-de', 'link_title'=>'Recherche','language'=>'de'));
   
  
   
   
	foreach($menu as $item){
  

		  $validators = array('file_validate_is_image' => array());
		  $file = file_save_upload('bloc_image_'.$item['link']['mlid'], $validators, 'public://bloc/');
		  if($form_state['values']['delete_image_'.$item['link']['mlid']]){
			  if($form_state['values']['delete_image_'.$item['link']['mlid']]==1){
			  
			  		db_query("DELETE FROM {file_managed} WHERE uri=:uri", array(':uri' => $form_state['values'][$item['link']['mlid'].'_image_old']));
			         unlink(str_replace('public://','sites/default/files/bloc',$form_state['values'][$item['link']['mlid'].'_image_old']));
			          variable_set('bloc_image_url_'.$item['link']['mlid'],'');
			  }
		  }
		  if ($file) {
		   			
		         	variable_set('bloc_image_url_'.$item['link']['mlid'],$file->uri);
		         	
		         	
		         	$file->status = FILE_STATUS_PERMANENT;
			 	 	file_save($file);
		          // suppression ancien fichier
		          if($form_state['values'][$item['link']['mlid'].'_image_old']){
			          if($form_state['values'][$item['link']['mlid'].'_image_old']!=$file->uri && $form_state['values']['delete_image_'.$item['link']['mlid']]==0){
			          	db_query("DELETE FROM {file_managed} WHERE uri=:uri", array(':uri' => $form_state['values'][$item['link']['mlid'].'_image_old']));
			          	unlink(str_replace('public://','sites/default/files/bloc',$form_state['values'][$item['link']['mlid'].'_image_old']));
			          }  
		          }
		  }
  
 	}
 	
 	
 	//print variable_get('bloc_image_542','');
	//exit;
 	
}




