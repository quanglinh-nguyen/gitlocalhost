<?php
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');
if ( post_password_required() ) {
	echo '<p class="nocomments">This post is password protected. Enter the password to view comments.</p>';
	return;
}

echo '<div id="comments" class="comments-area">';
	if ( have_comments() ) :
		echo '<h2 class="comments-title">';
			echo '<span class="text-center mb-20">';
				echo __('Comment for','shtheme').' '.get_the_title() .' <span class="comments-number">'.number_format_i18n( get_comments_number() ).'</span>';
			echo '</span>';
		echo '</h2>';
	else: 
		echo '<h2 class="comments-title">';
			echo '<span class="text-center mb-20">';
				echo __('Comment for','shtheme').' '.get_the_title() .'';
			echo '</span>';
		echo '</h2>';
	endif;
	if ( ! comments_open() && get_comments_number() ) :
		echo '<p class="nocomments">'.__( 'Comments are closed.' , 'shtheme' ).'</p>';
	endif; 
	if ( have_comments() ) :
		echo '<ul class="comments-list">';
			wp_list_comments('type=comment&callback=uni_comment');
		echo '</ul>';
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
			echo '<nav id="comment-nav-below" class="navigation" role="navigation">';
				echo '<div class="nav-previous">';
					previous_comments_link( __( '&larr; previous', '' ) );
				echo '</div>';
				echo '<div class="nav-next">';
					next_comments_link( __( 'Next &rarr;', '' ) );
				echo '</div>';
			echo '</nav>';
		endif;
	endif; // have_comments()
	if ( comments_open() ) :
		echo '<div id="reviews">';
			echo '<div id="commentform">';
			    echo '<div class="cancel-comment-reply">';
			    	echo '<small>';
						cancel_comment_reply_link();
					echo '</small>';
			    echo '</div>';
			    if ( get_option('comment_registration') && !is_user_logged_in() ) :
                    echo '<h2 class="comments-title"><span>'.__('Leave a comment','shtheme').'</span></h2>';
			        echo '<p>'.__('You must be','shtheme').' <a href="'.wp_login_url( get_permalink() ).'">'.__('logged in','shtheme').'</a> '.__('to post a comment.','shtheme').'</p>';
			    else :
                    echo '<div id="review_form">';
                        echo '<form action="'.get_option('siteurl').'/wp-comments-post.php" method="post" id="commentformPost">';
						echo '<h2 class="comments-title commentform-title"><span class="title_comment">'.__('Leave a comment','shtheme').'</span></h2>';
                            if ( is_user_logged_in() ) :
                                echo '<p class="nameuser">'.__('Comment with the name:','shtheme').' <a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a></p> ';   
                            endif;
                            echo '<div class="form-group">';
                                echo '<textarea class="form-control" name="comment" id="comment" cols="50" rows="4" tabindex="4" placeholder="'.__('Add a comment...','shtheme').'" ></textarea>';
                            echo '</div>';
                            if( ! is_user_logged_in() ):   
                                echo '<div class="row">';
                                    echo '<div class="col-lg-6">';
                                        echo '<div class="form-group">';
                                            echo '<input class="form-control" type="text" name="author" id="author" value="'.esc_attr($comment_author).'" tabindex="1" aria-required="true" placeholder="'.__('Name','shtheme').' * " />';
                                        echo '</div>';
                                    echo '</div>';
                                    echo '<div class="col-lg-6">';
                                        echo '<div class="form-group">';
                                            echo '<input class="form-control" type="text" name="email" id="email" value="'.esc_attr($comment_author_email).'" size="22" tabindex="2" aria-required="true" placeholder="'.__('Email','shtheme').' * " />';
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                            endif;
                            echo '<div class="form-group">';
                                echo '<p class="comment-form-cookies-consent">';
									echo '<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" autocomplete="off" class="valid" aria-invalid="false"> <label for="wp-comment-cookies-consent">'.__('Save my name, email, and website in this browser for the next time I comment.','shtheme').'</label>';
								echo '</p>';
                            echo '</div>';
                            echo '<div class="form-btn">';
                                echo '<input class="btn text-uppercase" name="submit" type="submit" id="submit" tabindex="5" value="'.__('Post comment','shtheme').'" />';
                                comment_id_fields();
                            echo '</div>';
                            do_action('comment_form', $post->ID);
                        echo '</form>';
                    echo '</div>';
		        endif; 
				// If registration required and not logged in
		    echo '</div>';
	    echo '</div>';
	endif; 
	// if you delete this the sky will fall on your head
echo '</div>';
// #comments .comments-area