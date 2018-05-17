<?php

/**
 * @file
 * Defines rules for variable email functionality.
 */

 /**
 * Implements hook_rules_action_info().
 */
function variable_email_rules_action_info() {
  $actions = array();

  $actions['variable_email_mail'] = array(
    'label' => t('Send mail with Variable'),
    'parameter' => array(
      'to' => array(
        'type' => 'text',
        'label' => t('To'),
        'description' => t('The e-mail address or addresses where the message will be sent to. The formatting of this string must comply with RFC 2822.'),
      ),
      'variable' => array(
        'type' => 'text',
        'label' => t('Variable'),
        'options list' => 'variable_email_variables_list',
        'description' => t('Select the variable which should be used as a template.'),
      ),
      'language' => array(
        'type' => 'token',
        'label' => t('Language'),
        'description' => t('Select the language of the variable. You will need to have the <em>Variable translation</em> module enabled for this to work'),
        'options list' => 'variable_email_rules_language_list',
        'default value' => 'default',
      ),
      'from' => array(
        'type' => 'text',
        'label' => t('From'),
        'description' => t("The mail's from address. Leave it empty to use the site-wide configured address."),
        'optional' => TRUE,
      ),
    ),
    'group' => t('Variable Email'),
    'callbacks' => array(
      'execute' => 'variable_email_action_mail',
    ),
  );
  
  return $actions;
}

function variable_email_rules_language_list() {
  $list = language_list();
  $out = array();
  $out['default'] = t('Site Default Language');
  $out['current'] = t('Current User Language');
  foreach ($list as $key => $language) {
    $out[$key] = $language->native;
  }
  return $out;
}

/**
 * Action Implementation: Send mail.
 */
function variable_email_action_mail($to, $variable, $language = 'default', $from = NULL, $settings, RulesState $state, RulesPlugin $element) {
  global $language_content;
  $subject_variable_name = str_replace('[mail_part]', 'subject', $variable);
  $body_variable_name = str_replace('[mail_part]', 'body', $variable);
  if (module_exists('i18n_variable')) {
    if ($language == 'default') {
      $language = language_default();
      $language = $language->language;
    }
    elseif ($language == 'current') {
      $language = $language_content->language;
    }
    $subject = i18n_variable_get($subject_variable_name, $language, variable_get_value($subject_variable_name));
    $message = i18n_variable_get($body_variable_name, $language, variable_get_value($body_variable_name));
  }
  else {
    $subject = variable_get_value($subject_variable_name);
    $message = variable_get_value($body_variable_name);
  }
  
  // If it's an HTML Mail, make sure we are sending the message content and not an array
  if (is_array($message)) {
    if ($message['format'] == 'php_code') {
      // Execute php
      module_load_include('inc', 'rules', 'modules/php.eval');
      $message = rules_php_eval($message['value'], rules_unwrap_data($state->variables));
    }
    else {
      $message = $message['value'];
    }
  }
  
  $to = str_replace(array("\r", "\n"), '', $to);
  $from = !empty($from) ? str_replace(array("\r", "\n"), '', $from) : NULL;
  
  if (isset($element->settings['variable:process'])) {
    $params['subject'] = $element->settings['variable:process']->evaluate($subject, array(), $state);
    $params['message'] = $element->settings['variable:process']->evaluate($message, array(), $state);
  }
  else  {
    $params['subject'] = $subject;
    $params['message'] = $message;
  }  
  
  // Set a unique key for this mail using variable name
  $key = str_replace('_[mail_part]', '', $variable);

  $message = drupal_mail('variable_email', $key, $to, language_default(), $params, $from);
  if ($message['result']) {
    watchdog('variable_email', 'Successfully sent email %subject from %from to %recipient.', array('%from' => $from, '%recipient' => $to, '%subject'=> $params['subject']));
  }
}
