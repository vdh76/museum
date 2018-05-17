<?php

define ('NB_PART', 6);

/**
 * page callback
 */
function config_mnhn_part_form($form, &$form_state){
  $form['description'] = array(
    '#type' => 'item',
    '#title' => 'Configuration des partenaires en page d\'accueil',
  );
  
  for ($i = 1; $i <= NB_PART; $i++) {
    
    if(variable_get('logo_part_' . $i) != ''){
      $logo = '<img src="' . variable_get('logo_part_' . $i) . '" width="50" title="' . variable_get('name_part_' . $i, '') . '">';
    }else{
      $logo = 'Image au format .jpg, .png, .gif';
    }

    $form['part_' . $i] = array(
    '#type' => 'fieldset',
    '#title' => 'Partenaire n°' . $i,
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    );
      $form['part_' . $i]['name_part_' . $i] = array(
        '#type' => 'textfield',
        '#description' => 'S\'affiche au survol de l\'image',
        '#title' => 'Nom du partenaire',
        '#default_value' => variable_get('name_part_' . $i, ''),
        '#size' => 60,
      );
      $form['part_' . $i]['link_part_' . $i] = array(
        '#type' => 'textfield',
        '#description' => 'Ex. http://www.example.com',
        '#title' => 'Lien',
        '#default_value' => variable_get('link_part_' . $i, ''),
        '#size' => 60,
      );
      $form['part_' . $i]['logo_part_' . $i] = array( 
        '#title' => 'Logo',
        '#description' => $logo,
        '#type' => 'file', 
        '#required' => FALSE,
      );
  }
  
  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => 'Enregistrer',
  );
  
  return $form;
}

function config_mnhn_part_form_validate($form, &$form_state){
  
  $validators = array("file_validate_extensions" => array("jpg png gif"),'file_validate_size' => array(1024 * 1024 * 10));  
  
  for ($i = 1; $i <= NB_PART; $i++) {
    
    $save = file_save_upload('logo_part_' . $i, $validators);
    
    if($save) {
      $save = file_move($save, 'public://partenaires/', FILE_EXISTS_RENAME);
      
      if($save) {
        $path = file_create_url('public://partenaires/' . $save->filename);
        variable_set('logo_part_' . $i, $path);
        $form_state['storage']['file'][$i] = $save;
      }
    }
  
    if($form_state['values']['link_part_' . $i] != '' && !valid_url($form_state['values']['link_part_' . $i], $absolute = TRUE)){
      form_set_error('link_part_' . $i,'Le format du lien n\'est pas valide');
    }
  
  }
}

function config_mnhn_part_form_submit($form, &$form_state){
  for ($i = 1; $i <= NB_PART; $i++) {
    
    if(isset($form_state['storage']['file'][$i])){
      $file = $form_state['storage']['file'][$i];
      unset($form_state['storage']['file'][$i]);
      $file->status = FILE_STATUS_PERMANENT;
      file_save($file);
    }
    
    variable_set('name_part_' . $i, $form_state['values']['name_part_' . $i]);
    variable_set('link_part_' . $i, $form_state['values']['link_part_' . $i]);
    
  }
}
