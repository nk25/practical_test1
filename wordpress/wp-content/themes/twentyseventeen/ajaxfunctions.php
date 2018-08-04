<?php
require_once getenv('ABSPATH') .'/wp-load.php';
require_once get_template_directory(). '/third_party/vendor/autoload.php';

global $wpdb;
if (isset($_POST['action']) && $_POST['action'] == 'registers') {
        // Do some minor form validation to make sure there is content
        if (isset ($_POST['name'])) { 
                $title =  $_POST['name']; 
        } else { 
                echo 'Please enter a name';
        }


        $listingemail = $_POST['email'];
        $listingphone = $_POST['phone'];

        // Add the content of the form to $post as an array
        $type = trim($_POST['Type']);
        $post = array(
                'post_title'    => $title,
                'post_content'  => $description,
                'post_category' =>   array($_POST['cat']),  // Usable for custom taxonomies too 
                'post_status'   => 'pending',                     // Choose: publish, preview, future, etc.
                'tags_input'    => array($tags),
                'tax_input'    => array( $type),
                'comment_status' => 'closed',
                'post_author' => '2',
                'listingemail'    =>   $listingemail,
                'listingphone'    =>   $listingphone,
            
                
        );
        $post_id = wp_insert_post($post);
        wp_set_post_terms($post_id,$type,'Type',true);
    add_post_meta($post_id, 'metatestemail', $listingemail, false);
    add_post_meta($post_id, 'metatestphone', $listingphone, false);
   
        exit();

            if ($_FILES) {
                foreach ($_FILES as $file => $array) {
                    $newupload = insert_attachment($file,$post_id);
                    // $newupload returns the attachment id of the file that
                    // was just uploaded. Do whatever you want with that now.
                }
        }

}