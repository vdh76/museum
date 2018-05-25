jQuery(document).ready(function () {

    jQuery("#tags,#archives").change(function () {
        if (jQuery(this).val() != 0) {
            window.location.href = jQuery(this).val();
        }
    });

    jQuery("#link_post_comment").click(function () {
        jQuery.scrollTo("#comment", 500);
    });

    jQuery(".comment .action").click(function () {
        if (confirm("Êtes-vous sur de vouloir supprimer le commentaire ?")) {
            var comment = jQuery(this).parent();
            jQuery.ajax({
                url: '/blog/comment/delete/' + jQuery(this).attr("rel"),
                type: 'POST',
                dataType: "html",
                success: function (data) {
                    comment.slideUp();
                }
            });
        }
    });

    /* stylisation des selects */
    if (!jQuery.browser.opera) {

        // select element styling
        jQuery('select.select_blog').each(function () {
            var title = jQuery(this).attr('title');
            if (jQuery('option:selected', this).val() != '') title = jQuery('option:selected', this).text();
            jQuery(this)
                .css({'z-index': 10, 'opacity': 0, '-khtml-appearance': 'none'})
                .after('<span class="select_blog">' + title + '</span>')
                .change(function () {
                    val = jQuery('option:selected', this).text();
                    jQuery(this).next().text(val);
                })
        });
    }
    ;

    /* initialisation de la gallery */
    jQuery('.gallery').find('.slide:first').css('left', '0px');

    jQuery('.gallerytabs li').click(function () {
        var index = jQuery('.gallerytabs li').index(this);
        jQuery('.slide.current').removeClass('current').animate({'left': '-672px'}, 800, 'easeInExpo', function () {
            jQuery(this).css('left', '672px');
        });
        jQuery('.gallerytabs li').find('a').removeClass('active');
        jQuery(this).find('a').addClass('active');
        jQuery('.slide:eq(' + index + ')').addClass('current').animate({'left': '0px'}, 800, 'easeInExpo');
        return false;
    });

    jQuery('.forward').click(function () {
        var slideSelected = jQuery('.slide.current');
        slideSelected.siblings().css('left', '672px');
        var index = slideSelected.index();
        var indextab = jQuery('.gallerytabs li').index(this);
        var nbSlides = jQuery('.gallery .slide').length;

        if ((index + 1) != nbSlides) {
            slideSelected.removeClass('current').animate({'left': '-672px'}, 800, 'easeInExpo', function () {
                jQuery(this).css('left', '672px');
            });
            slideSelected.next().addClass('current');
            jQuery('.gallerytabs li').find('a').removeClass('active');
            jQuery('.gallerytabs li:eq(' + (index + 1) + ')').find('a').addClass('active');
            jQuery('.gallery .slide:eq(' + (index + 1) + ')').animate({'left': '0px'}, 800, 'easeInExpo');
        } else {
            slideSelected.removeClass('current').animate({'left': '-672px'}, 800, 'easeInExpo', function () {
                jQuery(this).css('left', '672px');
            });
            jQuery('.gallerytabs li').find('a').removeClass('active');
            jQuery('.gallerytabs li:eq(0)').find('a').addClass('active');
            jQuery('.gallery .slide:eq(0)').addClass('current').animate({'left': '0px'}, 800, 'easeInExpo');
        }
        return false;
    });

    jQuery('.backward').click(function () {
        var slideSelected = jQuery('.slide.current');
        slideSelected.siblings().css('left', '-672px');
        var index = slideSelected.index();
        var nbSlides = jQuery('.gallery .slide').length;

        if (index != 0) {
            slideSelected.removeClass('current').animate({'left': '672px'}, 800, 'easeInExpo', function () {
                jQuery(this).css('left', '672px');
            });
            slideSelected.prev().addClass('current');
            jQuery('.gallerytabs li').find('a').removeClass('active');
            jQuery('.gallerytabs li:eq(' + (index - 1) + ')').find('a').addClass('active');
            jQuery('.gallery .slide:eq(' + (index - 1) + ')').animate({'left': '0px'}, 800, 'easeInExpo');
        } else {
            slideSelected.removeClass('current').animate({'left': '672px'}, 800, 'easeInExpo', function () {
                jQuery(this).css('left', '672px');
            });
            jQuery('.gallerytabs li').find('a').removeClass('active');
            jQuery('.gallerytabs li:last').find('a').addClass('active');
            jQuery('.gallery .slide:last').addClass('current').animate({'left': '0px'}, 800, 'easeInExpo');
        }
        return false;
    });

    // lightbox
    jQuery(".fancybox").fancybox();

    // retour en haut de page
    jQuery('.toppage').click(function () {
        jQuery("html, body").animate({scrollTop: 0}, "slow");
        return false;
    });

    jQuery("#comment .link").click(function () {

        jQuery("#comment").css("opacity", 0.5);
        jQuery("#comment .loading").show();
        var error = 0;
        var message = '';

        if (jQuery("#comment #nom").val() == 0) {
            error = 1;
            message += 'Le champs nom est obligatoire.\n';
        }

        if (jQuery("#comment #commentaire").val().length < 10) {
            error = 1;
            message += 'Votre commentaire doit comporter au moins 30 caractères.\n';
        }

        if (error == 1) {
            alert(message);
            jQuery("#comment").css("opacity", 1);
            jQuery("#comment .loading").hide();
        } else {
            jQuery.ajax({
                url: '/blog/comment/add/' + jQuery("#comment").attr("rel"),
                type: 'POST',
                data: {
                    nom: jQuery("#comment #nom").val(),
                    commentaire: jQuery("#comment #commentaire").val()
                },
                dataType: "html",
                success: function (data) {
                    jQuery("#comment #nom").val("");
                    jQuery("#comment #commentaire").val("");
                    var nb_comment = parseFloat(jQuery(".comments .link_comment strong span").html()) + 1;
                    jQuery(".comments .link_comment strong span").html(nb_comment);
                    jQuery("#comment").css("opacity", 1);
                    jQuery("#comment .loading").hide();
                    jQuery(".post_comment_form").slideUp();
                    jQuery(".post_comment_message").show();
                }
            });
        }
    });
});