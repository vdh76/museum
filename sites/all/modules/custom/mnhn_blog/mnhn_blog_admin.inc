<?php 

/**
 * BO BLOG
 * Code Embed Flickr
 *
 *
 */
function mnhn_blog_admin_settings() {
    $form['mnhn_blog_flickr'] = array( 
    '#type' => 'textarea', 
    '#title' => t('Code Embed Galerie Flickr'), 
    '#required' => TRUE,
    '#cols' => 50,
    '#rows' => 5,
    '#default_value' => variable_get('mnhn_blog_flickr', ''), 
    '#format' => 'plain_text'
   ); 
	return system_settings_form($form); 
}