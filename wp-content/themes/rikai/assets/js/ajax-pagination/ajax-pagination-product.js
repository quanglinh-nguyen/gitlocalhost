/*******
Author Uni Creation
*********/
// JavaScript Document
(function($) {
    $(document).ready(function(){
        $( '#result_pagination' ).on( 'click',' ul.pagination a', function( e ) {
            /** Prevent Default Behaviour */
            e.preventDefault();
            /** Get data-page */
            var data_page = $(this).attr( 'data-page' );
                posts_per_page = $('.ajax_pagination').attr( 'posts_per_page' );
                orderby = $('.ajax_pagination').attr( 'orderby' );
                post_type = $('.ajax_pagination').attr( 'post_type' );
                categories = $('.ajax_pagination').attr( 'categories' );
                taxonomy = $('.ajax_pagination').attr( 'taxonomy' );
                height = jQuery('.site-header').height();
            // console.log(orderby);
            /** Ajax Call */
            $.ajax({
                cache: false,
                timeout: 8000,
                url: uni_array_ajaxp.url,
                type: "POST",
                data: ({ 
                    action			:	'LoadProductPagination', 
                    data_page		:	data_page,
                    posts_per_page	:	posts_per_page,
                    taxonomy		:	taxonomy,
                    categories		:	categories,
                    post_type		:	post_type,
                    orderby		    :	orderby 
                }),
                beforeSend: function() {
                    $( '.loading_pagination' ).css( 'display','block' );
                },
                success: function( data, textStatus, jqXHR ){					
                    $( '#result_pagination' ).html( data );
                    $( '.loading_pagination' ).css( 'display','none' );
                },
                error: function( jqXHR, textStatus, errorThrown ){
                    console.log( 'The following error occured: ' + textStatus, errorThrown );
                },
                complete: function( jqXHR, textStatus ){
                    $("html, body").animate({ scrollTop: height }, "slow");
                }
            });
        });
    });
})(jQuery);