jQuery.noConflict();

function goLocation(theObject) {
	window.location=jQuery(theObject).find("a.bglnk").attr("href");
	return false;
}

function limitText(limitField, limitNum) {
    if (jQuery(limitField).val().length > limitNum) {
    	jQuery(limitField).val(jQuery(limitField).val().substring(0, limitNum));
    } 
}

function exist(page) {
	return jQuery(page).length > 0;
}

function setEventLink() {
	
	//jQuery("#wrap_visite_detail").hide();
	jQuery(".calendar-events:visible").animate({marginLeft: "-590px"}, 500);
	jQuery("#wrap_visite_detail").animate({marginLeft: "-590px"}, 500);
	jQuery("#wrap_expo_detail").animate({marginLeft: "-590px"}, 500);
	var text = jQuery(this).find(".fc-event-over-content-body").html();
	text+='<script>var script=\'http://s7.addthis.com/js/250/addthis_widget.js#domready=1&pubid=ra-4ffeedf5278728c4\';if(window.addthis){window.addthis=null;window._adr = null;window._atc = null;window._atd = null;window._ate = null;window._atr = null;window._atw = null;}jQuery.getScript(script,function(){addthis.init();});</script>'; 
	jQuery("#calendar-events-details .calendar-events-details-body").html(text);
	var height_calendar=jQuery("#calendar").height()+200;
	jQuery("html,body").animate({scrollTop: height_calendar}, 50);
	return false;
}

function setEventLinkDetail(nid) {
	//jQuery("#wrap_visite_detail").hide();
	jQuery(".calendar-events:visible").css({"marginLeft": "-590px"});
	var text = jQuery("#event-"+nid).parent().find(".fc-event-over-content-body").html();
	jQuery("#calendar-events-details .calendar-events-details-body").html(text);
	return false;
}

function backCalendarEventsList() {
	jQuery("#calendar-events-details .calendar-events-details-body").html("");
	jQuery(".calendar-events").animate({marginLeft: "0"}, 500);
	jQuery("#wrap_visite_detail").animate({marginLeft: "0"}, 500);
	jQuery("#wrap_expo_detail").animate({marginLeft: "0"}, 500);
	return false;
}

jQuery(document).ready(function(){
	jQuery("#bigmenu_numeritheque .item_menu:eq(3)").addClass("clearfix");
	jQuery(".language-switcher-locale-url li").each(function(){
			if(exist(jQuery(this).find("span"))){
				if(jQuery(this).find("span").html()=="FR"){
					jQuery(this).html('<a href="/fr">FR</a>');
				}else if(jQuery(this).find("span").html()=="EN"){	
					jQuery(this).html('<a href="/en">EN</a>');
				}else if(jQuery(this).find("span").html()=="DE"){	
					jQuery(this).html('<a href="/de">DE</a>');
				}	
			}	
	});

	
	jQuery('.accordion .selected,.accordion .visible').next('.item').show();
    jQuery('.accordion .selected').next('.encart').show();
    jQuery('.accordion2 .encart:not(:visible)').prev('.title_accordion').find('span.small').hide(); 
    
    
    jQuery('.accordion .title_accordion').live('click', function() {
    	if( !jQuery(this).hasClass("visible")){
    		
	        if ( jQuery(this).next('.item:visible').length != 0 ) {
	            jQuery(this).removeClass('selected').addClass('plie').next('.item').slideUp(600);
	        } else {
	            jQuery(this).addClass('selected').removeClass('plie').next('.item').slideDown(600);
	        }
    	}
    });
    
    jQuery('.accordion2 .title_accordion').live('click', function() {
        if ( jQuery(this).next('.encart:visible').length != 0 ) {
            jQuery(this).find('span').hide();
            jQuery(this).removeClass('selected').addClass('plie').next('.encart').slideUp(600);
        } else {
            jQuery(this).find('span').show();
            jQuery(this).addClass('selected').removeClass('plie').next('.encart').slideDown(600);
        }
    });
	
	
	
	jQuery(".menu-vertical > li.expanded").find('ul').show();

    jQuery(".menu-vertical > li.submenu > a").live('click', function() {
        jQuery(this).parent().siblings('submenu').removeClass('expanded');
        if ( jQuery(this).parent().find('ul:visible').length != 0 ) {
            jQuery(this).parent().removeClass('expanded').find('ul').slideUp(600);
        } else {
            jQuery(this).parent().addClass('expanded').find('ul').slideDown(600);
        }
        return false;
    });
    jQuery(".menu-vertical > li.expanded > a").live('click', function() {
        jQuery(this).parent().removeClass('expanded').find('ul').slideUp(600);
        return false;
    });

    
    var tabmenucurrent  = jQuery('.mainmenu li.active'),
        tabmenucurrentW = tabmenucurrent.width(),
        indextab        = jQuery('.mainmenu li.active').index();

    switch (indextab) {
        case 1: tabmenucurrent.append('<img src="/sites/all/themes/mnhn/pics/puces/menu_pointe_verte.png" alt="" class="pointe" />').find('.pointe').css('left', ((tabmenucurrentW /2) - 6) + 'px'); break;
        case 2: tabmenucurrent.append('<img src="/sites/all/themes/mnhn/pics/puces/menu_pointe_verte.png" alt="" class="pointe" />').find('.pointe').css('left', ((tabmenucurrentW /2) - 6) + 'px'); break;
        case 3: tabmenucurrent.append('<img src="/sites/all/themes/mnhn/pics/puces/menu_pointe_verte.png" alt="" class="pointe" />').find('.pointe').css('left', ((tabmenucurrentW /2) - 6) + 'px'); break;
        case 4: tabmenucurrent.append('<img src="/sites/all/themes/mnhn/pics/puces/menu_pointe_bleue.png" alt="" class="pointe" />').find('.pointe').css('left', ((tabmenucurrentW /2) - 6) + 'px'); break;
        case 5: tabmenucurrent.append('<img src="/sites/all/themes/mnhn/pics/puces/menu_pointe_bleue.png" alt="" class="pointe" />').find('.pointe').css('left', ((tabmenucurrentW /2) - 6) + 'px'); break;
        case 6: tabmenucurrent.append('<img src="/sites/all/themes/mnhn/pics/puces/menu_pointe_violet.png" alt="" class="pointe" />').find('.pointe').css('left', ((tabmenucurrentW /2) - 6) + 'px'); break;
    }

    jQuery("ul.menu-vertical > li > ul > li > span").click(function(){
		window.location.href=jQuery(this).find('a').attr('href');		
	});
    
    /* gestion des menus */
	jQuery(".menu .menu").css({
		display: "none",
		left: "auto"
	});
	
	jQuery('.menu li').hoverIntent(function() {
		jQuery(this)
		  .find('ul')
		  .slideDown('fast');
	}, function() {
		jQuery(this)
		  .find('ul')
		  .slideUp('fast');
	});

	if(!jQuery("body").hasClass("blog")){
    jQuery('.mainmenu li').click(function() {

        var onglet = jQuery(this);
        var ongletW = onglet.width();
        var index = jQuery('.mainmenu li').index(this);
        var url = onglet.find('a').attr('href');
        var height_menu_header=390;
        var top_transparent=580;
        var height_menu_header_numeritheque=460;
        var top_transparent_numeritheque=650;
        if(jQuery("#admin-menu").length>0){
        	top_transparent=top_transparent+30;
            top_transparent_numeritheque=top_transparent_numeritheque+30;
        }
        jQuery('.mainmenu li .pointe').remove();
        if(index==2){window.location.href=url;}
        else if ( index != 0 && index<7) { // tout clic en dehors du clic sur le lien Accueil

            if ( jQuery('#header-subwrapper:not(:visible)').length != 0 ) { // on ne passe par là que si le volet est completement fermé
                jQuery('#header-subwrapper').slideDown(800, 'easeInExpo');
            }
            if ( jQuery('.bigmenu:visible').length != 0 ) {
                if ( index == 5 ) {
                    jQuery('#transparent').animate({'top': top_transparent_numeritheque}, 800, 'easeInExpo');
                    jQuery('#header-subwrapper').animate({'height': height_menu_header_numeritheque}, 800, 'easeInExpo');
                }
                else {
                    jQuery('#transparent').animate({'top': top_transparent}, 800, 'easeInExpo');
                    jQuery('#header-subwrapper').animate({'height': height_menu_header}, 800, 'easeInExpo');
                }
                jQuery('.mainmenu li').removeClass('active');
                onglet.addClass('active');
                
                switch (index) {
                    case 1: onglet.append('<img src="/sites/all/themes/mnhn/pics/puces/menu_pointe_verte.png" alt="" class="pointe" />').find('.pointe').css('left', ((ongletW /2) - 6) + 'px'); break;
                    case 2: onglet.append('<img src="/sites/all/themes/mnhn/pics/puces/menu_pointe_verte.png" alt="" class="pointe" />').find('.pointe').css('left', ((ongletW /2) - 6) + 'px'); break;
                    case 3: onglet.append('<img src="/sites/all/themes/mnhn/pics/puces/menu_pointe_verte.png" alt="" class="pointe" />').find('.pointe').css('left', ((ongletW /2) - 6) + 'px'); break;
                    case 4: onglet.append('<img src="/sites/all/themes/mnhn/pics/puces/menu_pointe_bleue.png" alt="" class="pointe" />').find('.pointe').css('left', ((ongletW /2) - 6) + 'px'); break;
                    case 5: onglet.append('<img src="/sites/all/themes/mnhn/pics/puces/menu_pointe_bleue.png" alt="" class="pointe" />').find('.pointe').css('left', ((ongletW /2) - 6) + 'px'); break;
                    case 6: onglet.append('<img src="/sites/all/themes/mnhn/pics/puces/menu_pointe_violet.png" alt="" class="pointe" />').find('.pointe').css('left', ((ongletW /2) - 6) + 'px'); break;
                }
                
                jQuery('.close').fadeOut(300);
                jQuery('.bigmenu').removeClass('current').slideUp(800, 'easeOutExpo');
                jQuery('.bigmenu:eq(' + (index - 1) + ')').addClass('current').slideDown(800, 'easeInExpo', function() {
                    jQuery(this).find('.close').fadeIn(300);
                });
            } else { // on ne passe par là que si le volet est completement fermé au depart
                if ( index == 5 ) {
                    jQuery('#transparent').animate({'top': top_transparent_numeritheque}, 800, 'easeInExpo');
                    jQuery('#header-subwrapper').animate({'height': height_menu_header_numeritheque}, 800, 'easeInExpo');
                } 
                else {
                    jQuery('#transparent').animate({'top': top_transparent}, 800, 'easeInExpo');
                    jQuery('#header-subwrapper').animate({'height': height_menu_header}, 800, 'easeInExpo');
                }
                jQuery('.mainmenu li').removeClass('active');
                onglet.addClass('active');

                switch (index) {
                    case 1: onglet.append('<img src="/sites/all/themes/mnhn/pics/puces/menu_pointe_verte.png" alt="" class="pointe" />').find('.pointe').css('left', ((ongletW /2) - 6) + 'px'); break;
                    case 2: onglet.append('<img src="/sites/all/themes/mnhn/pics/puces/menu_pointe_verte.png" alt="" class="pointe" />').find('.pointe').css('left', ((ongletW /2) - 6) + 'px'); break;
                    case 3: onglet.append('<img src="/sites/all/themes/mnhn/pics/puces/menu_pointe_verte.png" alt="" class="pointe" />').find('.pointe').css('left', ((ongletW /2) - 6) + 'px'); break;
                    case 4: onglet.append('<img src="/sites/all/themes/mnhn/pics/puces/menu_pointe_bleue.png" alt="" class="pointe" />').find('.pointe').css('left', ((ongletW /2) - 6) + 'px'); break;
                    case 5: onglet.append('<img src="/sites/all/themes/mnhn/pics/puces/menu_pointe_bleue.png" alt="" class="pointe" />').find('.pointe').css('left', ((ongletW /2) - 6) + 'px'); break;
                    case 6: onglet.append('<img src="/sites/all/themes/mnhn/pics/puces/menu_pointe_violet.png" alt="" class="pointe" />').find('.pointe').css('left', ((ongletW /2) - 6) + 'px'); break;
                }

                jQuery('.bigmenu:eq(' + (index - 1) + ')').addClass('current').slideDown(800, 'easeInExpo', function() {
                    jQuery(this).find('.close').fadeIn(300);
                });
            }
        
        } else {
            window.location.href=url;
        }

        return false;
    });
	}
	
    
    jQuery('.bigmenu .close').live('click', function() {
        jQuery(this).fadeOut(300);
        jQuery(this).parents('.bigmenu').removeClass('current').slideUp(800, 'easeInExpo');
        jQuery('#transparent').animate({'top': '190px'}, 800, 'easeInExpo');
        jQuery('#header-subwrapper').slideUp(800, 'easeInExpo');
        jQuery(".mainmenu li").removeClass("active");
        jQuery(".mainmenu li .pointe").remove();
        return false;
    });


    jQuery('#bloc_pratik h3.accordeon').click(function() {
        var titleH = jQuery(this).innerHeight();
        if ( jQuery(this).parent().find('.bloc_content:visible').length != 0 ) {
            jQuery(this).parent().find('.bloc_content').slideUp(600);
            jQuery(this).parent().animate({'height': (titleH + 81) + 'px'}, 600);
            jQuery(this).addClass('closed');
        } else {
            jQuery(this).parent().find('.bloc_content').slideDown(600);
            jQuery(this).parent().animate({'height': '441px'}, 600);
            jQuery(this).removeClass('closed');
        }
        return false;
    });

    jQuery('#bloc_agenda h3.accordeon').click(function() {
    	
        var titleH = jQuery(this).innerHeight();
        if ( jQuery(this).parent().find('.bloc_content:visible').length != 0 ) {
            jQuery(this).parent().find('.bloc_content,#bloc_calendar').slideUp(600);
            jQuery(this).parent().animate({'height': titleH + 'px'}, 600);
            jQuery(this).addClass('closed');
        } else {
   
        	var heightBlock=jQuery(this).parent().find("#bloc_calendar").height()+260;
            jQuery(this).parent().find('.bloc_content,#bloc_calendar').slideDown(600);
            jQuery(this).parent().animate({'height': heightBlock}, 600,function(){
            	jQuery("#bloc_agenda").css("height","auto");
            	
            });
            jQuery(this).removeClass('closed');
         	jQuery("#bloc_calendar .fc-header-left span").trigger("click");
        	jQuery("#bloc_calendar .fc-header-right span").trigger("click");
        	
        }
        return false;
    });

    jQuery('#bloc_collecs h3.accordeon').click(function() {
        var titleH = jQuery(this).innerHeight();
        if ( jQuery(this).parent().find('.bloc_content:visible').length != 0 ) {
            jQuery(this).parent().find('.bloc_content').slideUp(600);
            jQuery(this).parent().animate({'height': titleH + 'px'}, 600);
            jQuery(this).addClass('closed');
        } else {
            jQuery(this).parent().find('.bloc_content').slideDown(600);
            jQuery(this).parent().animate({'height': '244px'}, 600);
            jQuery(this).removeClass('closed');
        }
        return false;
    });
	
	// clic sur un bloc 
	jQuery('.item_agenda').click(function() {
        var url = jQuery(this).find('a').attr('href');
        window.location(url);
        return false;
	});
	
	// retour en haut de page 
	jQuery('.toppage').click(function() {
        jQuery("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
	});
	
	// tooltip login & basket
    jQuery(".mybasket").tooltip({ effect: 'slide', tipClass: 'tip_basket', relative: true, position: 'bottom center', offset: [20, 0], delay: 400});
    var tipbasketW = jQuery('.tip_basket').width();
    jQuery('.tip_basket img').css('left', (tipbasketW /2) - 6 + 'px');
	
   
  jQuery('#share_reso').click(function(e){
    e.preventDefault();
    if (jQuery(this).parent().parent().next().is(':visible')) {
      jQuery(this).parent().parent().next().slideUp();//css({'display':'none'});
    }else{
      jQuery(this).parent().parent().next().slideDown();//css({'display':'block'});
    }
  });
  
  jQuery(".link_tools_rs").socialSharePrivacy({
      services : {
        facebook : {
          'sharer' : {
            'status'    : 'on',
            'dummy_img' : '/sites/all/themes/mnhn/js/socialshareprivacy/socialshareprivacy/images/dummy_facebook_share_en.png',
            'img'       : '/sites/all/themes/mnhn/js/socialshareprivacy/socialshareprivacy/images/facebook_share_en.png'
          },
          "statut" : "off",
          "perma_option"   : "false",
          'dummy_img' : '/sites/all/themes/mnhn/js/socialshareprivacy/socialshareprivacy/images/dummy_facebook_share_en.png',
          'img'       : '/sites/all/themes/mnhn/js/socialshareprivacy/socialshareprivacy/images/facebook_share_en.png'
        }, 
        twitter : {
          "status" : "on",
          "perma_option"   : "false",
          'dummy_img' : '/sites/all/themes/mnhn/js/socialshareprivacy/socialshareprivacy/images/dummy_twitter.png',
          'img'       : '/sites/all/themes/mnhn/js/socialshareprivacy/socialshareprivacy/images/dummy_twitter_dark.png'
        },
        gplus : {
          "status" : "on",
          "perma_option"   : "false",
          'dummy_img' : '/sites/all/themes/mnhn/js/socialshareprivacy/socialshareprivacy/images/dummy_gplus.png',
          'img'       : '/sites/all/themes/mnhn/js/socialshareprivacy/socialshareprivacy/images/dummy_twitter_dark.png'
        }
      },
      "css_path"      : "/sites/all/themes/mnhn/js/socialshareprivacy/socialshareprivacy/socialshareprivacy.css",
      "lang_path"     : "/sites/all/themes/mnhn/js/socialshareprivacy/socialshareprivacy/lang/",
      "language"      : "fr",
    });
});


jQuery(window).load(function(){

});
