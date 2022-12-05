window.mobileAndTabletcheck = function() {
    var check = false;
    (function(a) { if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))) check = true; })(navigator.userAgent || navigator.vendor || window.opera);
    return check;
};

function showModal(modal) {
    jQuery(modal).fadeIn('normal');
    jQuery(modal).find('.background-overlay').click(function() {
        jQuery(modal).fadeOut('normal');
    });
    jQuery(modal).find('.close').click(function() {
        jQuery(modal).fadeOut('normal');
    });
}

jQuery(document).ready(function() {
    if( mobileAndTabletcheck() === false ) {
        AOS.init();
    }

    /* Backtop
     ---------------------------------------------------------------*/
    jQuery(window).scroll(function(){jQuery(this).scrollTop()>1000?jQuery("#back-top").fadeIn(100):jQuery("#back-top").fadeOut(100)}),jQuery("#back-top").click(function(){return jQuery("body,html").animate({scrollTop:0},1200),!1});
    
    /* Slick Slider
     ---------------------------------------------------------------*/
     if ( jQuery().slick ) {
        var slick = jQuery(".slick-carousel");
        slick.each(function(){
            var items       = jQuery(this).data('items'),
                items_lg    = jQuery(this).data('items_lg'),
                items_md    = jQuery(this).data('items_md'),
                items_sm    = jQuery(this).data('items_sm'),
                items_mb    = jQuery(this).data('items_mb'),
                row         = jQuery(this).data('row'),
                arrows      = jQuery(this).data('arrows'),
                dots        = jQuery(this).data('dots'),
                infinite    = jQuery(this).data('infinite'),
                autoplay    = jQuery(this).data('autoplay'),
                vertical    = jQuery(this).data('vertical');
            jQuery(this).slick({
                autoplay: autoplay,
                dots: dots,
                arrows: arrows,
                infinite: infinite,
                autoplaySpeed: 4000,
                vertical: vertical,
                slidesToShow: items,
                slidesToScroll: 1,
                lazyLoad: 'ondemand',
                adaptiveHeight: false,
                cssEase: 'linear',
                // verticalSwiping: true,
                rows: row,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: items_lg,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: items_md,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 850,
                        settings: {
                            slidesToShow: items_sm,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: items_mb,
                            slidesToScroll: 1,
                        }
                    }
                ]
            });
        });
    }


    /* Mobile Menu
     ---------------------------------------------------------------*/

    jQuery('body').on('click', '#showmenu', function() {
        jQuery(this).toggleClass('active');
        jQuery('body').toggleClass('nav-is-toggled');
        jQuery('.panel-overlay').toggleClass('active');
        jQuery('.menu_close').toggleClass('active');
    });
    jQuery('body').on('click', '.menu_close,.panel-overlay', function() {
        jQuery('body').toggleClass('nav-is-toggled');
        jQuery(this).removeClass('active');
        jQuery('.panel-overlay').removeClass('active');
        jQuery('.menu_close').removeClass('active');
        jQuery('#showmenu').removeClass('active');
    });

    jQuery("#mobilenav ul.sub-menu,.widget_nav_menu ul.sub-menu").before('<span class="arrow"> <i class="icon-angle-down"></i> </span>');

    jQuery("body").on('click', '.arrow', function() {
        if (jQuery(this).parent('li').hasClass('open')) {
            jQuery(this).parent('li').find('ul.sub-menu').slideUp("normal");
            jQuery(this).parent('li').removeClass('open');
        } else {
            jQuery(this).parent('li').addClass('open').find('ul.sub-menu').first().slideToggle("normal");
        }
    });
    jQuery("body").on('click', '#mobilenav .mobile-menu > li.open > .arrow,.widget_nav_menu ul.menu > li.open > .arrow', function() {
        jQuery('#mobilenav .mobile-menu li,.widget_nav_menu ul.menu li').removeClass('open');
        jQuery('#mobilenav .mobile-menu li,.widget_nav_menu ul.menu li').find('ul.sub-menu').slideUp('normal');
    });


    /* Widget Toggle
     ---------------------------------------------------------------*/
    jQuery(window).load(function() {
        jQuery('.widget_nav_menu .current-menu-ancestor').addClass('open');
        jQuery('.widget_nav_menu .current-menu-ancestor.open > .sub-menu').slideToggle("normal");
    });
    /* Disable autocomplete
     ---------------------------------------------------------------*/
    jQuery('input').attr('autocomplete', 'off');

    /* Contact form
     ---------------------------------------------------------------*/
    document.addEventListener("wpcf7invalid", function(e) { jQuery(".wpcf7-response-output").addClass("alert alert-danger") }, !1), document.addEventListener("wpcf7spam", function(e) { jQuery(".wpcf7-response-output").addClass("alert alert-warning") }, !1), document.addEventListener("wpcf7mailfailed", function(e) { jQuery(".wpcf7-response-output").addClass("alert alert-warning") }, !1), document.addEventListener("wpcf7mailsent", function(e) { jQuery(".wpcf7-response-output").addClass("alert alert-success") }, !1);

    jQuery(window).bind('scroll', function() {
        var navHeight = 150;
        if (jQuery(window).scrollTop() > navHeight) {
            jQuery('.main-navigation').addClass('fixed');  
        }
        else {
            jQuery('.main-navigation').removeClass('fixed');
        }
    });

});