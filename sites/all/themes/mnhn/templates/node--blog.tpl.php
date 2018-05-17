<?php
//-591648709&defaultReal=YHLUBR

//print rpHash(utf8_decode('YHLUBR')).'++'.'-591648709';
//exit;

drupal_add_js(drupal_get_path('theme','mnhn').'/js/libs/jquery.realperson.min.js');
drupal_add_css(drupal_get_path('theme','mnhn').'/css/jquery.realperson.css');

drupal_add_js('
	jQuery(function() {
		jQuery(".mainmenu li:eq(1) a").addClass("activ");
		//jQuery("#defaultReal").realperson();
	});','inline');


global $language;


if($node->field_blog_tag['und'][0]['tid']>0){
	$w=0;	
	foreach($node->field_blog_tag['und'] as $tag){
		
			$tab_tags[]='<a href="/'.drupal_get_path_alias('taxonomy/term/'.$tag['tid']).'">'.mnhn_content_get_term($tag['tid']).'</a>';
			if($teaser && $w==2){
				break;
			}
		$w++;
	}
	$tags=implode(" - ", $tab_tags);
}


$date=mnhn_content_format_date_medium($node->field_blog_date['und'][0]['value'],$node->field_blog_date['und'][0]['value']);
$uri=$node->field_blog_visuel['und'][0]['uri'];
if(!empty($uri)){
	$image=theme('image_style', array('style_name' => 'blog', 'path' => $uri));
}
if($teaser){
?>

<div class="post">
   <div class="entete">
       <h2 class="entry-title"><?php print $node->title?></h2>
       <p class="date"><?php print $date; ?></p>
  </div>
  <?php print $image?>
  <p class="chapo"><?php print nl2br($node->field_blog_accroche['und'][0]['value']); ?></p>
 
  <a href="/<?php print $language->language?>/<?php print drupal_get_path_alias('node/'.$node->nid)?>" class="link_post">Lire l'article complet</a>
  <div class="comments">
       <p class="link_comment"><strong><?php print mnhn_blog_comment_nb($node->nid)?></strong>  - <a href="/<?php print $language->language?>/<?php print drupal_get_path_alias('node/'.$node->nid)?>#comment_anchor">Laisser un commentaire</a></p>
       <p class="tags"><?php print $tags?></p>
  </div>
</div>

<?php 
}else{

	
?>

	<div class="post">
	   <div class="entete">
	       <h2 class="entry-title"><?php print $node->title?></h2>
	       <p class="date"><?php print $date; ?></p>
	  </div>
	  <?php print $image?>
	  <p class="chapo"><?php print nl2br($node->field_blog_accroche['und'][0]['value']); ?></p>
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
	 <p class="tags"><?php print $tags?></p>
	     <div class="comments">
       		<p class="link_comment"><strong><?php print mnhn_blog_comment_nb($node->nid)?></strong>  - <a href="javascript:;" id="link_post_comment">Laisser un commentaire</a></p>
       		
  		</div>
  		
  		<div class="comment_wrap"><?php print mnhn_blog_comment_list($node->nid);?></div>
  		
  		<div class="comments">
            <p class="link_comment"><strong>Poster un nouveau commentaire</strong></p>
         </div>
         <div class="post_comment_message">
			Votre commentaire a été ajouté à la file d'attente pour modération par l'administrateur du site et il sera publié après son approbation.
		</div>
         <a name="comment_anchor"></a>
         <div class="post_comment_form" id="comment" rel="blog_<?php print $node->nid; ?>">
			 <ul>
               <li>
                  <label for="rue">Votre nom <span>*</span> :</label>
                   <input type="text" name="nom" value="" id="nom" />
                </li>
                <li>
                   <label for="adresse">Votre commentaire <span>*</span> :</label>
                    <textarea name="commentaire" rows="8" cols="40" id="commentaire"></textarea>
                    </li>
                </ul>
                                
			<div class="spam">
				<div class="spam_title">Dispostif anti-spam <span>*</span></div>
				<script type="text/javascript">
		 var RecaptchaOptions = {
		    theme : "blackglass"
		 };
		 </script>

                <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                <div class="g-recaptcha" data-sitekey="6LcMllkUAAAAADxrtXIEt8dxTKFAJR-hsPMSpJ8E"></div>
                
			</div>
			<div class="clearfix"></div>
			<br/>
			<a href="javascript:;" class="link">Envoyer</a><div class="loading"></div>
			
			
			<br/><br/><span>* champs obligatoires</span>
		</div>
         
         
	</div>




<?php 
/*
if($node->field_page_bloc['und'][0]['value']>0){
	foreach($node->field_page_bloc['und'] as $bloc_entity_id){
		$blocs[]=$bloc_entity_id['value'];
	}
	
	$output.=mnhn_content_bloc_page($blocs);
}
*/

?>



<?php } ?>