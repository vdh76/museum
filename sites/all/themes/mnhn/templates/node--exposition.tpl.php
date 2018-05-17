<?php 




global $language;
// Activation menu
//header-wrapper
drupal_add_js('

	jQuery(function() {
	    jQuery("#header-wrapper ul.menu li:eq(3) a").addClass("activ");
	    
	jQuery(".onglets li").click(function() {
        var index = jQuery(".onglets li").index(this);
        tabcurrentW = jQuery(this).width();
       jQuery(".onglets li .pointe").remove();
        jQuery(this).append(\'<img src="/sites/all/themes/mnhn/pics/puces/pointe.png" alt="" class="pointe" />\').find(".pointe").css("left", ((tabcurrentW /2) - 6) + "px");
    });
    
	jQuery(".onglets").tabs(".panes > .pane", {
	    tabs: "li",
	    effect: "fade",
        rotate: true
	});

    var tabcurrent  = jQuery(".onglets li.current"),
        tabcurrentW = tabcurrent.width();
        
    tabcurrent.append(\'<img src="/sites/all/themes/mnhn/pics/puces/pointe.png" alt="" class="pointe" />\').find(".pointe").css("left", ((tabcurrentW /2) - 6) + "px");
	 
    if(exist(".calendar-events")){ 
	 	jQuery(".calendar-event").live("click",setEventLink); 
		
		jQuery(".calendar-event").each(function(){
			if(jQuery(this).find(".between").length > 0){
				var nWidth=390;
			}else{
				var nWidth=455;
			}	
			jQuery(this).find(".fc-event-over-content").width(nWidth);
		});
		
	 }
    
	});','inline');


if($node->field_bloc_link['und'][0]['value']>0){
	foreach($node->field_bloc_link['und'] as $bloc_links){
		$tab_links[]=$bloc_links['value'];
	}
}
if(sizeof($tab_links)>0){
	$field_link = entity_load('field_collection_item', $tab_links);
	$links=mnhn_content_list_links($field_link,0);
}

$type=$node->field_exposition_type['und'][0]['value'];

if($type=='expo'){
	$title_expo=t('Exhibition');
	$type_expo='expo';
}else{
	$title_expo=t('Event');
	$type_expo='événement';
}

$test_expo_permanente=mnhn_exposition_permanente($nid);
$date_debut=$node->field_exposition_date['und'][0]['value'];
$date_fin=$node->field_exposition_date['und'][0]['value2'];
$subtitle=mnhn_content_format_date_medium($date_debut,$date_fin);
$subtitle=str_replace("au","<br/>au",$subtitle);
($test_expo_permanente==1)?$subtitle='':'';


$uri=$node->field_exposition_visuel['und'][0]['uri'];   
		if(!empty($uri)){
			//$image=theme('image_style', array('style_name' => $theme_image, 'path' => $uri));
			$image='<img src="'.file_create_url($uri).'" width="536" height="278">';
		}else{
			$image='<img src="/'.drupal_get_path('theme','mnhn').'/img/img.jpg" width="536" height="278">';
		}


	$nb_oeuvre=0;
	$position=1;
	
		foreach($node->field_oeuvre_visuel['und'] as $oeuvre_entity_id){
			$oeuvres[]=$oeuvre_entity_id['value'];
		}
	
	    $field_collection_item = entity_load('field_collection_item', $oeuvres);
	
	        //Now you have a variable with the entity object loaded in it, and you can do stuff.
	    foreach ($field_collection_item as $oeuvre ) {
	    	
	    	//print_r($oeuvre);
	    	//exit;
	    	$nb_oeuvre++;
	    	$titre=$oeuvre->field_oeuvre_visuel_titre['und'][0]['value'];
	    	$description=$oeuvre->field_oeuvre_visuel_legende['und'][0]['value'];
	    	$date=$oeuvre->field_oeuvre_visuel_date['und'][0]['value'];
	    	$copyright=$oeuvre->field_oeuvre_visuel_copyright['und'][0]['value'];
	    	
	    	$uri=$oeuvre->field_oeuvre_visuel_visuel['und'][0]['uri'];
	    	
	    	if($nb_oeuvre==1){
    			$legende_titre=$titre;
    			$legende_description=$description;
    			$legende_id='visuel_'.$oeuvre->item_id;
    			$legende_copyright=$copyright;
    			
    		}
	    	
	    	
	    	
	    	
    		
			if(!empty($uri)){
				$visuel_expo=file_create_url($uri);
				$info_visuel_expo=mnhn_content_get_image_info($visuel_expo);
				if($info_visuel_expo['largeur']>2000 || $info_visuel_expo['hauteur']>1000){
								if($info_visuel_expo['largeur']>$info_visuel_expo['hauteur']){
									$imagecache='exposition';
								}else{
									$imagecache='exposition_portrait';
								}
					$visuel_imagecache=theme('image_style', array('style_name' => $imagecache, 'path' => $uri));
					preg_match_all('/(alt|title|src)=("[^"]*")/i',$visuel_imagecache, $result_url);
					$url_detail=str_replace('"','',$result_url[2][0]);
				}else{
					$url_detail=$visuel_expo;
				}
				$info_visuel_def=mnhn_content_get_image_info($url_detail);
				$liste_image=theme('image_style', array('style_name' => 'vignette_oeuvre', 'path' => $uri));
				//$type_image=mnhn_content_get_image_type(file_create_url($uri),430/300);
				$slideshow_content.='<div id="info_'.$oeuvre->item_id.'" class="slideshow_legende_info"><span class="description">'.$description.'</span><span class="titre">'.$titre.'</span><span class="oeuvre_id">visuel_'.$oeuvre->item_id.'</span><span class="copyright">'.$copyright.'</span><span class="url">'.$url_detail.'</span></div><a class="zoom_link" href="javascript:;"  rel="visuel_'.$oeuvre->item_id.'">'.theme('image_style', array('style_name' => 'slideshow', 'path' => $uri))."</a>\n";
				$zoom_infos.='<div id="visuel_'.$oeuvre->item_id.'" class="zoom_info"><span class="hauteur">'.$info_visuel_def['hauteur'].'</span><span class="largeur">'.$info_visuel_def['largeur'].'</span><span class="titre">'.$titre.'</span><span class="description">'.$description.'</span><span class="copyright">'.$copyright.'</span><span class="url">'.$url_detail.'</span></div>'."\n";
				//print  '<br/>'.$titre;
				$liste_visuels.=theme('exposition_visuel_liste', array('titre' => $titre,'sstitre' => $auteur,'image' => $liste_image,'lien' => 'javascript:;', 'position' => $position, 'oeuvre_id' => $oeuvre->item_id));
	 			($position==3)? $position=1:$position++;;
				
			}
			
	
	    	
	   		
	    }
  


  if($nb_oeuvre>0){
  
	drupal_add_js('
	jQuery(function() {
		
	    jQuery("#slideshow_'.$node->nid.'").cycle({
	        fx:     "fade",
	        speed:  "slow",
	        timeout: 0,
	        prev: "#slideshow_prev_'.$node->nid.'",
			next: "#slideshow_next_'.$node->nid.'", 
	        pager:  "#slideshow_nav_'.$node->nid.'",
			slideExpr: "img",
			after : onAfter_'.$node->nid.',
			before : onBefore_'.$node->nid.'
	    });
	   jQuery("#slideshow_nav_'.$node->nid.'").show();
	   
	   function onBefore_'.$node->nid.'(curr,next,opts) {
			jQuery(".slideshow_legende .titre_legende,.slideshow_legende .description_legende,#cartouche_'.$node->nid.'").html("&nbsp;");
			jQuery(".slideshow_legende a").hide();
		}
	   
	   function onAfter_'.$node->nid.'(curr,next,opts) {
	   
			jQuery("#slideshow_'.$node->nid.' .slideshow_legende .titre_legende").html(jQuery("#slideshow_'.$node->nid.' .slideshow_legende_info:eq("+opts.currSlide+") span.titre").html());
			jQuery("#slideshow_'.$node->nid.' .slideshow_legende .description_legende").html(jQuery("#slideshow_'.$node->nid.' .slideshow_legende_info:eq("+opts.currSlide+") span.description").html());
	   		jQuery("#slideshow_'.$node->nid.' .slideshow_legende a").attr("rel",jQuery("#slideshow_'.$node->nid.' .slideshow_legende_info:eq("+opts.currSlide+") span.oeuvre_id").html());
			jQuery("#cartouche_'.$node->nid.'").html(jQuery("#slideshow_'.$node->nid.' .slideshow_legende_info:eq("+opts.currSlide+") span.copyright").html());
			
			jQuery("#slideshow_'.$node->nid.' .slideshow_legende *,#cartouche_'.$node->nid.'").fadeIn("fast");
		}
		
		
		jQuery("#slideshow_'.$node->nid.' .zoom_link,#zoom_wrapper_'.$node->nid.' .zoom_link, .list_img .zoom_link").click(function(){
			jQuery.fancybox.showLoading();
			jQuery(".zoom_next,.zoom_prev").hide();
			var id=jQuery(this).attr("rel");
			var image=jQuery("#"+id+" .url").html();
				
			var largeur_fenetre=parseInt(jQuery(window).width());
			var hauteur_fenetre=parseInt(jQuery(window).height());	
											
			var largeur_init=parseInt(jQuery("#"+id+" .largeur").html());	
			var hauteur_init=parseInt(jQuery("#"+id+" .hauteur").html());			
			
			var largeur_def=largeur_init;
			var hauteur_def=hauteur_init;		
									

			if(largeur_init>hauteur_init){			
					if(largeur_fenetre<(largeur_init+100)){
						largeur_def=largeur_fenetre-100;
						hauteur_def=Math.floor((hauteur_init/largeur_init)*largeur_def);		
			    	}

					if(hauteur_fenetre<(hauteur_init+300)){
						hauteur_def=hauteur_fenetre-300;
						largeur_def=Math.floor((largeur_init/hauteur_init)*hauteur_def);	
					}	
			}else{
					if(hauteur_fenetre<(hauteur_init+300)){
						hauteur_def=hauteur_fenetre-300;
						largeur_def=Math.floor((largeur_init/hauteur_init)*hauteur_def);	
					}				
			}				
			
			jQuery.loadImages(image,function() {
				jQuery.fancybox.hideLoading();
				jQuery("#zoom_wrapper_'.$node->nid.' .zoom_img").html("").append(\'<img src="\'+image+\'" width="\'+largeur_def+\'" height="\'+hauteur_def+\'" />\');
		    	jQuery("#zoom_wrapper_'.$node->nid.' .zoom_titre").html(jQuery("#"+id+" .titre").html());
		    	jQuery("#zoom_wrapper_'.$node->nid.' .zoom_description").html(jQuery("#"+id+" .description").html());
		    	jQuery("#zoom_wrapper_'.$node->nid.' .zoom_copyright").html(jQuery("#"+id+" .copyright").html());
		    	jQuery.fancybox.open( jQuery("#zoom_wrapper_'.$node->nid.'"),{
			    	padding : 20, 
			    	width : "auto", 
			    	height : "auto", 
			    	autoSize : true,
		    		beforeLoad  : function(){
						jQuery(".fancybox-wrap,.fancybox-inner,.zoom_wrapper").css({"overflow-x":"hidden"});
		    			if(largeur_def<400){
							largeur_def=400;
						}	
		    			jQuery("#zoom_wrapper_'.$node->nid.' .zoom_copyright, #zoom_wrapper_'.$node->nid.' .zoom_description, #zoom_wrapper_'.$node->nid.' .zoom_titre").width(largeur_def-20);		
						var nb_item=jQuery(".zoom_info").length;
					
						if(nb_item>1){
							var pos=jQuery(".zoom_info").index( jQuery("#"+id)[0] );
							if(pos<(nb_item-1)){
							
								var next=jQuery(".zoom_info:eq("+(pos+1)+")").attr("id");
								jQuery(".zoom_next").show().attr("rel",next);
							}
							if(pos>0){
								var prev=jQuery(".zoom_info:eq("+(pos-1)+")").attr("id");
								jQuery(".zoom_prev").show().attr("rel",prev);
							}
						}
					} 
  				}); 
	    	});
	    	
		});
		
		
	    
	   
	    
	   
	   
	});
	',
	'inline');
  	
  }
  	
	 if($nb_oeuvre==1){
	 	drupal_add_js('
	jQuery(function() {
	 	
	    jQuery("#slideshow_prev_'.$node->nid.'").hide();
	    jQuery("#slideshow_next_'.$node->nid.'").hide();  
	 	
	});
	',
	 		'inline');
  	}
  
  	
  	foreach($node->field_exposition_event['und'] as $event){
  		if($event['nid']>0){
  			$event=node_load($event['nid']);
  			if($event->status==1){
  				$events.=theme('evenement', array('node' => $event,'template'=>'html'));
  				$nb_events++;
  			}
  		}
  	}


?>
<div class="page-header">
     <h3>&nbsp;</h3>
</div>
<div class="page-detail-wrapper">


<ul class="onglets">
	<li class="current"><a href="#"><?php print $title_expo;?></a>
       <img src="/sites/all/themes/mnhn/pics/puces/pointe.png" alt="" class="pointe" /></li>
	<?php if($nb_oeuvre>0){ ?>
		<li><a href="#"><?php print t('Gallery'); ?></a></li>
	<?php } ?>
	<?php if($nb_event>0 || $nb_events>0 || $node->field_exposition_autour['und'][0]['value']!='' || $links!='' || mnhn_content_list_files($node->field_exposition_file['und'])!=''){ ?>
	<li><a href="#"><?php print t('Events'); ?></a></li>
	<?php } ?>
</ul>
<div class="panes">
	<div id="lexpo" class="pane active">
		<h1><strong><?php print $node->title?></strong><br/><?php print $node->field_exposition_sous_titre['und'][0]['value']?></h1>
			<?php print $image; ?>
			<?php if($node->field_exposition_chapo['und'][0]['value']!=''){ ?>
			<blockquote> <?php print nl2br($node->field_exposition_chapo['und'][0]['value']) ?> </blockquote>
			<?php } ?>
			<!--  
		 <div class="fiche">
			<?php print nl2br($node->field_exposition_detail['und'][0]['value']) ?>
			<hr>
			</div>
			-->
			<?php 
			if($node->field_page_bloc['und'][0]['value']>0){
	foreach($node->field_page_bloc['und'] as $bloc_entity_id){
		$blocs[]=$bloc_entity_id['value'];
	}
	
	print mnhn_content_bloc_page($blocs);
}	?>
				<br />
				<br />
				<?php print mnhn_content_list_keywords($node->field_keyword['und']); ?>
				
		
	</div>
<?php if($nb_oeuvre>0){ ?>
<div id="enimage" class="pane">

	<div class="slideshow" id="slideshow_<?php print $node->nid?>">
		<span class="slideshow_prev" id="slideshow_prev_<?php print $node->nid?>"></span>
		<span class="slideshow_next" id="slideshow_next_<?php print $node->nid?>"></span>
											
    	<?php print $slideshow_content; ?>
	    <div class="slideshow_legende">
	    	<h3 class="titre_legende"><?php print $legende_titre?></h3>
	    	<p class="description_legende"><?php print $legende_description?></p>
	    	<a href="javascript:;" class="zoom_link link_gallery" rel="<?php print $legende_id; ?>"><?php print t('Zoom !image',array('!image'=>'')); ?></a>
	    </div>     
	</div>
	<p class="cartouche" id="cartouche_<?php print $node->nid?>"><?php print $legende_copyright; ?></p>
	<div class="slideshow_nav" id="slideshow_nav_<?php print $node->nid?>"></div>
	 <div class="list_img">
		<?php print $liste_visuels; ?>
	</div>


<div class="zoom_wrapper" id="zoom_wrapper_<?php print $node->nid?>">
	<a class="zoom_link zoom_prev"></a>
	<a class="zoom_link zoom_next"></a>
	<div class="zoom_header">
		<div class="zoom_titre"></div>
	</div>
	<div class="zoom_img"></div>
	<div class="zoom_bottom">
		<div class="zoom_copyright"></div>
		<div class="zoom_description"></div>   
	</div>
</div>
<?php print $zoom_infos; ?>
	
	
</div>
<?php } ?>


<div id="autour" class="pane">
		<?php if($nb_event>0): ?>
          <?php
            $filter_event = array('ref_expo' => $nid, 'expo' => 0, 'type[524]' => '524', 'type[525]' => '525', 'type[520]' => '520', 'type[521]' => '521', 'type[522]' => '522');
          ?>
          <?php print l('Découvrez les événements organisés autour de l\'exposition', 'agenda', array('query' => $filter_event,'attributes' => array( 'class' => 'join-link-internal join-content' ))) ?>
          <br/>
          <?php print l('Découvrez les ateliers organisés autour de l\'exposition', 'agenda', array('query' => array('ref_expo' => $nid, 'expo' => 0, 'type[523]' => '523'),'attributes' => array( 'class' => 'join-link-internal join-content' ))) ?>
          <br/><br/>
    <?php endif ?>

		<?php if($nb_events>0){ ?>
			  
             <h2><?php print t('View events calendar')?> :</h2>
           
            <div class="calendar-events">
				<div  class="calendar-events-list select_month">
						<?php print $events ?>
				</div>
				<div id="calendar-events-details" id="event-1">
					<a href="javascript:;" onclick="backCalendarEventsList();" class="back"></a>
					<div class="calendar-events-details-body"></div>
				</div>	
			</div>	
		<?php } ?>
			<?php if($node->field_exposition_autour['und'][0]['value']!=''){ ?>
				<div class="bloc_page_wrapper">
					<div class="accordion">
						<div class="item" style="display:block">
							<div class="text">
								<?php print $node->field_exposition_autour['und'][0]['value']; ?>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>	
			<?php print $links; ?>
			<?php print mnhn_content_list_files($node->field_exposition_file['und']); ?>
			
		
</div>
</div>
</div>