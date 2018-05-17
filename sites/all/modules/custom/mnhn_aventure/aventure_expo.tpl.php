<?php
// Template Aventure Edito
/**
 * @file aventure_edito.tpl.php
 *
 *

 * 
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 */
 global $language;
 global $user;
 
$edito=variable_get('mnhn_aventure_expo_edito_'.$language->language, array());
$title=variable_get('mnhn_aventure_expo_title_'.$language->language, '');
$uri=variable_get('mnhn_aventure_expo_image_url_'.$language->language, '');
$link=variable_get('mnhn_aventure_expo_link_'.$language->language, '');
$nid=mnhn_content_autocomplete_nid($link);
if(!empty($uri)){
			$image=theme('image_style', array('style_name' => 'aventure_expo', 'path' => $uri));
}			
?>
<div id="moment" class="box col2 moving" data-grid="6-7_0-0_6-0_8-7_8-b_6-5_8-d_6-c">
  <a href="javascript:;" class="plus" title="Déplier"></a>                        
  <img src="/sites/all/themes/mnhn/pics/titres/expo_du_moment_<?php print $language->language; ?>.png" alt="<?php print t('The exhibition');?>" class="img_titre" />
	<div class="plie_aventure">
	    <div class="illustr"><?php print $image; ?></div>
	    <div class="text_plie">
	    <h2><?php print $title; ?></h2>
	    <?php print $edito['value']; ?>
	    <a href="#" class="more"><?php print t('More details') ?></a>
	  </div>
	</div>
                            
  <div  class="deplie">
       <div class="page-detail-wrapper">
                    

		<?php 
		
		
			if(array_key_exists(RID_EDITEUR,$user->roles) || array_key_exists(RID_ADMIN,$user->roles) || array_key_exists(RID_SUPERADMIN,$user->roles)){
				$output.='<div class="edit"><a href="/'.$language->language.'/node/'.$nid.'/edit?destination=aventure-museum">Editer</a></div><br/>';
			}	
		?>
		
		<?php 
		
				

		$node=node_load($nid);
		
		$uri=$node->field_page_visuel['und'][0]['uri'];
		if(!empty($uri)){
			$output.='<img src="'.file_create_url($uri).'" width="530"  alt="'.$node->field_page_visuel['und'][0]['alt'].'">';
		}
		

		if(!empty($node->field_page_chapo['und'][0]['value'])){
			$output.='<div class="chapo" style="width:530px"><strong>'.nl2br($node->field_page_chapo['und'][0]['value']).'</strong></div>';
		}
	
		
		if($node->field_page_bloc['und'][0]['value']>0){
			foreach($node->field_page_bloc['und'] as $bloc_entity_id){
				$blocs[]=$bloc_entity_id['value'];
			}
			
			$output.=mnhn_content_bloc_page($blocs);
		}

		print $output;
		?>
		</div>                     
     

  </div>
</div>