
jQuery(document).ready(function(){
	
	jQuery('#gallery_expo .diapos').find('.diapo:first').css('opacity', '1');
	jQuery('#gallery_expo .diapos .diapo:eq(0)').css("z-index","99");

    jQuery('#gallery_expo .diapos .diapo:eq(0)').addClass('current');
    jQuery('#gallery_expo .visiotabs a:eq(0)').addClass('active');
    
    jQuery('#gallery_expo .visiotabs li').click(function() {
    	//alert("test");
    	jQuery('#gallery_expo .diapos .diapo').css("z-index","2");
        var index = jQuery('#gallery_expo .visiotabs li').index(this);
        jQuery('.diapo.current').removeClass('current').animate({'opacity': '0'}, 800, 'easeInExpo');
        jQuery('#gallery_expo .visiotabs li').find('a').removeClass('active');
        jQuery(this).find('a').addClass('active');
        jQuery('#gallery_expo .diapos .diapo:eq(' + index + ')').css("z-index","99");
        jQuery('.diapo:eq(' + index + ')').addClass('current').animate({'opacity': '1'}, 800, 'easeInExpo');
        
        
        return false;
    });
    
    // clic sur un bloc
    jQuery("#home_museum").click(function(){
         window.location=jQuery(this).find("a").attr("href"); 
         return false;
    });
    jQuery("#home_blog").click(function(){
         window.location=jQuery(this).find("a").attr("href"); 
         return false;
    });
    
    jQuery("#musee_pratik").click(function(){
        window.location=jQuery(this).find("a").attr("href"); 
        return false;
   });
    /*
    jQuery("#bloc_newsletter").css("cursor","pointer").click(function(){
        window.location=jQuery(this).find("a").attr("href"); 
        return false;
   });
   */
    
    jQuery("#bloc_newsletter").hover(function(){
    		jQuery(this).find(".inscription").show();
    		jQuery(this).find(".abonnement").hide();
    	 },function(){
    		 jQuery(this).find(".abonnement").show();
    		 jQuery(this).find(".inscription").hide();
    	 });
    
    
    
    // deplacement dans l'agenda
    jQuery("#home_agenda").find('.event:first').css('opacity', '1').show();
    jQuery('#home_agenda .event:eq(0)').addClass('current');
    jQuery('#home_agenda .forward').click(function() {
        var slideSelected = jQuery('.event.current');
        slideSelected.siblings('.event').css('opacity', '0');
        var index = slideSelected.index();
        var nbSlides = jQuery('#home_agenda .event').length;
        
        if ( (index + 1) != nbSlides ) {
            slideSelected.stop(true, true).removeClass('current').animate({'opacity': '0'}, 1500, function() {
                jQuery(this).hide();
            });
            slideSelected.next('.event').stop(true, true).addClass('current').show().animate({'opacity': '1'}, 1500);
            
        } else {
            slideSelected.stop(true, true).removeClass('current').animate({'opacity': '0'}, 1500, function() {
                jQuery(this).hide();
            });
            jQuery('.event:eq(0)').stop(true, true).addClass('current').show().animate({'opacity': '1'}, 1500);
        }
        return false;
    });

    jQuery('#home_agenda .backward').click(function() {
        var slideSelected = jQuery('.event.current');
        slideSelected.siblings('.event').css('opacity','0');
        var index = slideSelected.index();
        var nbSlides = jQuery('#home_agenda .event').length;
        
        if ( index != 0 ) {
            slideSelected.stop(true, true).removeClass('current').animate({'opacity': '0'}, 1500, function() {
                jQuery(this).hide();
            });
            slideSelected.prev('.event').stop(true, true).addClass('current').show().animate({'opacity': '1'}, 1500);
        } else {
            slideSelected.stop(true, true).removeClass('current').animate({'opacity': '0'}, 1500, function() {
                jQuery(this).hide();
            });
            jQuery('#home_agenda .event:last').stop(true, true).addClass('current').show().animate({'opacity': '1'}, 1500);

        }
        return false;
    });


    // deplacement dans les collections
    jQuery("#home_collections .collects").find('.item_collect:first').css('opacity', '1').show();
    jQuery('#home_collections .item_collect:eq(0)').addClass('current');
    jQuery('#home_collections .forward').click(function() {
        var slideSelected = jQuery('#home_collections .collects .current');
        slideSelected.siblings('.item_collect').css('opacity', '0');
        var index = slideSelected.index();
        var nbSlides = jQuery('#home_collections .collects .item_collect').length;
        
        if ( (index + 1) != nbSlides ) {
            slideSelected.stop(true, true).removeClass('current').animate({'opacity': '0'}, 1500, function() {
                jQuery(this).hide();
            });
            slideSelected.next('.item_collect').stop(true, true).addClass('current').show().animate({'opacity': '1'}, 1500);
            
        } else {
            slideSelected.stop(true, true).removeClass('current').animate({'opacity': '0'}, 1500, function() {
                jQuery(this).hide();
            });
            jQuery('#home_collections .collects .item_collect:first').stop(true, true).addClass('current').show().animate({'opacity': '1'}, 1500);
        }
        return false;
    });

    jQuery('#home_collections .backward').click(function() {
        var slideSelected = jQuery('#home_collections .collects .current');
        slideSelected.siblings('.item_collect').css('opacity', '0');
        var index = slideSelected.index();
        var nbSlides = jQuery('#home_collections .collects .item_collect').length;
        
        if ( index != 0 ) {
            slideSelected.stop(true, true).removeClass('current').animate({'opacity': '0'}, 1500, function() {
                jQuery(this).hide();
            });
            slideSelected.prev('.item_collect').stop(true, true).addClass('current').show().animate({'opacity': '1'}, 1500);
        } else {
            slideSelected.stop(true, true).removeClass('current').animate({'opacity': '0'}, 1500, function() {
                jQuery(this).hide();
            });
            jQuery('#home_collections .collects .item_collect:last').stop(true, true).addClass('current').show().animate({'opacity': '1'}, 1500);

        }
        return false;
    });
    
    
    
 // deplacement dans le carnet Lesieur
    jQuery("#home_carnets .carnets").find('.item_carnet:first').css('opacity', '1').show();
    jQuery('#home_carnets .item_carnet:eq(0)').addClass('current');
    jQuery('#home_carnets .forward').click(function() {
        var slideSelected = jQuery('#home_carnets .carnets .current');
        slideSelected.siblings('.item_carnet').css('opacity', '0');
        var index = slideSelected.index();
        var nbSlides = jQuery('#home_carnets .carnets .item_carnet').length;
        
        if ( (index + 1) != nbSlides ) {
            slideSelected.stop(true, true).removeClass('current').animate({'opacity': '0'}, 1500, function() {
                jQuery(this).hide();
            });
            slideSelected.next('.item_carnet').stop(true, true).addClass('current').show().animate({'opacity': '1'}, 1500);
            
        } else {
            slideSelected.stop(true, true).removeClass('current').animate({'opacity': '0'}, 1500, function() {
                jQuery(this).hide();
            });
            jQuery('#home_carnets .carnets .item_carnet:first').stop(true, true).addClass('current').show().animate({'opacity': '1'}, 1500);
        }
        return false;
    });

    jQuery('#home_carnets .backward').click(function() {
        var slideSelected = jQuery('#home_carnets .carnets .current');
        slideSelected.siblings('.item_carnet').css('opacity', '0');
        var index = slideSelected.index();
        var nbSlides = jQuery('#home_carnets .carnets .item_carnet').length;
        
        if ( index != 0 ) {
            slideSelected.stop(true, true).removeClass('current').animate({'opacity': '0'}, 1500, function() {
                jQuery(this).hide();
            });
            slideSelected.prev('.item_carnet').stop(true, true).addClass('current').show().animate({'opacity': '1'}, 1500);
        } else {
            slideSelected.stop(true, true).removeClass('current').animate({'opacity': '0'}, 1500, function() {
                jQuery(this).hide();
            });
            jQuery('#home_carnets .carnets .item_carnet:last').stop(true, true).addClass('current').show().animate({'opacity': '1'}, 1500);

        }
        return false;
    });
    
});



