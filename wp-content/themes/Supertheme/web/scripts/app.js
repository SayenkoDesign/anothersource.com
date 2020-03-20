function getParameterByName(name, url) {

    if (!url) url = window.location.href;

    name = name.replace(/[\[\]]/g, "\\$&");

    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),

        results = regex.exec(url);

    if (!results) return null;

    if (!results[2]) return '';

    return decodeURIComponent(results[2].replace(/\+/g, " "));

}



jQuery(function() {

    jQuery(document).foundation();

    jQuery('.fancybox').fancybox();

    jQuery('.slick').slick();

    jQuery('.slick-jobs').slick({

        infinite: true,

        slidesToShow: 4,

        slidesToScroll: 1

    });

    jQuery("section.contact form").on("submit", function(){

        ga('send', {

            hitType: 'event',

            eventCategory: 'Form',

            eventAction: 'submit',

            eventLabel: 'Contact Form'

        });

    });



    jQuery('.large-menu a, #small-menu a').click(function(e){

        var scrollto = getParameterByName('scrollTo', jQuery(this).attr("href"));

        var href = jQuery(this).attr("href");

        href = href.substring(0, href.indexOf('?'));

        if(href == window.location.pathname) {

            e.preventDefault();

            jQuery('html, body').animate({

                scrollTop: jQuery('#' + scrollto).offset().top - 100

            }, 2000);

            return false;

        }

    });

    if(getParameterByName('scrollTo')) {

        jQuery('html, body').animate({

            scrollTop: jQuery("#" + getParameterByName('scrollTo')).offset().top - 100

        }, 2000);

    }

});



        
jQuery(window).load(function() {
      var container = document.querySelector('#posts-container');
      var msnry = new Masonry( container, {
        itemSelector: 'article',
        columnWidth: 'article',                
      });  
 });

      
