<div class="page-detail-wrapper">
<div class="bloc_page_wrapper">

<?php 
			
$output.='<div class="accordion"><h2 class="title_accordion selected">'.$node->title.'</h2><div class="item animation" style="display:block">';
$uri_visuel=$node->field_quiz_visuel['und'][0]['uri'];
if(!empty($uri_visuel)){
	$output.=theme('image_style', array('style_name' => 'vignette_oeuvre', 'path' => $uri_visuel, 'attributes' => array('class' => 'vignet')));
}
$output.='<div class="text text-visuel">';
$output.=$node->field_quiz_accroche['und'][0]['value'];
$output.='<a id="quizz_'.$node->nid.'" href="/quizz/'.$node->nid.'" data-fancybox-type="iframe" class="link_anim link_media">'.t('Play the quiz').'</a>';	
$output.='</div>';
	

$output.='</div></div><div class="clear"></div>';

drupal_add_js('
jQuery(function() {

	
	jQuery("#quizz_'.$node->nid.'").fancybox({
		minHeight : 550, 
		width : 	640,
		closeBtn	: true,
		closeClick	: true,
		openEffect	: "none",
		closeEffect	: "none",
		padding	: 0,
		beforeLoad  : function(){
		jQuery(".fancybox-wrap,.fancybox-inner,.page-node-quiz-").css({"overflow-x":"hidden"});
		}
	});
});','inline');
					
print $output;			

?>
</div>
</div>
