jQuery(function(){

    var cPosition = 0;//Position courante
    var slides = jQuery('.diapos');//Identification des slides
    var numSlides = (slides.length-1);//Nombre de slide
    var btn = jQuery('.nav_slider');

    if (jQuery( window ).width() >= 990) {
        var timer=setInterval(function(){anime_gallery(cPosition,300);}, 5000);
    }

    slides.hover(
        function(){ clearInterval(timer); },
        function(){ timer=setInterval(function(){anime_gallery(cPosition,300);}, 5000); }
    );

    // click vignettes
    btn.bind('click', function(e){
        e.preventDefault();
        cPosition = (jQuery(this).attr('data-index'));
        anime_gallery(cPosition,0);
    });

    // anime gallery
    function anime_gallery(position, duration){
        jQuery('.diapos').css({'display' : 'none'});
        jQuery('.diapos:eq('+position+')').css({'display' : 'block'});

        if((cPosition) == numSlides){
            cPosition = 0;
        }else{
            cPosition++;
        }
    }

});

