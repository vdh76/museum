$(document).ready(function(){

	

    
    /* initialisation de la gallery */
    $('#gallery .gallery:first').addClass('current').show();
    $('#gallery .gallery:first').find('.slide:first').css('left', '0px');

    $('.gallerytabs li').click(function() {
        var index = $('.gallerytabs li').index(this);
        $('.gallery').removeClass('current').fadeOut(1500);
        $('.gallerytabs li').find('a').removeClass('active');
        $(this).find('a').addClass('active');
        $('.gallery:eq(' + index + ')').addClass('current').fadeIn(1500).find('.slide:first').css('left', '0px');
        return false;
    });
    
    $('.forward').click(function() {
        var slideSelected = $('.gallery.current .slide.current');
        slideSelected.siblings().css('left','522px');
        var index = slideSelected.index();
        var nbSlides = $('.gallery.current .slide').length;
        
        if ( (index + 1) != nbSlides ) {
            slideSelected.removeClass('current').animate({'left': '-522px'}, 800, 'easeInExpo', function() {
                $(this).css('left', '522px');
            });
            slideSelected.next().addClass('current');
            $('.gallery.current .slide:eq(' + (index+1) + ')').animate({'left': '0px'}, 800, 'easeInExpo');
            
        } else {
            slideSelected.removeClass('current').animate({'left': '-522px'}, 800, 'easeInExpo', function() {
                $(this).css('left', '522px');
            });
            $('.gallery.current .slide:eq(0)').addClass('current').animate({'left': '0px'}, 800, 'easeInExpo');

        }
        return false;
    });

    $('.backward').click(function() {
        var slideSelected = $('.gallery.current .slide.current');
        slideSelected.siblings().css('left','-522px');
        var index = slideSelected.index();
        var nbSlides = $('.gallery.current .slide').length;
        
        if ( index != 0 ) {
            slideSelected.removeClass('current').animate({'left': '522px'}, 800, 'easeInExpo', function() {
                $(this).css('left', '522px');
            });
            slideSelected.prev().addClass('current');
            $('.gallery.current .slide:eq(' + (index-1) + ')').animate({'left': '0px'}, 800, 'easeInExpo');
            
        } else {
            slideSelected.removeClass('current').animate({'left': '522px'}, 800, 'easeInExpo', function() {
                $(this).css('left', '522px');
            });
            $('.gallery.current .slide:eq(2)').addClass('current').animate({'left': '0px'}, 800, 'easeInExpo');

        }
        return false;
    });


});



