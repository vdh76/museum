<?php

function config_museum_expo_iti_form($form, &$form_state){
  $form['description'] = array(
    '#type' => 'item',
    '#title' => 'Expositions itinérantes',
  );
  
  $form['doc_expo_iti'] = array( 
        '#title' => 'Planning des expositions itinérantes',
        '#type' => 'file',
        '#description' => '<a href="' . variable_get('doc_expo_iti') . '" target="_blank">Document actuel</a>',
        '#required' => FALSE,
  );
  
  $form['contact_expo_iti'] = array(
      '#input_format' => '1',
      '#rows' => '5',
      '#type' => 'text_format',
      '#base_type' => 'textarea',
      '#default_value' => variable_get('contact_expo_iti', ''),
      '#title' => 'Contact exposition itinérantes',
      '#suffix' => '<br/><br/>',
  );
  
  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => 'Enregistrer',
  );
  
  return $form;
}

function config_museum_expo_iti_form_validate($form, &$form_state){
  
  $validators = array("file_validate_extensions" => array("pdf doc txt"),'file_validate_size' => array(1024 * 1024 * 10));
  
  $save = file_save_upload('doc_expo_iti');

  if($save) {
    $save = file_move($save, 'public://partenaires/', FILE_EXISTS_RENAME);
    
    if($save) {
      $path = file_create_url('public://partenaires/' . $save->filename);
      variable_set('doc_expo_iti', $path);
      $form_state['storage']['file']['doc_expo_iti'] = $save;
    }
  }
}

function config_museum_expo_iti_form_submit($form, &$form_state){
    
    if(isset($form_state['storage']['file']['doc_expo_iti'])){
      $file = $form_state['storage']['file']['doc_expo_iti'];
      unset($form_state['storage']['file']['doc_expo_iti']);
      $file->status = FILE_STATUS_PERMANENT;
      file_save($file);
    }
    
    variable_set('contact_expo_iti', $form_state['values']['contact_expo_iti']['value']);
}