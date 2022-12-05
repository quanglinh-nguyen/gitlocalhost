/*******
Author Uni Creation
*********/
// JavaScript Document
(function($) {
    $(document).ready(function(){
        $( '#result_pagination' ).on( 'click',' ul.pagination_post a', function( e ) {
            /** Prevent Default Behaviour */
            e.preventDefault();
            /** Get data-page */
            var data_page = $(this).attr( 'data-page' );
                posts_per_page = $('.ajax_pagination').attr( 'posts_per_page' );
                post_type = $('.ajax_pagination').attr( 'post_type' );
                categories = $('.ajax_pagination').attr( 'categories' );
                taxonomy = $('.ajax_pagination').attr( 'taxonomy' );
                category = $('.ajax_pagination').attr('cat');
                post_thumb = $('.ajax_pagination').attr('post_thumb');
                post_category = $('.ajax_pagination').attr('post_category');
                post_desc = $('.ajax_pagination').attr('post_desc');
                post_meta = $('.ajax_pagination').attr('post_meta');
                post_link = $('.ajax_pagination').attr('post_link');
                number_character = $('.ajax_pagination').attr('number_character');
                height = jQuery('.site-header').height();
            /** Ajax Call */
            $.ajax({
                cache: false,
                timeout: 8000,
                url: uni_array_ajaxp.url,
                type: "POST",
                data: ({ 
                    action			    : 'LoadPostsPagination', 
                    data_page		    : data_page,
                    posts_per_page	    : posts_per_page,
                    taxonomy		    : taxonomy,
                    categories		    : categories,
                    post_type		    : post_type,
                    post_thumb          : post_thumb,
                    post_category       : post_category,
                    post_desc           : post_desc,
                    post_meta           : post_meta,
                    post_link        : post_link,
                    number_character    : number_character,
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
                    $("html, body").animate({ scrollTop: $( '#recruitment' ).offset().top - 100 }, "slow");
                }
            });
        });
    });
})(jQuery);