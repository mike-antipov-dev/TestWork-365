<?php

class Add_Product_Front {

    public static function form() { 
        ?>
        <form id="new_post" name="new_post" method="post" enctype="multipart/form-data">
            <p><label for="title">Product name</label><br />
                <input type="text" id="title" value="" tabindex="1" size="20" name="title" />
            </p>
            <p><label for="title">Product price</label><br />
                <input type="number" id="price" value="" tabindex="1" size="20" name="price" />
            </p>
            <p>
                <label for="product_type">Product type</label><br>
                <select id="custom_product_type" name="product_type">
                    <optgroup label="Product Type">
                        <option value="" disabled selected="selected">Select type</option>
                        <option value="rare">Rare</option>
                        <option value="frequent">Frequent</option>
                        <option value="unusual">Unusual</option>
                    </optgroup>
                </select>
            </p>
            <p><label for="title">Product image</label><br />
                <input type="file" id="image" value="" tabindex="1" size="20" name="image" />
            </p>
            <p><input type="submit" value="Publish" tabindex="6" id="submit" name="submit" /></p>
        </form>
        <?php
    }

    public static function save() {

        if ( !function_exists( 'wp_generate_attachment_metadata' ) ) {
            require_once( ABSPATH . "wp-admin" . '/includes/image.php' );
            require_once( ABSPATH . "wp-admin" . '/includes/file.php' );
            require_once( ABSPATH . "wp-admin" . '/includes/media.php' );
        }

        if ( isset ( $_POST['title'] ) ) {
            $new_post = array( 
                            'post_title' => $_POST['title'],
                            'post_status' => 'publish',
                            'post_name' => preg_replace('/\W+/', '-', strtolower($_POST['title'])),
                            'post_type' => 'product',
                         );

            $pid = wp_insert_post( $new_post );

            if( !is_wp_error( $pid ) ) {
                add_post_meta( 
                    $pid,
                    'product_type',
                    $_POST['product_type']
                );
                add_post_meta( 
                    $pid,
                    '_price',
                    $_POST['price']
                );
                add_post_meta( 
                    $pid,
                    '_regular_price',
                    $_POST['price']
                );
            } else {
                wp_die( $pid, $pid );
            }

            $attach_id = media_handle_upload(  'image', $pid  );
            
            if( !is_wp_error( $attach_id ) ) {
                update_post_meta( $pid, '_thumbnail_id', $attach_id );
                $image_url = wp_get_attachment_url($attach_id);
                add_post_meta( 
                    $pid,
                    'custom_pic',
                    $image_url
                );
                echo('<script>alert("Product was added successfuly")</script>');
            } else {
                wp_die( $attach_id, $attach_id );
            }

        }
    }

    /** Init */
    public static function init() {
        add_shortcode( 'front_product_form', [self::class, 'form'] );
        add_shortcode( 'front_product_save', [self::class, 'save'] );
    }

}