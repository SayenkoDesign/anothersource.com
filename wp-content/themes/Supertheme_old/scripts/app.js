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
    console.log(getParameterByName('scrollTo');
    jQuery('.large-menu a, #small-menu a').click(function(){
        var href = jQuery(this).attr("href");
        console.log("link: " + jQuery(this).attr("href"));
        console.log("current page: " + href[0].pathname);
        if(href[0].pathname == window.location.pathname) {
            jQuery('html, body').animate({
                scrollTop: jQuery(getParameterByName('scrollTo'), href).offset().top - 200
            }, 2000);
        }
    });
    if(getParameterByName('scrollTo')) {
        console.log("attempting to scroll");
        jQuery('html, body').animate({
            scrollTop: jQuery(getParameterByName('scrollTo')).offset().top - 200
        }, 2000);
    }
});