<?php 
drupal_add_js(drupal_get_path('theme','mnhn').'/js/j-all.js');
drupal_add_css(drupal_get_path('theme','mnhn').'/css/all.css');



$output=theme('aventure',array('nid_aventure' => $node->nid));
print $output;
?>