jQuery(document).ready(function(){

    jQuery(".menu-vertical > li.expanded").find('ul').show();

    jQuery(".menu-vertical > li.submenu").live('click', function() {
        jQuery(this).siblings('submenu').removeClass('expanded');
        if ( jQuery(this).find('ul:visible').length != 0 ) {
            jQuery(this).removeClass('expanded').find('ul').slideUp(600);
        } else {
            jQuery(this).addClass('expanded').find('ul').slideDown(600);
        }
        return false;
    });
    jQuery(".menu-vertical > li.expanded").live('click', function() {
        jQuery(this).removeClass('expanded').find('ul').slideUp(600);
        return false;
    });
    
    jQuery('.accordion .selected,.accordion .visible').next('.item').show();
    jQuery('.accordion .selected').next('.encart').show();
    jQuery('.accordion2 .encart:not(:visible)').prev('.title_accordion').find('span.small').hide(); 
    
    
    jQuery('.accordion .title_accordion').live('click', function() {
        if ( jQuery(this).next('.item:visible').length != 0 ) {
            jQuery(this).removeClass('selected').addClass('plie').next('.item').slideUp(600);
        } else {
            jQuery(this).addClass('selected').removeClass('plie').next('.item').slideDown(600);
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

    // lightbox
    jQuery(".fancybox").fancybox();
    

    /* initialisation de la gallery */
    jQuery('.gallery').find('.slide:first').css('left', '0px');

    jQuery('.gallerytabs li').click(function() {
        var index = jQuery('.gallerytabs li').index(this);
        jQuery('.slide.current').removeClass('current').animate({'left': '-522px'}, 800, 'easeInExpo', function() {
            jQuery(this).css('left', '522px');
        });
        jQuery('.gallerytabs li').find('a').removeClass('active');
        jQuery(this).find('a').addClass('active');
        jQuery('.slide:eq(' + index + ')').addClass('current').animate({'left': '0px'}, 800, 'easeInExpo');
        return false;
    });
    
    jQuery('.forward').click(function() {
        var slideSelected = jQuery('.slide.current');
        slideSelected.siblings().css('left','522px');
        var index = slideSelected.index();
        var indextab = jQuery('.gallerytabs li').index(this);
        var nbSlides = jQuery('.gallery .slide').length;
        
        if ( (index + 1) != nbSlides ) {
            slideSelected.removeClass('current').animate({'left': '-522px'}, 800, 'easeInExpo', function() {
                jQuery(this).css('left', '522px');
            });
            slideSelected.next().addClass('current');
            jQuery('.gallerytabs li').find('a').removeClass('active');
            jQuery('.gallerytabs li:eq(' + (index+1) + ')').find('a').addClass('active');
            jQuery('.gallery .slide:eq(' + (index+1) + ')').animate({'left': '0px'}, 800, 'easeInExpo');
            
        } else {
            slideSelected.removeClass('current').animate({'left': '-522px'}, 800, 'easeInExpo', function() {
                jQuery(this).css('left', '522px');
            });
            jQuery('.gallerytabs li').find('a').removeClass('active');
            jQuery('.gallerytabs li:eq(0)').find('a').addClass('active');
            jQuery('.gallery .slide:eq(0)').addClass('current').animate({'left': '0px'}, 800, 'easeInExpo');

        }
        return false;
    });

    jQuery('.backward').click(function() {
        var slideSelected = jQuery('.slide.current');
        slideSelected.siblings().css('left','-522px');
        var index = slideSelected.index();
        var nbSlides = jQuery('.gallery .slide').length;
        
        if ( index != 0 ) {
            slideSelected.removeClass('current').animate({'left': '522px'}, 800, 'easeInExpo', function() {
                jQuery(this).css('left', '522px');
            });
            slideSelected.prev().addClass('current');
            jQuery('.gallerytabs li').find('a').removeClass('active');
            jQuery('.gallerytabs li:eq(' + (index-1) + ')').find('a').addClass('active');
            jQuery('.gallery .slide:eq(' + (index-1) + ')').animate({'left': '0px'}, 800, 'easeInExpo');
            
        } else {
            slideSelected.removeClass('current').animate({'left': '522px'}, 800, 'easeInExpo', function() {
                jQuery(this).css('left', '522px');
            });
            jQuery('.gallerytabs li').find('a').removeClass('active');
            jQuery('.gallerytabs li:last').find('a').addClass('active');
            jQuery('.gallery .slide:last').addClass('current').animate({'left': '0px'}, 800, 'easeInExpo');

        }
        return false;
    });

});



