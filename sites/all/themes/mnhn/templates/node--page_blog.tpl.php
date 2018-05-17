<?php 

global $language;




$uri=$node->field_page_blog_visuel['und'][0]['uri'];
if(!empty($uri)){
	$image=theme('image_style', array('style_name' => 'blog', 'path' => $uri));
}

?>

<div class="post">
	   <div class="entete">
	       <h2 class="entry-title"><?php print $node->title?></h2>
	      
	  </div>
	  <?php print $image?>
	  <p class="chapo"><?php print nl2br($node->field_page_blog_chapo['und'][0]['value']); ?></p>
	</div>	  
	  <div class="page-detail-wrapper">
			  <?php 
		
			if($node->field_page_bloc['und'][0]['value']>0){
				foreach($node->field_page_bloc['und'] as $bloc_entity_id){
					$blocs[]=$bloc_entity_id['value'];
				}
				
				$output.=mnhn_content_bloc_page($blocs);
			}
			print $output;
			?>
	 </div>
	  
         





