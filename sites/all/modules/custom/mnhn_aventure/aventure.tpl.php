<?php
// Template Aventure
/**
 * @file aventure.tpl.php
 *
 * $nid_aventure

 * 
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 */
 global $language;
 global $user;
 
 if($nid_aventure>0){
 	$aventure=node_load($nid_aventure);
 	$nid_quizz=$aventure->field_aventure_quizz['und'][0]['nid'];

 	drupal_add_js('


	
		jQuery(function() {
				jQuery(".nav_aventure").live("click",function(){
					jQuery(".wrap_quizz_ajax").html("");
		 			jQuery(".aventure_step").hide();
		 			if(jQuery(this).attr("rel")==1){
		 				load_quiz(1);
		 			}
		 			jQuery("#aventure_step_"+jQuery(this).attr("rel")).show();
 					jQuery("#spaces").css("height","auto");
 					
 			
		    	});
		    
		   		 jQuery(".btn_code").click(function(){
		    		jQuery(this).parent().css("opacity",0.5);
		    				var code_secret=jQuery(this).parent().find("input").map(function() {
							return jQuery(this).val();
					}).get().join("");
		    		
		    		
					jQuery.ajax({
						  url: "/'.$language->language.'/aventure-code/'.$nid_aventure.'",
						  type: "POST",
						  data: {code: code_secret},
						  dataType: "html",
						  success: function(data){
						  		if(data.substr(0,2)=="ok"){
						  			jQuery(".aventure_step").hide();
			 						jQuery("#aventure_step_5").show();
						  			var height=jQuery("#aventure_step_5").height();
									jQuery("#spaces").css("height",height+500);
			 						jQuery(".code_secret").css("opacity",1);
			 						jQuery(".code_secret input").val("");
						  		}else{
						  			jQuery(".code_secret").css("opacity",1);
						  			alert("Code incorrect !");
						  		}
						 }
					
		    		});
		    		
		    		
		    		
		     
		  });  
		  
		   jQuery(".code_secret input").keyup(function(){
		    		 	var index=jQuery(this).index();
		    		 	 jQuery(".code_secret input:eq("+(index+1)+")").focus();
		    		 });
		    		 
		    jQuery("#pars .plie_aventure .btn_start").click(function(){
							
		    		 	 jQuery("#pars .plus").trigger("click");
									
		    		 }); 
		    		 		 
		    jQuery("#moment .more").click(function(){
		    		 	 jQuery("#moment .plus").trigger("click");
		    		 }); 
		    
		});

		','inline');
 	
 	
 }
 
 

?>

                     
<div id="ratamus">
  <a href="/sites/default/files/animation/ratamus/index.html" target="_blank">
  <img src="/sites/all/themes/mnhn/img/aventure/ratamus_affiche.png" alt="<?php print t('Set off on an adventure !'); ?>" class="titre" />
  </a>
  <div class="col_right">
    <h3>A toi de jouer ! </h3>
    <p>Le méchant Ratamoche a dérobé plusieurs pièces importantes de l'exposition du Muséum !
      <br/>Avec l’aide de Ratamus, retrouve ces objets aux quatre coins du globe.
      <br/>Bonne chance !
    </p>
  </div>
</div>
                    <div id="spaces">
                    
                       <?php print theme('aventure_edito');?>
                       <?php print theme('aventure_expo');?> 
                       
                        
                        <div id="pars" class="box col2 moving" data-grid="0-5_0-0_4-0_2-5_2-9_0-3_2-b_0-a">
                            <a href="javascript:;" class="plus" title="Déplier"></a>
                            <img src="/sites/all/themes/mnhn/pics/titres/pars_a_l_aventure_<?php print $language->language; ?>.png" alt="<?php print t('Set off on an adventure !'); ?>" class="titre" />
                            <img src="/sites/all/themes/mnhn/pics/visuels/coin_pars_aventure.png" alt="" class="coin" />
                            <div class="plie_aventure">
                            	
                                <img src="/sites/all/themes/mnhn/pics/visuels/map.png" alt="Carte" />
                                <h2><?php print $aventure->title; ?></h2>
                                <p><?php print nl2br($aventure->field_aventure_presentation['und'][0]['value'])?></p>
                                <div class="clearfix"></div>
                                <a href="javascript:;" class="btn btn_start" style="display:block"><?php print t('Let\'s start the adventure !')?></a>
                            </div>
                            
                            <div id="step1" class="deplie">
                            	<?php if(array_key_exists(RID_EDITEUR,$user->roles) || array_key_exists(RID_ADMIN,$user->roles) || array_key_exists(RID_SUPERADMIN,$user->roles)){
								print '<div class="edit"><a href="/'.$language->language.'/node/'.$nid_aventure.'/edit?destination=aventure-museum">Editer</a></div>';
								}	?>
                            	<div id="aventure_step_0" class="aventure_step">
                                	<?php 
                                	$uri_mascotte=$aventure->field_aventure_mascotte['und'][0]['uri'];
                                	if(!empty($uri_mascotte)){
                                		print '<div class="mascotte">'.theme('image_style', array('style_name' => 'bloc_visuel', 'path' => $uri_mascotte)).'</div>';
                                	}
                                	?>
	                                
	                                <div class="intro_steps">
	                                    <p class="step1"><?php print $aventure->field_aventure_etape_1['und'][0]['value']; ?><img src="/sites/all/themes/mnhn/pics/puces/fleche_avent_bas.png" alt="" /></p>
	                                    <p class="step2"><?php print $aventure->field_aventure_etape_2['und'][0]['value']; ?><img src="/sites/all/themes/mnhn/pics/puces/fleche_avent_haut.png" alt="" /></p>
	                                    <p class="step3"><?php print $aventure->field_aventure_etape_3['und'][0]['value']; ?><img src="/sites/all/themes/mnhn/pics/puces/fleche_avent_bas.png" alt="" /></p>
	                                    <p class="step4"><?php print $aventure->field_aventure_etape_4['und'][0]['value']; ?>.<img src="/sites/all/themes/mnhn/pics/puces/fleche_avent_haut.png" alt="" /></p>
	                                    <a href="javascript:;" class="link_step1 nav_aventure" rel="1" title="<?php print t('Step 1')?>"></a>
	                                    <a href="javascript:;" class="link_step2 nav_aventure" rel="3" title="<?php print t('Step 2')?>"></a>
	                                    <a href="javascript:;" class="link_step3 nav_aventure" rel="4" title="<?php print t('Step 3')?>"></a>
	                                    <img src="/sites/all/themes/mnhn/pics/fonds/steps_avent_4_<?php print $language->language;?>.jpg" alt="" class="steps" />
	                                </div>

                                	 <a href="javascript:;" class="btn btn_start nav_aventure" rel="1"><?php print t('Let\'s start !')?></a>
                                </div>
                                
                               
                                
                                <div id="aventure_step_1" class="aventure_step">
                                	<div id="header_aventure_menu_1" class="nav_step">
                                		<a href="javascript:;" class="link_step1 nav_aventure" rel="1" title="<?php print t('Step 1')?>"></a>
	                                    <a href="javascript:;" class="link_step2 nav_aventure" rel="3" title="<?php print t('Step 2')?>"></a>
	                                    <a href="javascript:;" class="link_step3 nav_aventure" rel="4" title="<?php print t('Step 3')?>"></a>
                                	</div>
                                	<?php 
                                	$uri_viseul_1=$aventure->field_aventure_visuel_1['und'][0]['uri'];
                                	if(!empty($uri_viseul_1)){ ?>
                                	<img src="<?php print file_create_url($uri_viseul_1); ?>" />
                                	<?php } ?>
                                	<?php print mnhn_quizz_bloc($nid_quizz)?>
                                </div>
                                
                                 <div id="aventure_step_2" class="aventure_step">
                                	<div id="header_aventure_menu_1" class="nav_step">
                                		<a href="javascript:;" class="link_step1 nav_aventure" rel="1" title="<?php print t('Step 1')?>"></a>
	                                    <a href="javascript:;" class="link_step2 nav_aventure" rel="3" title="<?php print t('Step 2')?>"></a>
	                                    <a href="javascript:;" class="link_step3 nav_aventure" rel="4" title="<?php print t('Step 3')?>"></a>
                                	</div>
                                	<!--  
                                	<img src="/sites/all/themes/mnhn/pics/fonds/fin_etape_1.png" alt=""/>
                                	-->
                                	<?php 
                                	$uri_viseul_1=$aventure->field_aventure_visuel_1['und'][0]['uri'];
                                	if(!empty($uri_viseul_1)){ ?>
                                	<img src="<?php print file_create_url($uri_viseul_1); ?>" />
                                	<?php } ?>
                                	
	                                <div class="step_text">
	                               
	                               	 <?php print $aventure->field_aventure_texte_1['und'][0]['value']; ?>
	                                </div>
                                	
                                	<?php  
                                	$uri_mascotte_1=$aventure->field_aventure_mascotte_1['und'][0]['uri'];
                                	if(!empty($uri_mascotte)){
                                		print '<div class="mascotte">'.theme('image_style', array('style_name' => 'bloc_visuel', 'path' => $uri_mascotte_1)).'</div>';
                                	}
                                	?>
                                	<div class="clearfix"></div>
	                                <div class="indice">
	                                		
	                                		<div class="indice_text"><div class="indice_title"><?php print t('Hint')?></div><?php print $aventure->field_aventure_indice_1['und'][0]['value']; ?></div>
	                                	</div>
	                              <div class="clearfix"></div>
	                                 <a class="btn btn_prev nav_aventure" rel="0" href="javascript:;"><?php print t('Previous')?></a>
	                                <a class="btn btn_next nav_aventure" rel="3" href="javascript:;"><?php print t('Next')?></a>
	                             </div>
	                             
	                             <div id="aventure_step_3" class="aventure_step">
                                	<div id="header_aventure_menu_2" class="nav_step">
                                		<a href="javascript:;" class="link_step1 nav_aventure" rel="1" title="<?php print t('Step 1')?>"></a>
	                                    <a href="javascript:;" class="link_step2 nav_aventure" rel="3" title="<?php print t('Step 2')?>"></a>
	                                    <a href="javascript:;" class="link_step3 nav_aventure" rel="4" title="<?php print t('Step 3')?>"></a>
                                	</div>
                                	<?php 
                                	$uri_viseul_2=$aventure->field_aventure_visuel_2['und'][0]['uri'];
                                	if(!empty($uri_viseul_2)){ ?>
                                	<img src="<?php print file_create_url($uri_viseul_2); ?>" />
                                	<?php } ?>
                                	
                                	
	                                <div class="step_text">
	                                <div class="step_title"></div>
	                               	 <?php print $aventure->field_aventure_texte_2['und'][0]['value']; ?>
	                                </div>
                                	
                                	<?php  
                                	$uri_mascotte_2=$aventure->field_aventure_mascotte_2['und'][0]['uri'];
                                	if(!empty($uri_mascotte)){
                                		print '<div class="mascotte">'.theme('image_style', array('style_name' => 'bloc_visuel', 'path' => $uri_mascotte_2)).'</div>';
                                	}
                                	?>
	                                 
	                                
	                                
	                              <div class="clearfix"></div>
	                                 <a class="btn btn_prev nav_aventure" rel="0" href="javascript:;"><?php print t('Back')?></a>
	                                 <a class="btn btn_next nav_aventure" rel="4" href="javascript:;"><?php print t('Next')?></a>
	                                
	                             </div>
	                             
	                             <div id="aventure_step_4" class="aventure_step">
                                	<div id="header_aventure_menu_3" class="nav_step">
                                		<a href="javascript:;" class="link_step1 nav_aventure" rel="1" title="<?php print t('Step 1')?>"></a>
	                                    <a href="javascript:;" class="link_step2 nav_aventure" rel="3" title="<?php print t('Step 2')?>"></a>
	                                    <a href="javascript:;" class="link_step3 nav_aventure" rel="4" title="<?php print t('Step 3')?>"></a>
                                	</div>
                                	<?php 
                                	$uri_viseul_3=$aventure->field_aventure_visuel_3['und'][0]['uri'];
                                	if(!empty($uri_viseul_3)){ ?>
                                	<img src="<?php print file_create_url($uri_viseul_3); ?>" />
                                	<?php } ?>
                                	
                                	
	                                <div class="step_text">
	                                <div class="step_title"></div>
	                               	<?php print $aventure->field_aventure_texte_3['und'][0]['value']; ?>
	                                </div>
                                	
                                	<?php  
                                	$uri_mascotte_3=$aventure->field_aventure_mascotte_3['und'][0]['uri'];
                                	if(!empty($uri_mascotte_3)){
                                		print '<div class="mascotte">'.theme('image_style', array('style_name' => 'bloc_visuel', 'path' => $uri_mascotte_3)).'</div>';
                                	}
                                	?>
	                                 <div class="clearfix"></div>
	                               <div class="code_secret">
	                               <?php 
		                               for($i=0;$i<strlen($aventure->field_aventure_code['und'][0]['value']);$i++){
		                               		print '<input type="texte" id="code_'.$i.'">';
		                               }
	                               ?>
	                               <a class="btn_code"><?php print t('OK !')?></a>
	                               </div>
	                              <div class="clearfix"></div>
	                                 <a class="btn btn_prev nav_aventure" rel="0" href="javascript:;"><?php print t('Previous')?></a>
	                                
	                             </div>
	                             
	                             <div id="aventure_step_5" class="aventure_step">
                                	<div id="header_aventure_menu_4" class="nav_step">
                                		<a href="javascript:;" class="link_step1 nav_aventure" rel="1" title="<?php print t('Step 1')?>"></a>
	                                    <a href="javascript:;" class="link_step2 nav_aventure" rel="3" title="<?php print t('Step 2')?>"></a>
	                                    <a href="javascript:;" class="link_step3 nav_aventure" rel="4" title="<?php print t('Step 3')?>"></a>
                                	</div>
                                	<?php 
                                	$uri_viseul_4=$aventure->field_aventure_visuel_4['und'][0]['uri'];
                                	if(!empty($uri_viseul_4)){ ?>
                                	<img src="<?php print file_create_url($uri_viseul_4); ?>" />
                                	<?php } ?>
                                	
                                	
	                               
	                                  <div class="page-detail-wrapper">
									<?php 
									if($aventure->field_page_bloc['und'][0]['value']>0){
										foreach($aventure->field_page_bloc['und'] as $bloc_entity_id){
											$blocs[]=$bloc_entity_id['value'];
										}
										
										print mnhn_content_bloc_page($blocs);
									}
									?>
									</div>
	                                
	                              <div class="clearfix"></div>
	                                 <a class="btn btn_prev nav_aventure" rel="0" href="javascript:;"><?print t('Back'); ?></a>
	                                
	                             </div>
                                
                                
                            </div>
                            
                           
                            
                        </div>
                       <?php  print theme('aventure_abeilles');?> 
                       <?php  print theme('aventure_anniversaire');?> 
                       <?php  print theme('aventure_collections');?> 
                       
                        
                      

                        <div id="visuel2" class="boxe col1 moving" data-grid="">
                            <img src="/sites/all/themes/mnhn/pics/fonds/avent_visuel2.png" alt="" />
                        </div>

                        <div id="visuel" class="boxe col1 moving" data-grid="">
                            <img src="/sites/all/themes/mnhn/pics/fonds/avent_visuel1.png" alt="" />
                        </div>

                    
                    </div>
<img src="https://secure.adnxs.com/seg?add=8819632&t=2" width="1" height="1" />
<img src="https://secure.adnxs.com/px?id=863474&seg=8819643&t=2" width="1" height="1" />
               