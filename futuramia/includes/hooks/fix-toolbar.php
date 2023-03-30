<?php
add_action( 'wp_head', 'fix_toolbar_for_sticky_header' );
function fix_toolbar_for_sticky_header() {
    if( is_admin_bar_showing() ) :
        echo '
            <style>
                .site-header{
                    top: 32px;
                }
                @media screen and (max-width: 782px) {
                    .site-header {
                        top: 46px;
                    }
                }
            </style>
        ';
    endif;
}