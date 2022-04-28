<?php

class Add_Custom_Admin_Fields {

    private $product_meta;

    /** Add meta boxes */
    public static function add() {
        add_meta_box (
            'cutom_pic',
            'Custom pic',
            [ self::class, 'pic_html' ],
            'product',
            'side'
        );

        add_meta_box (
            'time_created',
            'Time created',
            [ self::class, 'time_html' ],
            'product',
            'side'
        );

        add_meta_box (
            'product_type',
            'Product type',
            [ self::class, 'type_html' ],
            'product',
            'side'
        );

        add_meta_box (
            'clear_btn',
            'Clear custom fields',
            [ self::class, 'clear_html' ],
            'product',
            'side'
        );
    }

    /** Render functions */
    public static function pic_html( $post ) {
        $product_meta = get_post_meta( $post->ID );
        ?>
        <p class="form-group">
            <input type="text" class="form-control" name="custom_pic" id="custom_pic" value="<?php if ( isset ( $product_meta['custom_pic'] ) ) echo $product_meta['custom_pic'][0]; ?>" readonly />
        </p>
        <p class="form-group">
            <input type="button" id="custom_pic_button" class="button" value="<?php _e( 'Choose or Upload an Image', 'prfx-textdomain' )?>" />
        </p>
        <p class="form-group">
            <button class="button button-danger button-large" id="remove_pic">Remove</button>
        </p>
        <?php
    }

    public static function time_html( $post ) {
        $product_meta = get_post_meta( $post->ID );
        ?>
        <p class="form-group">
            <input type="date" readonly value="<?php echo substr($post->post_date, 0, 10) ?>">
        </p>
        <?php
    }

    public static function type_html( $post ) {
        $product_meta = get_post_meta( $post->ID );
        ?>
        <select id="custom_product_type" name="product_type">
            <optgroup label="Product Type">
                <option value="" disabled selected="selected">Select type</option>
                <option value="rare" <?php if ( isset ( $product_meta['product_type'] ) && $product_meta['product_type'][0] == 'rare' ) echo 'selected="selected"'; ?>>Rare</option>
                <option value="frequent" <?php if ( isset ( $product_meta['product_type'][0] ) && $product_meta['product_type'][0] == 'frequent' ) echo 'selected="selected"'; ?>>Frequent</option>
                <option value="unusual" <?php if ( isset ( $product_meta['product_type'][0] ) && $product_meta['product_type'][0] == 'unusual' ) echo 'selected="selected"'; ?>>Unusual</option>
            </optgroup>
        </select>
        <?php
    }

    public static function clear_html() {
        ?>
        <p class="form-group">
            <button class="button button-danger button-large" id="clear_custom">Clear</button>
        </p>
        <?php
    }

    /** Saving values */
    public static function save( $post ) {
        if ( isset( $_POST[ 'custom_pic' ] ) ) {
            // Save custom pic to custom meta
            update_post_meta(
                $post,
                'custom_pic',
                $_POST['custom_pic']
            );
            // Retrieve its ID and attach to a product
            $media_id = attachment_url_to_postid($_POST['custom_pic']);
            $res = update_post_meta(
                $post,
                '_thumbnail_id',
                $media_id
            );
        }

        if ( isset( $_POST[ 'product_type' ] ) ) {
            update_post_meta(
                $post,
                'product_type',
                $_POST['product_type']
            );
        }
    }

    /** Enqueue scripts/styles */
    public static function enqueue() {
        wp_enqueue_script( 'admin', plugin_dir_url( __FILE__ ) . 'assets/apf_admin.js', 'jquery', '1.0');
    }

    /** Init */
    public static function init () {
        add_action( 'admin_init', [ self::class, 'add' ] );
        add_action( 'admin_enqueue_scripts', [ self::class, 'enqueue' ] );
        add_action( 'save_post', [ self::class, 'save' ] );
    }
    
}