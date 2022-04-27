<?php

class Add_Product_Front {

    public static function form() { 
        ?>
        <form id="new_post" name="new_post" method="post">

        <p><label for="title">Title</label><br />
            <input type="text" id="title" value="" tabindex="1" size="20" name="title" />
        </p>

        <p align="right"><input type="submit" value="Publish" tabindex="6" id="submit" name="submit" /></p>

        </form>
        <?php
    }

    public static function save() {

        if ( isset ( $_POST['title'] ) ) {
            echo 'hello';
        }
        // if( is_user_logged_in(  ) ) {

        //     if( isset( $_POST['ispost'] ) )
        //     {
        //         global $current_user;
        //         get_currentuserinfo();

        //         $user_login = $current_user->user_login;
        //         $user_email = $current_user->user_email;
        //         $user_firstname = $current_user->user_firstname;
        //         $user_lastname = $current_user->user_lastname;
        //         $user_id = $current_user->ID;

        //         $post_title = $_POST['title'];
        //         $sample_image = $_FILES['sample_image']['name'];
        //         $post_content = $_POST['sample_content'];
        //         $category = $_POST['category'];

        //         $new_post = array( 
        //             'post_title' => $post_title,
        //             'post_content' => $post_content,
        //             'post_status' => 'pending',
        //             'post_name' => 'pending',
        //             'post_type' => $post_type,
        //             'post_category' => $category
        //          );

        //         $pid = wp_insert_post( $new_post );
        //         add_post_meta( $pid, 'meta_key', true );

        //         if ( !function_exists( 'wp_generate_attachment_metadata' ) )
        //         {
        //             require_once( ABSPATH . "wp-admin" . '/includes/image.php' );
        //             require_once( ABSPATH . "wp-admin" . '/includes/file.php' );
        //             require_once( ABSPATH . "wp-admin" . '/includes/media.php' );
        //         }
        //         if ( $_FILES )
        //         {
        //             foreach ( $_FILES as $file => $array )
        //             {
        //                 if ( $_FILES[$file]['error'] !== UPLOAD_ERR_OK )
        //                 {
        //                     return "upload error : " . $_FILES[$file]['error'];
        //                 }
        //                 $attach_id = media_handle_upload(  $file, $pid  );
        //             }
        //         }
        //         if ( $attach_id > 0 )
        //         {
        //             //and if you want to set that image as Post then use:
        //             update_post_meta( $pid, '_thumbnail_id', $attach_id );
        //         }

        //         $my_post1 = get_post( $attach_id );
        //         $my_post2 = get_post( $pid );
        //         $my_post = array_merge( $my_post1, $my_post2 );

        //     }
        // } else
        // {
        //     echo "<h2 style='text-align:center;'>User must be logged in for add post!</h2>";
        // }
    }

    /** Init */
    public static function init() {
        add_shortcode( 'front_product_form', [self::class, 'form'] );
        add_shortcode( 'front_product_save', [self::class, 'save'] );
    }

}