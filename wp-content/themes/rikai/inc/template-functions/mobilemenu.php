<?php
/**
 * Mobile Menu
 * @package Uni_Theme
 * @author  
 * @license 
 * @link    
 */

function uni_create_menu_mobile(){
    if(wp_is_mobile()) {
        ?>
        <nav id="mobilenav" class="d-lg-none">
            <div class="mobilenav__inner">
                <div class="h90 ">
                    <div class="logo_mb">
						<?php display_logo();?>
					</div>
                    <div class="menu_close">
                        <div class="showmenu-cross"><span></span><span></span></div>
                    </div>
                </div>
                <?php 
                if ( has_nav_menu( 'menu-mobile' ) ) {
                    wp_nav_menu( array(
                        'theme_location'    => 'menu-mobile', 
                        'menu_id'           => 'menu-main', 
                        'menu_class'        => 'mobile-menu',
                    ) );
                }
                ?>
            </div>
        </nav>
        <div class="panel-overlay"></div>
        <?php
    }
}
add_action( 'before_header','uni_create_menu_mobile' );