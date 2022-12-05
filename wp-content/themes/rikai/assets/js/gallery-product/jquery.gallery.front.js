jQuery(document).ready(function() {
	if( jQuery('.unidev-slider-for').length > 0 ) {		
		
		if( gallery_single_custom.gallery_style === '2' && mobileAndTabletcheck() === false ){ 
			var slider_style = true;
			jQuery('.woocommerce div.product .images').addClass('gallery-vertical clearfix');
		} else {
			var slider_style = false;
			jQuery('.woocommerce div.product .images').addClass('gallery-horizontal');
		}

		var slider_thumbnails = parseInt(gallery_single_custom.gallery_thumbnails);
		if( gallery_single_custom.gallery_popup != '1' ) { 
			jQuery('a.unidev-popup').remove();
		}
		
		if( gallery_single_custom.gallery_autoplay === '1' ) { 
			var slider_autoplay = true;
		} else {
			var slider_autoplay = false;
		}
		
		jQuery('.unidev-slider-for').slick({
			fade: true,
			autoplay : slider_autoplay,
			arrows: false,
			slidesToShow: 1,
			infinite: false,
			slidesToScroll: 1,
			draggable: false,
			asNavFor: '.unidev-slider-nav'
		});
		
		jQuery('.unidev-slider-nav').slick({
			dots: false,
			arrows: true,
			vertical : slider_style,
			centerMode: false,
			focusOnSelect: true,
			infinite: false,
			slidesToShow: slider_thumbnails,
			slidesToScroll: 1,
			draggable: false,
			asNavFor: '.unidev-slider-for'
		});

		if( gallery_single_custom.gallery_zoom === '1' && mobileAndTabletcheck() === false ) {
			jQuery('.unidev-slider-for .slick-slide').zoom();
		}

		jQuery('.unidev-slider-for .slick-track').addClass('woocommerce-product-gallery__image single-product-main-image');
		jQuery('.unidev-slider-nav .slick-track').addClass('flex-control-nav');
		jQuery('.unidev-slider-nav .slick-track li img').removeAttr('srcset');
		
		jQuery('.variations select').change(function() {
			jQuery('.unidev-slider-nav').slick( 'slickGoTo', 0 );
			window.setTimeout( function() {
				if( gallery_single_custom.gallery_zoom === '1' && mobileAndTabletcheck() === false ){
					jQuery('.unidev-slider-for .slick-track .slick-current').zoom();
				}
			}, 20 );
		});
	}
});