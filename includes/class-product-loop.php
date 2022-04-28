<?php

class Show_Product_Loop {

    /** Custom query for showing products */
    public static function show() {
        $args = [
            'post_type' => 'product',
            'posts_per_page' => 12
        ];
        $the_query = new WP_Query( $args );
        if ( $the_query->have_posts() ) {
            echo '<ul>';
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                wc_get_template_part( 'content', 'product' );
            }
            echo '</ul>';
        } else {
            echo('No products found');
        }
        wp_reset_postdata();
    }

    /** Init */
    public static function init() {
        add_shortcode( 'show', [self::class, 'show'] );
    }

}
