$(document).ready(function() {
   

       


    $('.accordion2 .selected').next('.encart').show();
    $('.accordion2 .encart:not(:visible)').prev('.title_accordion').find('span.small').hide(); 
    
    
    $('.accordion2 .title_accordion').live('click', function() {
        if ( $(this).next('.encart:visible').length != 0 ) {
            $(this).find('span').hide();
            $(this).removeClass('selected').addClass('plie').next('.encart').slideUp(600);
        } else {
            $(this).find('span').show();
            $(this).addClass('selected').removeClass('plie').next('.encart').slideDown(600);
        }
    });
    

    // lightbox
    $(".fancybox").fancybox();
    

    /* initialisation de la gallery */
    $('.gallery').find('.slide:first').css('left', '0px');

    $('.gallerytabs li').click(function() {
        var index = $('.gallerytabs li').index(this);
        $('.slide.current').removeClass('current').animate({'left': '-522px'}, 800, 'easeInExpo', function() {
            $(this).css('left', '522px');
        });
        $('.gallerytabs li').find('a').removeClass('active');
        $(this).find('a').addClass('active');
        $('.slide:eq(' + index + ')').addClass('current').animate({'left': '0px'}, 800, 'easeInExpo');
        return false;
    });
    
    $('.forward').click(function() {
        var slideSelected = $('.slide.current');
        slideSelected.siblings().css('left','522px');
        var index = slideSelected.index();
        var indextab = $('.gallerytabs li').index(this);
        var nbSlides = $('.gallery .slide').length;
        
        if ( (index + 1) != nbSlides ) {
            slideSelected.removeClass('current').animate({'left': '-522px'}, 800, 'easeInExpo', function() {
                $(this).css('left', '522px');
            });
            slideSelected.next().addClass('current');
            $('.gallerytabs li').find('a').removeClass('active');
            $('.gallerytabs li:eq(' + (index+1) + ')').find('a').addClass('active');
            $('.gallery .slide:eq(' + (index+1) + ')').animate({'left': '0px'}, 800, 'easeInExpo');
            
        } else {
            slideSelected.removeClass('current').animate({'left': '-522px'}, 800, 'easeInExpo', function() {
                $(this).css('left', '522px');
            });
            $('.gallerytabs li').find('a').removeClass('active');
            $('.gallerytabs li:eq(0)').find('a').addClass('active');
            $('.gallery .slide:eq(0)').addClass('current').animate({'left': '0px'}, 800, 'easeInExpo');

        }
        return false;
    });

    $('.backward').click(function() {
        var slideSelected = $('.slide.current');
        slideSelected.siblings().css('left','-522px');
        var index = slideSelected.index();
        var nbSlides = $('.gallery .slide').length;
        
        if ( index != 0 ) {
            slideSelected.removeClass('current').animate({'left': '522px'}, 800, 'easeInExpo', function() {
                $(this).css('left', '522px');
            });
            slideSelected.prev().addClass('current');
            $('.gallerytabs li').find('a').removeClass('active');
            $('.gallerytabs li:eq(' + (index-1) + ')').find('a').addClass('active');
            $('.gallery .slide:eq(' + (index-1) + ')').animate({'left': '0px'}, 800, 'easeInExpo');
            
        } else {
            slideSelected.removeClass('current').animate({'left': '522px'}, 800, 'easeInExpo', function() {
                $(this).css('left', '522px');
            });
            $('.gallerytabs li').find('a').removeClass('active');
            $('.gallerytabs li:last').find('a').addClass('active');
            $('.gallery .slide:last').addClass('current').animate({'left': '0px'}, 800, 'easeInExpo');

        }
        return false;
    });
    
    
});