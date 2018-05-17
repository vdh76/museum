<?php 
global $language;
global $user;


drupal_add_js(drupal_get_path('theme','mnhn').'/js/libs/craftmap.js');

$filepath_carte=file_create_url($node->field_collection_visuel['und'][0]['uri']);
$info_carte=mnhn_content_get_image_info($filepath_carte);
if(isset($_GET['objet'])){
	$js_objet='jQuery(".tabscollec li:eq(1)").trigger("click");';
}

if(empty($node->field_collection_visuel['und'][0]['uri'])){
	$filepath_carte='http://'.$_SERVER['SERVER_NAME'].'/sites/all/themes/mnhn/pics/fonds/carte_collection.png';
	$info_carte['largeur']=1800;
	$info_carte['hauteur']=628;
}

drupal_add_js('

	jQuery(function() {
	
	
	function load_small_carte(){
	jQuery("#craftmap").html("").html(jQuery("#carte_small").html());
	jQuery("#archeo").craftmap({
		container: {
			name: "imgContentSmall"
		},
		image: {
			width: '.$info_carte['largeur'].',
			height: '.$info_carte['hauteur'].',
			name: "imgMapSmall"
		},
        map: {
            position: "center" 
        },
        marker: {
            name: "markerSmall",
            popup: false
		
        },
        tip: {
			center: true, 
            popin: true,
            onClick: function(marker, popup){
            jQuery(".popin .tip_init").hide();
            jQuery(".popin .tip_hover").show();
					
            
            },
		onClose: function(marker, popup){
		}
        },
		controls: {
			name: "controlsSmall"
		},
		preloader: {
			name: "preloaderSmall"
		}
	});
	jQuery(".tipContent").show("");
	jQuery(".tipContent .tip_init").show("");
	jQuery(".tipContent .tip_hover").hide("");
	jQuery(".tip_init").mouseover(function(){
		jQuery(".tip").css("z-index","2");
		jQuery(this).parent().parent().css("z-index","3");			
		
	});	
	
					
	}
	load_small_carte();
	function load_big_carte(){
		jQuery(".archeozoom").html("").html(jQuery("#carte_big").html());
		jQuery("#archeozoom").craftmap({
			container: {
				name: "imgContent"
			},
			image: {
				width: '.$info_carte['largeur'].',
				height: '.$info_carte['hauteur'].',
				name: "imgMap"
			},
	        map: {
	            position: "center" 
	        },
	        marker: {
	            name: "marker",
	            popup: false
				
	        },
	        tip: {
	            popin: true,
	            onClick: function(marker, popup){
	            jQuery(".popin .tip_init").hide();
	            jQuery(".popin .tip_hover").show();
	            
	            },
			onClose: function(marker, popup){
			}
	        },
			controls: {
				name: "controls"
			},
			preloader: {
				name: "preloader"
			}
		});
		jQuery(".preloader").remove(); // IE7 fix
		jQuery(".tipContent").show("");
		jQuery(".tipContent .tip_init").show("");
		jQuery(".tipContent .tip_hover").hide("");
		jQuery(".tip_init").mouseover(function(){
			jQuery(".tip").css("z-index","2");
			jQuery(this).parent().parent().css("z-index","3");			
		
		});					
	}
	
	

    // bulle d\'aide
	jQuery(".help").live("click", function() {
        if ( jQuery(".text_help:visible").length != 0 ) {
            jQuery(".text_help").fadeOut("slow");
        } else {
            jQuery(".text_help").fadeIn("slow");
        }
	});

    // fermer bulle d\'aide
	jQuery(".close_help").live("click", function() {
        jQuery(".text_help").fadeOut("slow");
	});
	
	 // Lien fiche objet
	jQuery(".link_objet").live("click", function() {
		var nid=jQuery(this).attr("rel");
		var wrap=jQuery(this).parent();	
		if(!jQuery(".tabscollec li:eq(1)").hasClass("current")){				
			jQuery(".tabscollec li:eq(1)").trigger("click");
		}
		 wrap.addClass("loading");
		

		if(!exist(jQuery("#fiche_objet #fiche_objet_"+nid))){
	    					//wrap.addClass("loading");
	    					jQuery.ajax({
								  url: "/'.$language->language.'/objet/"+ nid,
								  type: "POST",
								  data: {},
								  dataType: "html",
								  success: function(data){
								  		
								  		jQuery("#fiche_objet .fiche_objet_body").prepend(data);
								  		//jQuery("html, body").animate({ scrollTop: pos_onglets.top }, 10);	  
									    jQuery(".list").animate({"marginLeft": "-560px"}, 0, "easeInExpo");
									    wrap.removeClass("loading");
						  				jQuery(".fiche_objet").hide(); 
										jQuery("#fiche_objet #fiche_objet_"+nid).show(); 
										jQuery(".entete").removeClass("loading");
										jQuery.scrollTo(".tabscollec",500);
								  }
						});
				}else{
					 //jQuery("html, body").animate({ scrollTop: pos_onglets.top }, 10);	  
					 jQuery(".list").animate({"marginLeft": "-560px"}, 0, "easeInExpo");
				     jQuery(".fiche_objet").hide();
					 jQuery("#fiche_objet #fiche_objet_"+nid).show(); 
					  wrap.removeClass("loading");
					  jQuery.scrollTo(".tabscollec",500);		
						
			}				
						
						
        jQuery.fancybox.close();
      
       
	});
	
	
    
    jQuery(".link_carte").live("click", function() {
    	jQuery.fancybox.open( jQuery("#wrap_craftmapzoom"),{wrapCSS :"carte_zoom", padding : 0, margin: 0, autoDimensions: false,  autoScale: false, width: 935, height: 628,beforeLoad:function(){load_big_carte();},beforeClose:function(){load_small_carte()}} );
	});
	    // fade des onglets
		jQuery(".tabscollec").tabs(".collecpanes > .pane", {
		    tabs: "li",
		    effect: "fade"
		});
		
	
	    // onglets : gestion de la pointe des onglets
	    var tabcurrent  = jQuery(".tabscollec li.current"),
	        tabcurrentW = tabcurrent.width();
	    jQuery(".tabscollec li .pointe").remove();
	    tabcurrent.append(\'<img src="/sites/all/themes/mnhn/pics/puces/pointe_collec.png" alt="" class="pointe" />\').find(".pointe").css("left", ((tabcurrentW /2) - 6) + "px");
	
	    jQuery(".tabscollec li").click(function() {
			if(jQuery(".fiche_objet").is(":visible")){
				//jQuery(".fiche_objet .retour").trigger("click");	
			}			
	        var index = jQuery(".tabscollec li").index(this);
	        tabcurrentW = jQuery(this).width();
	        jQuery(".tabscollec li .pointe").remove();
	        jQuery(this).append(\'<img src="/sites/all/themes/mnhn/pics/puces/pointe_collec.png" alt="" class="pointe" />\').find(".pointe").css("left", ((tabcurrentW /2) - 6) + "px");
	    });
	    
	    // apparition de la fiche objet
	    jQuery(".list_item .link_collec,.list_item .link_collec_img,.list_item .link_collec_title").live("click", function() {
				if(jQuery(this).hasClass("link_collec_title")){
					var wrap=jQuery(this).parent().parent().parent();
				}else{
	    			var wrap=jQuery(this).parent();
				}	
					
	    		var nid=wrap.attr("rel");	
	    		var pos_onglets=jQuery(".tabscollec").offset();

	    		if(!exist(jQuery("#fiche_objet #fiche_objet_"+nid))){
	    					wrap.addClass("loading");
	    					jQuery.ajax({
								  url: "/'.$language->language.'/objet/"+ nid,
								  type: "POST",
								  data: {},
								  dataType: "html",
								  success: function(data){
								  		
								  		jQuery("#fiche_objet .fiche_objet_body").prepend(data);
								  		jQuery("html, body").animate({ scrollTop: pos_onglets.top }, 10);	  
									    jQuery(".list").animate({"marginLeft": "-560px"}, 800, "easeInExpo");
									    wrap.removeClass("loading");
						  				jQuery(".fiche_objet").hide(); 
										jQuery("#fiche_objet #fiche_objet_"+nid).show(); 
								  }
						});
				}else{
					 jQuery("html, body").animate({ scrollTop: pos_onglets.top }, 10);	  
					 jQuery(".list").animate({"marginLeft": "-560px"}, 800, "easeInExpo");
				     jQuery(".fiche_objet").hide();
					 jQuery("#fiche_objet #fiche_objet_"+nid).show(); 
						
				}
						
					
	    
	         
	        return false;
	    });
	    
	    // Fermeture de la fiche objet
	    jQuery(".retour").live("click", function() {
		    var nid=jQuery(this).attr("rel");
		    jQuery(".list").animate({"marginLeft": "0px"}, 800, "easeInExpo",function(){
				jQuery(".fiche_objet").hide(); 		
		    });
		    
	        return false;
	        
	    });
	    
	    
	    // navigation fiche objet
	    jQuery(".prev,.next,.link_objet_hide").live("click", function() {
	    		var new_nid=jQuery(this).attr("rel");
	    		if(!exist(jQuery("#fiche_objet_"+new_nid))){
	    			jQuery(".entete").addClass("loading");
	    					jQuery.ajax({
								  url: "/'.$language->language.'/objet/"+ new_nid,
								  type: "POST",
								  data: {},
								  dataType: "html",
								  success: function(data){
								
	    								jQuery("#fiche_objet .fiche_objet_body").prepend(data);	  
									    jQuery(".entete").removeClass("loading");
										jQuery(".fiche_objet").hide(); 
										jQuery("#fiche_objet #fiche_objet_"+new_nid).show();   
								  }
						});
				}else{
					 jQuery(".fiche_objet").hide();
					 jQuery("#fiche_objet #fiche_objet_"+new_nid).show(); 	 
				}
	    
	       
	        return false;
	    });
		
	    '.$js_objet.'
    
	});','inline');
$objets=mnhn_collection_objets($node->nid);
?>
<div class="collection-header">
      <h1 class="title_m"><?php print $node->title; ?></h1>
</div>
<div class="page-detail-wrapper">

	 <div class="craftmap" id="craftmap"></div>
     <div class="carte_hide" id="carte_small"><?php print mnhn_collection_load_carte('archeo',$node,1)?></div>                          

	<ul class="tabscollec">
	    <li><a href="#"><?php print t('About this collection')?></a></li>
	    <li><a href="#"><?php print t('Explore the objects')?></a></li>
	</ul>
	
	 <div class="collecpanes">
	         <div class="pane">
	            <?php 
				if($node->field_page_bloc['und'][0]['value']>0){
					foreach($node->field_page_bloc['und'] as $bloc_entity_id){
						$blocs[]=$bloc_entity_id['value'];
					}
					
					$output.=mnhn_content_bloc_page($blocs);
				}
				//$output.=mnhn_content_list_keywords($node->field_keyword['und']); 
				print $output;
				?>
	        </div>                  
	        <div class="pane">
	        	 <div class="wrap_list">
                      <div class="list">
	        	      		<?php print $objets; ?>
	        	      </div>
	        	      <div id="fiche_objet">
                          <a href="#" class="backlist"></a>
                          <div class="fiche_objet_body">
                       </div>
                     </div>
	        	  </div>      
	        </div>
      </div>                      

</div>
<div class="element-hidden" id="shadowbox">
       
          <div id="wrap_craftmapzoom" style="width:935px;height:628px">
           		<div class="archeozoom"></div>
           		<div class="carte_hide" id="carte_big"><?php print mnhn_collection_load_carte('archeozoom',$node,0)?></div> 
        </div>
        	
        	
       
</div>                    		
				
