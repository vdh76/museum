<?php
// Template Aventure Collections
/**
 * @file aventure_collections.tpl.php
 *
 *

 * 
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 */
 global $language;
 global $user;
 
$link=variable_get('mnhn_aventure_collection_link_'.$language->language, '');
$nid=mnhn_content_autocomplete_nid($link);
?>

  <div id="explore" class="box col2 moving" data-grid="6-8_6-5_6-0_8-8_8-c_0-0_8-e_6-d">
                            <a href="javascript:;" class="plus" title="Déplier"></a>
                            <div class="plie_aventure">
                                <img src="/sites/all/themes/mnhn/pics/visuels/collecs.png" alt="" class="illustr" />
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