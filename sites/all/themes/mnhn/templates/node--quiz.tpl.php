<div class="page-detail-wrapper">
<div class="bloc_page_wrapper">
<h2><?php print $node->title; ?></h2>
<?php 



	
				
$output.='<div class="quizz">';
$uri_visuel=$node->field_quizz_visuel['und'][0]['uri'];
if(!empty($uri_visuel)){
	$output.='<div style="align:center">'.theme('image_style', array('style_name' => 'vignette_oeuvre', 'path' => $uri_visuel)).'</div>';
}
$output.='<div class="legende">';
$output.=$node->field_quizz_accroche['und'][0]['value'];
$output.='<span><a id="quizz_'.$node->nid.'" href="quizz/'.$node->nid.'" data-fancybox-type="iframe">'.t('Play the quiz').'</a></span>';	
$output.='</div>';
	

$output.='</div><div class="clear"></div>';

drupal_add_js('
jQuery(function() {
	jQuery("#quizz_'.$node->nid.'").fancybox({
		minHeight : 550, 
		width : 	570,
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
<br/><br/><br/><br/>
