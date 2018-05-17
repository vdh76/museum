<?php

/**
 * @file
 * Themes the question report
 *
 * Available variables:
 * $form - FAPI array
 *
 * All questions are in form[x] where x is an integer.
 * Useful values:
 * $form[x]['question'] - the question as a FAPI array(usually a form field of type "markup")
 * $form[x]['score'] - the users score on the current question.(FAPI array usually of type "markup" or "textfield")
 * $form[x]['max_score'] - the max score for the current question.(FAPI array of type "value")
 * $form[x]['response'] - the users response, usually a FAPI array of type markup.
 * $form[x]['#is_correct'] - If the users response is correct(boolean)
 * $form[x]['#is_evaluated'] - If the users response has been evaluated(boolean)
 */
//print_r($form);

?>

<div class="quiz_reponse">
<?php
$i=1;
foreach ($form as $key => $sub_form):
  if (!is_numeric($key) || isset($sub_form['#no_report'])) continue;
  unset($form[$key]);
  $c_class = ($sub_form['#is_evaluated']) ? ($sub_form['#is_correct']) ? 'q-correct' : 'q-wrong' : 'q-waiting';
  $skipped = $sub_form['#is_skipped'] ? '<span class="quiz-report-skipped">'. t('(skipped)') .'</span>' : ''?>

	  <div class="quiz_reponse_libelle"><?php print t('Question ')?> n° <?php print $i; ?>: </div>
	  <div class="quiz_reponse_question"> <?php print drupal_render($sub_form['question']);?></div>
	
	  <div class="quiz_reponse_libelle"><?php print t('Response')?>: </div>
	  <div class="quiz_reponse_reponse_libelle"><?php print drupal_render($sub_form['response']); ?></div>

<?php 
$i++;
endforeach; 
?>
</div>
<!--  
<div style="float:right;"><?php print drupal_render_children($form);?></div>
-->
