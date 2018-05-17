<?php
/**
 * @file
 * Contains theme override functions and preprocess functions for the theme.
 *
 * ABOUT THE TEMPLATE.PHP FILE
 *
 *   The template.php file is one of the most useful files when creating or
 *   modifying Drupal themes. You can modify or override Drupal's theme
 *   functions, intercept or make additional variables available to your theme,
 *   and create custom PHP logic. For more information, please visit the Theme
 *   Developer's Guide on Drupal.org: http://drupal.org/theme-guide
 *
 * OVERRIDING THEME FUNCTIONS
 *
 *   The Drupal theme system uses special theme functions to generate HTML
 *   output automatically. Often we wish to customize this HTML output. To do
 *   this, we have to override the theme function. You have to first find the
 *   theme function that generates the output, and then "catch" it and modify it
 *   here. The easiest way to do it is to copy the original function in its
 *   entirety and paste it here, changing the prefix from theme_ to STARTERKIT_.
 *   For example:
 *
 *     original: theme_breadcrumb()
 *     theme override: STARTERKIT_breadcrumb()
 *
 *   where STARTERKIT is the name of your sub-theme. For example, the
 *   zen_classic theme would define a zen_classic_breadcrumb() function.
 *
 *   If you would like to override either of the two theme functions used in Zen
 *   core, you should first look at how Zen core implements those functions:
 *     theme_breadcrumbs()      in zen/template.php
 *     theme_menu_local_tasks() in zen/template.php
 *
 *   For more information, please visit the Theme Developer's Guide on
 *   Drupal.org: http://drupal.org/node/173880
 *
 * CREATE OR MODIFY VARIABLES FOR YOUR THEME
 *
 *   Each tpl.php template file has several variables which hold various pieces
 *   of content. You can modify those variables (or add new ones) before they
 *   are used in the template files by using preprocess functions.
 *
 *   This makes THEME_preprocess_HOOK() functions the most powerful functions
 *   available to themers.
 *
 *   It works by having one preprocess function for each template file or its
 *   derivatives (called template suggestions). For example:
 *     THEME_preprocess_page    alters the variables for page.tpl.php
 *     THEME_preprocess_node    alters the variables for node.tpl.php or
 *                              for node-forum.tpl.php
 *     THEME_preprocess_comment alters the variables for comment.tpl.php
 *     THEME_preprocess_block   alters the variables for block.tpl.php
 *
 *   For more information on preprocess functions and template suggestions,
 *   please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/node/223440
 *   and http://drupal.org/node/190815#template-suggestions
 */


/**
 * Override or insert variables into the html templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("html" in this case.)
 */
function mnhn_preprocess_html(&$vars) {
  $node = menu_get_object();

  if ($node && $node->nid && $node->type=='lettre') {
    $vars['theme_hook_suggestions'][] = 'html__' . $node->type;
  }
  
  if ($node && $node->nid && $node->type=='newsletter') {
    $vars['theme_hook_suggestions'][] = 'html__' . $node->type;
  }
  
	if(arg(2)=='take'){
    drupal_add_css(drupal_get_path('theme','mnhn').'/css/jquery.fancybox.css');
		drupal_add_js(drupal_get_path('theme','mnhn').'/js/jquery.fancybox.js');
  }
}

/**
 * Override or insert variables into the page templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
function mnhn_preprocess_page(&$variables, $hook) {

	$node = menu_get_object();
  
  if (arg(2) == 'hd') {
    $variables['theme_hook_suggestions'][] = 'page__hd';
  }
  
 if ($node && $node->nid && $node->type=='lettre') {
    $variables['theme_hook_suggestions'][] = 'page__' . $node->type;
  }
 
 if ($node && $node->nid && $node->type=='newsletter') {
    $variables['theme_hook_suggestions'][] = 'page__' . $node->type;
  }
}

/**
 * Override or insert variables into the node templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */

function mnhn_preprocess_node(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // Optionally, run node-type-specific preprocess functions, like
  // STARTERKIT_preprocess_node_page() or STARTERKIT_preprocess_node_story().
  $function = __FUNCTION__ . '_' . $variables['node']->type;
  if (function_exists($function)) {
    $function($variables, $hook);
  }
}

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
function mnhn_preprocess_block(&$variables, $hook) {
  // Add a count to all the blocks in the region.
  $variables['classes_array'][] = 'count-' . $variables['block_id'];
}

function mnhn_menu_link(array $variables) {
	
  $element = $variables['element'];
 // print_r($element);
 // exit;
  $sub_menu = '';
  if(substr($element['#href'],0,4) == 'http') {
  	$element['#localized_options']['attributes']['target']='_blank';
  }	
  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

function mnhn_item_list($variables) {
	
	
  $items = $variables['items'];
  $title = $variables['title'];
  $type = $variables['type'];
  $attributes = $variables['attributes'];

  //$output = '<div class="item-list">';
  if (isset($title)) {
    $output .= '<h2>' . $title . '</h2>';
  }

  if (!empty($items)) {
    $output .= "<$type" . drupal_attributes($attributes) . '>';
    $num_items = count($items);
    foreach ($items as $i => $item) {
      $attributes = array();
      $children = array();
      $data = '';
      if (is_array($item)) {
        foreach ($item as $key => $value) {
          if ($key == 'data') {
            $data = $value;
          }
          elseif ($key == 'children') {
            $children = $value;
          }
          else {
            $attributes[$key] = $value;
          }
        }
      }
      else {
        $data = $item;
      }
      if (count($children) > 0) {
        // Render nested list.
        $data .= theme_item_list(array('items' => $children, 'title' => NULL, 'type' => $type, 'attributes' => $attributes));
      }
      
      if ($i == 0) {
        $attributes['class'] .= ' first';
      }
      if ($i == $num_items - 1) {
        $attributes['class'] .= ' last';
      }
      
      $output .= '<li' . drupal_attributes($attributes) . '>' . $data . "</li>\n";
    }
    $output .= "</$type>";
  }
  //$output .= '</div>';
  return $output;
}

function mnhn_pager($variables) {
  $tags = $variables['tags'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  $quantity = $variables['quantity'];
  global $pager_page_array, $pager_total;

  // Calculate various markers within this pager piece:
  // Middle is used to "center" pages around the current page.
  $pager_middle = ceil($quantity / 2);
  // current is the page we are currently paged to
  $pager_current = $pager_page_array[$element] + 1;
  // first is the first page listed by this pager piece (re quantity)
  $pager_first = $pager_current - $pager_middle + 1;
  // last is the last page listed by this pager piece (re quantity)
  $pager_last = $pager_current + $quantity - $pager_middle;
  // max is the maximum page number
  $pager_max = $pager_total[$element];
  // End of marker calculations.

  // Prepare for generation loop.
  $i = $pager_first;
  if ($pager_last > $pager_max) {
    // Adjust "center" if at end of query.
    $i = $i + ($pager_max - $pager_last);
    $pager_last = $pager_max;
  }
  if ($i <= 0) {
    // Adjust "center" if at start of query.
    $pager_last = $pager_last + (1 - $i);
    $i = 1;
  }
  // End of generation loop preparation.

  //$li_first = theme('pager_first', array('text' => (isset($tags[0]) ? $tags[0] : t('« first')), 'element' => $element, 'parameters' => $parameters));
  $li_previous = theme('pager_previous', array('text' => (isset($tags[1]) ? $tags[1] : '<'), 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
  $li_next = theme('pager_next', array('text' => (isset($tags[3]) ? $tags[3] : '>'), 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
  //$li_last = theme('pager_last', array('text' => (isset($tags[4]) ? $tags[4] : t('last »')), 'element' => $element, 'parameters' => $parameters));

  if ($pager_total[$element] > 1) {
    if ($li_first) {
      $items[] = array(
        'class' => array('pager-first'), 
        'data' => $li_first,
      );
    }
    if ($li_previous) {
      $items[] = array(
        'class' => array('pager-previous'), 
        'data' => $li_previous,
      );
    }

    // When there is more than one page, create the pager list.
    if ($i != $pager_max) {
      if ($i > 1) {
        $items[] = array(
          
          'data' => '…',
        );
      }
      // Now generate the actual pager piece.
      for (; $i <= $pager_last && $i <= $pager_max; $i++) {
        if ($i < $pager_current) {
          $items[] = array(
            
            'data' => theme('pager_previous', array('text' => $i, 'element' => $element, 'interval' => ($pager_current - $i), 'parameters' => $parameters)),
          );
        }
        if ($i == $pager_current) {
          $items[] = array(
            
            'data' => $i,
          );
        }
        if ($i > $pager_current) {
          $items[] = array(
         
            'data' => theme('pager_next', array('text' => $i, 'element' => $element, 'interval' => ($i - $pager_current), 'parameters' => $parameters)),
          );
        }
      }
      if ($i < $pager_max) {
        $items[] = array(
          'class' => array('pager-ellipsis'), 
          'data' => '…',
        );
      }
    }
    // End generation.
    if ($li_next) {
      $items[] = array(
        
        'data' => $li_next,
      );
    }
    if ($li_last) {
      $items[] = array(
         
        'data' => $li_last,
      );
    }
    return '<div class="pagination">'.theme('item_list', array(
      'items' => $items)).'</div>';
  }
}

function mnhn_pager_previous($variables) {
  $text = $variables['text'];
  $element = $variables['element'];
  $interval = $variables['interval'];
  $parameters = $variables['parameters'];
  global $pager_page_array;
  $output = '';

  // If we are anywhere but the first page
  if ($pager_page_array[$element] > 0) {
    $page_new = pager_load_array($pager_page_array[$element] - $interval, $element, $pager_page_array);

    // If the previous page is the first page, mark the link as such.
    if ($page_new[$element] == 0) {
      $output = theme('pager_first', array('text' => $text, 'element' => $element, 'parameters' => $parameters));
    }
    // The previous page is not the first page.
    else {
      $output = theme('pager_link', array('text' => $text, 'page_new' => $page_new, 'element' => $element, 'parameters' => $parameters));
    }
  }

  return $output;
}

function mnhn_pager_link($variables) {
  $text = $variables['text'];
  $page_new = $variables['page_new'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  $attributes = $variables['attributes'];

  $page = isset($_GET['page']) ? $_GET['page'] : '';
  if ($new_page = implode(',', pager_load_array($page_new[$element], $element, explode(',', $page)))) {
    $parameters['page'] = $new_page;
  }

  $query = array();
  if (count($parameters)) {
    $query = drupal_get_query_parameters($parameters, array());
  }
  if ($query_pager = pager_get_query_parameters()) {
    $query = array_merge($query, $query_pager);
  }

  // Set each pager link title
  if (!isset($attributes['title'])) {
    static $titles = NULL;
    if (!isset($titles)) {
      $titles = array(
        t('') => t('Go to first page'), 
        t('<') => t('Go to previous page'), 
        t('>') => t('Go to next page'), 
        t('') => t('Go to last page'),
      );
    }
    if (isset($titles[$text])) {
      $attributes['title'] = $titles[$text];
    }
    elseif (is_numeric($text)) {
      $attributes['title'] = t('Go to page @number', array('@number' => $text));
    }
  }

  // @todo l() cannot be used here, since it adds an 'active' class based on the
//   path only (which is always the current path for pager links). Apparently,
//   none of the pager links is active at any time - but it should still be
//   possible to use l() here.
  // @see http://drupal.org/node/1410574
  $attributes['href'] = url($_GET['q'], array('query' => $query));
  return '<a' . drupal_attributes($attributes) . '>' . $text. '</a>';
}

function mnhn_preprocess_search_results(&$variables) {
	global $language;
	
			
	
  $variables['search_results'] = '';
  if (!empty($variables['module'])) {
    $variables['module'] = check_plain($variables['module']);
  }
  foreach ($variables['results'] as $result) {
  	//print_r($result);
  	//exit;
  	//if($result['node']->language==$language->language && $result['node']->type!='blog'){
    	//$variables['search_results'] .= theme('search_result', array('result' => $result, 'module' => $variables['module']));
    	$variables['search_results'] .= theme('search', array('result' => $result));
  	//}
  }
  $variables['pager'] = theme('pager', array('tags' => NULL));
  $variables['theme_hook_suggestions'][] = 'search_results__' . $variables['module'];
}

function mnhn_customerror($variables) {
	
  $code = $variables['code'];
  if($code=='404'){
  	drupal_set_title(t('Page not found'));
  	$variables['content']='
							<h2>'.t('Page not found.').'</h2>
								<div class="error_404">
								'.t('The requested page was not found.').'
							</div>';
  }else{
  	drupal_set_title(t('Acces denied'));
  	$variables['content']='
								<h2>'.t('Acces denied').'</h2>
							<div class="error_404">
								'.t('You are not authorised to access this page.').'
							</div>';
  	
  }
  $content = $variables['content'];
  return $content;
}

function mnhn_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];
	if(arg(0)=='search'){
		
		$breadcrumb=array();
		$breadcrumb[]=l(t('Home'), '');
		$breadcrumb[]=t('Search');
	}
	
  if (!empty($breadcrumb)) {
    // Provide a navigational heading to give context for breadcrumb links to
    // screen-reader users. Make the heading invisible with .element-invisible.
    $output = '<h2 class="element-invisible">' . t('You are here') . '</h2>';

    $output .= '<div class="breadcrumb">' . implode(' &gt; ', $breadcrumb) . '</div>';
    return $output;
  }
}

/**
 * Theme the single question node
 *
 * @param $node
 *  The question node
 * @return
 *  Themed html feedback
 */
function mnhn_quiz_single_question_node($variables) {
  $node = $variables['question_node'];
  // This might seem meaningless, but it is designed this way to allow themes to add more
  // meaningful stuff here...
  //print_r($node);
  //exit;
  $question=node_load($node->nid);
  $uri=$question->field_quizz_visuel['und'][0]['uri'];
  $image=theme('image_style', array('style_name' => 'quiz', 'path' => $uri));
  if($image!=''){
  	$output=$image;
  }
  $output.=drupal_render($node->body);
  $output.=drupal_render($node->content['body']);
  return $output;;
}

/**
 * Theme the question creation form
 *
 * @param $form
 *  Question creation form
 */
function mnhn_quiz_question_creation_form($variables) {
  $form = $variables['form'];
  module_load_include('inc', 'quiz', 'quiz.admin');
  quiz_set_auto_title();
 
}

/**
 * Theme the question navigation form(Back, Next, Skip buttons...)
 *
 * @param $form
 *  Form holding the navigation buttons
 */
function mnhn_quiz_question_navigation_form($variables) {
  $form = $variables['form'];
  if (!isset($form['#last'])) {
    return drupal_render_children($form).'<div style="height:30px">&nbsp;</div>';
  }
  else {
    $submit = drupal_render($form['submit']) . drupal_render($form['op']);
    $to_return = '<div>' . drupal_render_children($form) . '</div>';
   
    $to_return .= '<div>' . $submit . '</div>';
     $to_return .= '<div style="height:30px">&nbsp;</div>';
    return $to_return;
  }
}

/**
 * Theme the summary page after the quiz has been completed.
 *
 * @param $quiz
 *  The quiz node object.
 * @param $questions
 *  The questions array as defined by _quiz_get_answers.
 * @param $score
 *  Array of score information as returned by quiz_calculate_score().
 * @param $summary
 *  Filtered text of the summary.
 * @return
 *  Themed html.
 *
 * @ingroup themeable
 */
function mnhn_quiz_take_summary($variables) {
  $quiz = $variables['quiz'];
  $questions = $variables['questions'];
  $score = $variables['score'];
  $summary = $variables['summary'];
  // Set the title here so themers can adjust.
  drupal_set_title($quiz->title);
	
  $output.='<div class="quiz_title">'.t('Results').'</div>';
  // Display overall result.
 
  if (!empty($score['possible_score'])) {
    if (!$score['is_evaluated']) {
      $msg = t('Parts of this @quiz have not been evaluated yet. The score below is not final.', array('@quiz' => QUIZ_NAME));
      drupal_set_message($msg, 'warning');
    }
    // ' . t('You got %num_correct of %question_count possible points.', array('%num_correct' => $score['numeric_score'], '%question_count' => $score['possible_score']))
    $output .= '<div id="quiz_score_possible">Vous avez répondu à l\'ensemble du quiz.<br/>Votre score est de '.$score['numeric_score'].'/'.$score['possible_score'].'</div>' . "\n";
    
    //$output .= '<div id="quiz_score_percent">' . t('Your score: %score %', array('%score' => $score['percentage_score'])) . '</div>' . "\n";
  }
  /*
  if (isset($summary['passfail'])) {
    $output .= '<div id="quiz_summary">' . $summary['passfail'] . '</div>' . "\n";
  }
  if (isset($summary['result'])) {
    $output .= '<div id="quiz_summary">' . $summary['result'] . '</div>' . "\n";
  }
  */
  // Get the feedback for all questions. These are included here to provide maximum flexibility for themers
  if ($quiz->display_feedback) {
    $form = drupal_get_form('quiz_report_form', $questions);
    $output .= drupal_render($form);
  }
  return $output;
}

/**
 * Theme function for the multichoice report
 *
 * @param $data
 *  Array of data to be presented in the report
 */
function mnhn_multichoice_response($variables) {
	

  foreach ($variables['data'] as &$alternative) {
    if($alternative['is_correct']==2){
    	$correct_answer.=$alternative['answer'];
    }
    
  	if($alternative['is_chosen']==1){
    	$user_answer.=$alternative['answer'];
    }
    
  }	
  
  $output='<table id="reponses_quizz">
  				<tr class="header_reponse">
  					<td>La bonne réponse est </td><td>Votre réponse </td>
  				</tr>
  				<tr class="list_reponse">
  					<td>'.$correct_answer.'</td><td>'.$user_answer.'</td>
  				</tr>
  				</table>';
  
  return $output;
  
}

function mnhn_quiz_progress($variables) {
  $question_number = $variables['question_number'];
  $num_of_question = $variables['num_questions'];
  // TODO Number of parameters in this theme funcion does not match number of parameters found in hook_theme.
  // Determine the percentage finished (not used, but left here for other implementations).
  //$progress = ($question_number*100)/$num_of_question;

  // Get the current question # by adding one.
  $current_question = $question_number + 1;

  if ($variables['allow_jumping']) {
    $current_question = theme('quiz_jumper', array('current' => $current_question, 'num_questions' => $num_of_question));
  }

  $output  = '';
  $output .= '<div id="quiz_progress">';
  $output .= t('Question n°!x', array('!x' => $current_question));
  $output .= '</div>' . "\n";

  return $output;
}

function mnhn_commerce_cart_empty_page() {
	global $language;
  return ' <div class="page-header">
                    
                        <h1>'.t('My !strong_debut cart !strong_fin',array('!strong_debut'=>'<strong>','!strong_fin'=>'</strong>')).'</h1>
                        
                        <ol id="steps" class="step1">
                            <li class="etape1 selected">'.t('My cart').'</li>
                            <li class="etape2">'.t('Log in !cart',array('!cart'=>'')).'</li>
                            <li class="etape3">'.t('Identification').'</li>
                            <li class="etape4">'.t('Payment').'</li>
                        </ol>

                    </div>
    
                    <div class="page-detail-wrapper">
                    
                        ' . t('Your shopping cart is empty.') . '
                         <div class="actions">
                            <div class="bt_continue clearfix">
                                <a href="/'.$language->language.'/'.drupal_get_path_alias("boutique").'" class="link_back">'.t('Continue shopping').'</a>                        
                            </div>
                        </div>
                      </div>';
}

function mnhn_commerce_checkout_review($variables) {
	global $user;
	$order_id = commerce_cart_order_id($user->uid);
	
	$output=views_embed_view('commerce_cart_summary', 'default',$order_id);
	
	
	return $output;	
}	


