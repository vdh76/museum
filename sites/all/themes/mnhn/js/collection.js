$(document).ready(function(){

    // craftmap
	$('#voyage').craftmap({
		container: {
			name: 'imgContentSmall'
		},
		image: {
			width: 1357,
			height: 628,
			name: 'imgMapSmall'
		},
        map: {
            position: 'center' 
        },
        marker: {
            name: 'markerSmall',
            popup: false,
			popup_name: 'popupSmall'
        },
        tip: {
            popin: true
        },
		controls: {
			name: 'controlsSmall'
		},
		preloader: {
			name: 'preloaderSmall'
		}
	});

	$('#archeo').craftmap({
		container: {
			name: 'imgContentSmall'
		},
		image: {
			width: 1800,
			height: 628,
			name: 'imgMapSmall'
		},
        map: {
            position: 'center' 
        },
        marker: {
            name: 'markerSmall',
            popup: false,
			popup_name: 'popupSmall'
        },
        tip: {
            popin: true
        },
		controls: {
			name: 'controlsSmall'
		},
		preloader: {
			name: 'preloaderSmall'
		}
	});

    // bulle d'aide
	$('.help').live('click', function() {
        if ( $('.text_help:visible').length != 0 ) {
            $('.text_help').fadeOut('slow');
        } else {
            $('.text_help').fadeIn('slow');
        }
	});

    // fermer bulle d'aide
	$('.close_help').live('click', function() {
        $('.text_help').fadeOut('slow');
	});


	
	// fade des onglets
	$('.tabscollec').tabs('.collecpanes > .pane', {
	    tabs: 'li',
	    effect: 'fade'
	});

    // onglets : gestion de la pointe des onglets
    var tabcurrent  = $('.tabscollec li.current'),
        tabcurrentW = tabcurrent.width();
    $('.tabscollec li .pointe').remove();
    tabcurrent.append('<img src="/pics/puces/pointe_collec.png" alt="" class="pointe" />').find('.pointe').css('left', ((tabcurrentW /2) - 6) + 'px');

    $('.tabscollec li').click(function() {
    	
        var index = $('.tabscollec li').index(this);  
        tabcurrentW = $(this).width();
        $('.tabscollec li .pointe').remove();
        $(this).append('<img src="/pics/puces/pointe_collec.png" alt="" class="pointe" />').find('.pointe').css('left', ((tabcurrentW /2) - 6) + 'px');
    });
    

    // shadowbox
    $('.link_zoom').fancybox({
        padding: 0,
        margin: 0,
        autoDimensions: false,
        autoScale: false,
        width: 935,
        height: 628
    });

    // apparition de la fiche objet
    $('.link_collec').live('click', function() {
        $('.list').animate({'marginLeft': '-560px'}, 800, 'easeInExpo');
        $('pagination').hide();
        $(this).parent().find('.fiche_objet').detach().prependTo('#fiche_objet .fiche_objet_body');
        return false;
    });
    
    // disparition de la fiche objet
    /*
    $('.retour').live('click', function() {
        $(this).parent().parent().detach().prependTo();
    });
    */


    $(".menu-vertical > li.expanded").find('ul').show();

    $(".menu-vertical > li.submenu").live('click', function() {
        $(this).siblings('submenu').removeClass('expanded');
        if ( $(this).find('ul:visible').length != 0 ) {
            $(this).removeClass('expanded').find('ul').slideUp(600);
        } else {
            $(this).addClass('expanded').find('ul').slideDown(600);
        }
        return false;
    });
    $(".menu-vertical > li.expanded").live('click', function() {
        $(this).removeClass('expanded').find('ul').slideUp(600);
        return false;
    });

    /* initialisation de la gallery */
    $('.gallery').find('.slide:first').css('left', '0px');

    $('.gallerytabs li').click(function() {
        var galerieId = $(this).parents('.gallery');
        var index = galerieId.find('.gallerytabs li').index(this);
        galerieId.find('.slide.current').removeClass('current').animate({'left': '-522px'}, 800, 'easeInExpo', function() {
            $(this).css('left', '522px');
        });
        galerieId.find('.gallerytabs li').find('a').removeClass('active');
        $(this).find('a').addClass('active');
        galerieId.find('.slide:eq(' + index + ')').addClass('current').animate({'left': '0px'}, 800, 'easeInExpo');
        return false;
    });
    
    $('.forward').click(function() {
        var galerieId = $(this).parents('.gallery');
        var slideSelected = galerieId.find('.slide.current');
        slideSelected.siblings().css('left','522px');
        var index = slideSelected.index();
        var indextab = galerieId.find('.gallerytabs li').index(this);
        var nbSlides = galerieId.find('.slide').length;
        
        if ( (index + 1) != nbSlides ) {
            slideSelected.removeClass('current').animate({'left': '-522px'}, 800, 'easeInExpo', function() {
                $(this).css('left', '522px');
            });
            slideSelected.next().addClass('current');
            galerieId.find('.gallerytabs li').find('a').removeClass('active');
            galerieId.find('.gallerytabs li:eq(' + (index+1) + ')').find('a').addClass('active');
            galerieId.find('.slide:eq(' + (index+1) + ')').animate({'left': '0px'}, 800, 'easeInExpo');
            
        } else {
            slideSelected.removeClass('current').animate({'left': '-522px'}, 800, 'easeInExpo', function() {
                $(this).css('left', '522px');
            });
            galerieId.find('.gallerytabs li').find('a').removeClass('active');
            galerieId.find('.gallerytabs li:eq(0)').find('a').addClass('active');
            galerieId.find('.slide:eq(0)').addClass('current').animate({'left': '0px'}, 800, 'easeInExpo');

        }
        return false;
    });

    $('.backward').click(function() {
        var galerieId = $(this).parents('.gallery');
        var slideSelected = galerieId.find('.slide.current');
        slideSelected.siblings().css('left','-522px');
        var index = slideSelected.index();
        var nbSlides = galerieId.find('.slide').length;
        
        if ( index != 0 ) {
            slideSelected.removeClass('current').animate({'left': '522px'}, 800, 'easeInExpo', function() {
                $(this).css('left', '522px');
            });
            slideSelected.prev().addClass('current');
            galerieId.find('.gallerytabs li').find('a').removeClass('active');
            galerieId.find('.gallerytabs li:eq(' + (index-1) + ')').find('a').addClass('active');
            galerieId.find('.slide:eq(' + (index-1) + ')').animate({'left': '0px'}, 800, 'easeInExpo');
            
        } else {
            slideSelected.removeClass('current').animate({'left': '522px'}, 800, 'easeInExpo', function() {
                $(this).css('left', '522px');
            });
            galerieId.find('.gallerytabs li').find('a').removeClass('active');
            galerieId.find('.gallerytabs li:last').find('a').addClass('active');
            galerieId.find('.slide:last').addClass('current').animate({'left': '0px'}, 800, 'easeInExpo');

        }
        return false;
    });
    


});



