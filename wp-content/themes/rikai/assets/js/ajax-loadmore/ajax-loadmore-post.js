jQuery(document).ready(function() {
    // Load more post index
    var paged = 1;
    jQuery("body").on("click",'#ButtonLoadMore',function(){
        var posts_per_page  = jQuery(this).attr('posts_per_page');
            taxonomy        = jQuery(this).attr('taxonomy');
            category        = jQuery(this).attr('category');
            post_type       = jQuery(this).attr('post_type');
            post_thumb      = jQuery(this).attr('post_thumb');
            post_category   = jQuery(this).attr('post_category');
            post_desc       = jQuery(this).attr('post_desc');
            post_meta       = jQuery(this).attr('post_meta');
            post_link    = jQuery(this).attr('post_link');
            number_character = jQuery(this).attr('number_character');
        paged++;
        jQuery.ajax({
            type: "POST",
            dataType: "json",
            url: uni_array_ajaxp.url,
            data: ({
                action              : 'readmore_post_ajax',
                taxonomy            : taxonomy,
                category            : category,
                post_type           : post_type,
                paged               : paged,
                posts_per_page      : posts_per_page,
                post_thumb          : post_thumb,
                post_category       : post_category,
                post_desc           : post_desc,
                post_meta           : post_meta,
                post_link        : post_link,
                number_character    : number_character,
            }),
            beforeSend: function() {
                jQuery("#ButtonLoadMore").addClass('loading');
            },
            success: function(data){
                var $data = jQuery(data.content);
                if($data.length){
                    jQuery($data).hide().appendTo('#ajaxPosts-wrap').fadeIn('slow');
                    if($data.length < posts_per_page) {
                        jQuery("#ButtonLoadMore").hide();
                    } else {
                        jQuery("#ButtonLoadMore").show();
                    }
                } else {
                    jQuery("#ButtonLoadMore").hide();
                }
            },
            complete: function() {
                jQuery("#ButtonLoadMore").removeClass('loading');
            },
        });
        return false;
    });

});