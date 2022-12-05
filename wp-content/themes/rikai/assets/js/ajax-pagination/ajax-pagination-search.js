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
            var data_page       = $(this).attr( 'data-page' );
            var keyword         = $('.ajax_pagination').attr( 'keyword' );
            var posts_per_page  = $('.ajax_pagination').attr( 'posts_per_page' );
            var post_type       = $('.ajax_pagination').attr( 'post_type' );
            var height          = $('#masthead').height();
            /** Ajax Call */
            $.ajax({
                cache: false,
                timeout: 8000,
                url: uni_array_ajaxp.url,
                type: "POST",
                data: ({ 
                    action			:	'LoadSearchPostPagination', 
                    data_page		:	data_page,
                    keyword	        :	keyword,
                    posts_per_page  :   posts_per_page,
                    post_type		:	post_type,
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