<?php



//$GLOBALS['language']->language = 'fr';
/**
 * Override or insert variables into the maintenance page template.
 */
function mnhn_admin_preprocess_maintenance_page(&$vars) {
  // While markup for normal pages is split into page.tpl.php and html.tpl.php,
  // the markup for the maintenance page is all in the single
  // maintenance-page.tpl.php template. So, to have what's done in
  // mnhn_admin_preprocess_html() also happen on the maintenance page, it has to be
  // called here.
  mnhn_admin_preprocess_html($vars);
}

/**
 * Override or insert variables into the html template.
 */
function mnhn_admin_preprocess_html(&$vars) {
  // Add conditional CSS for IE8 and below.
  drupal_add_css(path_to_theme() . '/ie.css', array('group' => CSS_THEME, 'browsers' => array('IE' => 'lte IE 8', '!IE' => FALSE), 'weight' => 999, 'preprocess' => FALSE));
  // Add conditional CSS for IE7 and below.
  drupal_add_css(path_to_theme() . '/ie7.css', array('group' => CSS_THEME, 'browsers' => array('IE' => 'lte IE 7', '!IE' => FALSE), 'weight' => 999, 'preprocess' => FALSE));
  // Add conditional CSS for IE6.
  drupal_add_css(path_to_theme() . '/ie6.css', array('group' => CSS_THEME, 'browsers' => array('IE' => 'lte IE 6', '!IE' => FALSE), 'weight' => 999, 'preprocess' => FALSE));

   drupal_add_js(path_to_theme() . '/scripts.js');	
   
   if( (arg(0)=='node' && arg(1)=='add' && (arg(2)=='event' || arg(2)=='blog'))
	||
	   (arg(0)=='node' && arg(1)>0 && (mnhn_content_get_content_type(arg(2))=='event' || mnhn_content_get_content_type(arg(2))=='blog'))
   ){
   	drupal_add_js(path_to_theme() . '/uidatepicker-fr.js');
   	
   }
}

/**
 * Override or insert variables into the page template.
 */
function mnhn_admin_preprocess_page(&$vars) {
  $vars['primary_local_tasks'] = $vars['tabs'];
  unset($vars['primary_local_tasks']['#secondary']);
  $vars['secondary_local_tasks'] = array(
    '#theme' => 'menu_local_tasks',
    '#secondary' => $vars['tabs']['#secondary'],
  );
}

/**
 * Display the list of available node types for node creation.
 */
function mnhn_admin_node_add_list($variables) {
  $content = $variables['content'];
  $output = '';
  if ($content) {
    $output = '<ul class="admin-list">';
    foreach ($content as $item) {
      $output .= '<li class="clearfix">';
      $output .= '<span class="label">' . l($item['title'], $item['href'], $item['localized_options']) . '</span>';
      $output .= '<div class="description">' . filter_xss_admin($item['description']) . '</div>';
      $output .= '</li>';
    }
    $output .= '</ul>';
  }
  else {
    $output = '<p>' . t('You have not created any content types yet. Go to the <a href="@create-content">content type creation page</a> to add a new content type.', array('@create-content' => url('admin/structure/types/add'))) . '</p>';
  }
  return $output;
}

/**
 * Overrides theme_admin_block_content().
 *
 * Use unordered list markup in both compact and extended mode.
 */
function mnhn_admin_admin_block_content($variables) {
  $content = $variables['content'];
  $output = '';
  if (!empty($content)) {
    $output = system_admin_compact_mode() ? '<ul class="admin-list compact">' : '<ul class="admin-list">';
    foreach ($content as $item) {
      $output .= '<li class="leaf">';
      $output .= l($item['title'], $item['href'], $item['localized_options']);
      if (isset($item['description']) && !system_admin_compact_mode()) {
        $output .= '<div class="description">' . filter_xss_admin($item['description']) . '</div>';
      }
      $output .= '</li>';
    }
    $output .= '</ul>';
  }
  return $output;
}

/**
 * Override of theme_tablesort_indicator().
 *
 * Use our own image versions, so they show up as black and not gray on gray.
 */
function mnhn_admin_tablesort_indicator($variables) {
  $style = $variables['style'];
  $theme_path = drupal_get_path('theme', 'mnhn_admin');
  if ($style == 'asc') {
    return theme('image', array('path' => $theme_path . '/images/arrow-asc.png', 'alt' => t('sort ascending'), 'width' => 13, 'height' => 13, 'title' => t('sort ascending')));
  }
  else {
    return theme('image', array('path' => $theme_path . '/images/arrow-desc.png', 'alt' => t('sort descending'), 'width' => 13, 'height' => 13, 'title' => t('sort descending')));
  }
}

/**
 * Implements hook_css_alter().
 */
function mnhn_admin_css_alter(&$css) {
  // Use mnhn_admin's vertical tabs style instead of the default one.
  if (isset($css['misc/vertical-tabs.css'])) {
    $css['misc/vertical-tabs.css']['data'] = drupal_get_path('theme', 'mnhn_admin') . '/vertical-tabs.css';
  }
  if (isset($css['misc/vertical-tabs-rtl.css'])) {
    $css['misc/vertical-tabs-rtl.css']['data'] = drupal_get_path('theme', 'mnhn_admin') . '/vertical-tabs-rtl.css';
  }
  // Use mnhn_admin's jQuery UI theme style instead of the default one.
  if (isset($css['misc/ui/jquery.ui.theme.css'])) {
    $css['misc/ui/jquery.ui.theme.css']['data'] = drupal_get_path('theme', 'mnhn_admin') . '/jquery.ui.theme.css';
  }
}



/**
 * Returns HTML for the vocabulary overview form as a sortable list of vocabularies.
 *
 * @param $variables
 *   An associative array containing:
 *   - form: A render element representing the form.
 *
 * @see taxonomy_overview_vocabularies()
 * @ingroup themeable
 */
function mnhn_admin_nodeorder_admin_display_form($variables) {
	global $language;
  $form = $variables['form'];
	
  drupal_add_tabledrag('nodeorder', 'order', 'sibling', 'node-weight');

  $errors = form_get_errors() != FALSE ? form_get_errors() : array();
  $rows = array();
  foreach (element_children($form) as $key) {
    if (isset($form[$key]['#node'])) {
      $node = &$form[$key];
		
      $row = array();
     
       if($form[$key]['#node']->language!=$language->language){
			$class_row='hide_menu_form ';
	    }else{
	    	$class_row='';
	    }	
     
      
       if(arg(3)=='chefs-oeuvres'){
       	 	$chef_oeuvre=db_query('select field_oeuvre_titre_value from field_data_field_oeuvre_titre  where entity_id=:id',array(':id'=> $node['#node']->nid))->fetchField();
       		$node['title']['#markup']=$chef_oeuvre;
       }
       $row[] = drupal_render($node['title']);
      $node['weight']['#attributes']['class'] = array('node-weight');
      $row[] = drupal_render($node['weight']);
      $row = array('data' => $row);
      $rows[$key] = $row;
      $rows[$key]['class'] = array();
   	  $rows[$key]['class'][] = 'draggable';
   	  $rows[$key]['class'][] = $class_row;
    }
  }

  // Add necessary classes to rows.
  $row_position = 0;
  foreach ($rows as $key => $row) {
    //$rows[$key]['class'] = array();
    //$rows[$key]['class'][] = 'draggable';

    // Add an error class if this row contains a form error.
    foreach ($errors as $error_key => $error) {
      if (strpos($error_key, $key) === 0) {
        $rows[$key]['class'][] = 'error';
      }
    }
    $row_position++;
  }

  if (empty($rows)) {
    $rows[] = array(array('data' => $form['#empty_text'], 'colspan' => '3'));
  }

  $header = array(t('Title'), t('Weight'), );
  $output = theme('table', array('header' => $header, 'rows' => $rows, 'attributes' => array('id' => 'nodeorder')));
  $output .= drupal_render_children($form);
  $output .= theme('pager');

  return $output;
}

function mnhn_admin_menu_overview_form($variables) {
	
	global $language;
	drupal_add_js('
	jQuery(function() {
		//jQuery("#menu-overview tr").css("background-color","white");
	});','inline');
	
  $form = $variables['form'];
	//exit;
  drupal_add_tabledrag('menu-overview', 'match', 'parent', 'menu-plid', 'menu-plid', 'menu-mlid', TRUE, MENU_MAX_DEPTH - 1);
  drupal_add_tabledrag('menu-overview', 'order', 'sibling', 'menu-weight');

  $header = array(
    t('Menu link'),
    array('data' => t('Enabled'), 'class' => array('checkbox')),
    t('Weight'),
    array('data' => t('Operations'), 'colspan' => '3'),
  );

  $rows = array();
  foreach (element_children($form) as $mlid) {
    if (isset($form[$mlid]['hidden'])) {
	    if($form[$mlid]['#item']['language']!=$language->language){
			$class_row='hide_menu_form ';
	    }else{
	    	$class_row='';
	    }	
	    
	      $element = &$form[$mlid];
	     // print_r($element);
	     // exit;
	      // Build a list of operations.
	      $operations = array();
	      foreach (element_children($element['operations']) as $op) {
	        $operations[] = array('data' => drupal_render($element['operations'][$op]), 'class' => array('menu-operations'));
	      }
	      while (count($operations) < 2) {
	        $operations[] = '';
	      }
	
	      // Add special classes to be used for tabledrag.js.
	      $element['plid']['#attributes']['class'] = array('menu-plid');
	      $element['mlid']['#attributes']['class'] = array('menu-mlid');
	      $element['weight']['#attributes']['class'] = array('menu-weight');
	
	      // Change the parent field to a hidden. This allows any value but hides the field.
	      $element['plid']['#type'] = 'hidden';
	
	      $row = array();
	      $row[] = theme('indentation', array('size' => $element['#item']['depth'] - 1)) . drupal_render($element['title']);
	      $row[] = array('data' => drupal_render($element['hidden']), 'class' => array('checkbox', 'menu-enabled'));
	      $row[] = drupal_render($element['weight']) . drupal_render($element['plid']) . drupal_render($element['mlid']);
	      $row = array_merge($row, $operations);
	
	      $row = array_merge(array('data' => $row), $element['#attributes']);
	      $row['class'][] = 'draggable';
	      $row['class'][] = $class_row;
	      $rows[] = $row;
	    
    }
    
  }
  $output = '';
  if (empty($rows)) {
    $rows[] = array(array('data' => $form['#empty_text'], 'colspan' => '7'));
  }
  $output .= theme('table', array('header' => $header, 'rows' => $rows, 'attributes' => array('id' => 'menu-overview')));
  $output .= drupal_render_children($form);
  return $output;
}
