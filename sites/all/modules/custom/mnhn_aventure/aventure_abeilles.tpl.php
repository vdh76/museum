<?php
// Template Aventure abeilles
/**
 * @file aventure_abeilles.tpl.php
 *
 *

 * aaaaa
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 */
 global $language;
 global $user;
 
$edito=variable_get('mnhn_aventure_abeilles_edito_'.$language->language, array());
$link=variable_get('mnhn_aventure_abeilles_link_'.$language->language, '');
$nid=mnhn_content_autocomplete_nid($link);
	
?>
 <div id="abeilles" class="box col1 moving" data-grid="6-a_6-5_6-0_0-0_8-a_6-8_8-c_8-e">
       <a href="javascript:;" class="plus" title="Déplier"></a>
      <div class="plie_aventure">
           <?php print nl2br($edito['value']);?>
     </div>
     
       <div  class="deplie">
	       <div class="page-detail-wrapper">
	                    
	
			<?php 
			if(array_key_exists(RID_EDITEUR,$user->roles) || array_key_exists(RID_ADMIN,$user->roles) || array_key_exists(RID_SUPERADMIN,$user->roles)){
				$output.='<div class="edit"><a href="/'.$language->language.'/node/'.$nid.'/edit?destination=aventure-museum">Editer</a></div>';
			}	
			
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