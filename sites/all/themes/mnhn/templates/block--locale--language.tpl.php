  <div class="header_lang"<?php print $content_attributes; ?>>
  <?php 
  global $user;
  global $language;
  	
    print $content; 
    
    $ouverture_en=variable_get('mnhn_en', '');
    $ouverture_de=variable_get('mnhn_en', '');
    
    $nid_deploiement=variable_get('mnhn_deploiement_'.$language->language, '');
    $nid_deploiement=mnhn_content_autocomplete_nid($nid_deploiement);
    $link_deploiement = '/'.$language->language.'/'.drupal_get_path_alias('node/'.$nid_deploiement);
    
    if($ouverture_en==0 && !user_access('mnhn')){
    	
    	
	    drupal_add_js('
			
				jQuery(function() {
			
					jQuery(".language-switcher-locale-url .en").click(function(){
						window.location.href="'.$link_deploiement.'";
						return false;
					});
				})','inline');
	    
	    }
	    
	    if($ouverture_de==0 && !user_access('mnhn')){
	    	
	    	 
	    	drupal_add_js('
		
				jQuery(function() {
		
					jQuery(".language-switcher-locale-url .de").click(function(){
						window.location.href="'.$link_deploiement.'";
						return false;
					});
				})','inline');
	    	 
	    }
	    
  
    
    ?>
  </div>

