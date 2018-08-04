<?php
    /*
    Template Name: Testing Submission Form
    */
?>
<?php
// Check if the form was submitted
if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] )) {

        // Do some minor form validation to make sure there is content
        if (isset ($_POST['name'])) { 
                $title =  $_POST['name']; 
        } else { 
                echo 'Please enter a name';
        }


        $listingemail = $_POST['listingemail'];
        $listingphone = $_POST['listingphone'];

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
                'post_type'        => 'registered-users'
                
        );
        $post_id = wp_insert_post($post);
        wp_set_post_terms($post_id,$type,'Type',true);
    add_post_meta($post_id, 'metatestemail', $listingemail, false);
    add_post_meta($post_id, 'metatestphone', $listingphone, false);
        wp_redirect( home_url('/listing-submitted/') ); // redirect to home page after submit
        exit();

            if ($_FILES) {
                foreach ($_FILES as $file => $array) {
                    $newupload = insert_attachment($file,$post_id);
                    // $newupload returns the attachment id of the file that
                    // was just uploaded. Do whatever you want with that now.
                }
        }
}
 // end IF

?>
<?php get_header() ?>

            <div id="container"> 
                <div id="content" role="main" style="padding: 20px 92px;">

                <h1 class="page-title">Register</h1>

<!--SUBMIT POST-->
                <form id="new_post" name="new_post" class="post_work" method="post" enctype="multipart/form-data">
                        <p><label for="title">Name</label><br />
                            <input type="text" id="name" class="required" value="" tabindex="1" size="20" name="name" />
                        </p>
                      

<!-- Listing Email --> 
                <fieldset class="listingemail"> 
                    <label for="listingemail">Your Email</label> 
                            <input type="text" value="" id="listingemail" tabindex="20" name="listingemail" /> 
                </fieldset>

<!-- Listing Phone --> 
                <fieldset class="listingphone"> 
                    <label for="listingphone">Your Phone</label> 
                    <input type="text" value="" id="listingphone" tabindex="20" name="listingphone" /> 
                </fieldset> 



                <p>Tags: <input type="text" value="" tabindex="35" name="post_tags" id="post_tags" /></p>
                <input type="hidden" name="post_type" id="post_type" value="domande" />
                <input type="hidden" name="action" value="post" />

                <p align="right"><input type="submit" value="Submit" tabindex="6" id="submit" name="submit" /></p>

                        <?php wp_nonce_field( 'new-post' ); ?>
            </form>

            <script>
                var multi_selector = new MultiSelector( document.getElementById( 'attachment_list' ), 8 );
                multi_selector.addElement( document.getElementById( 'attachment' ) );
            </script>

<!--SUBMIT POST END-->

            </div><!-- .content -->
        </div><!-- #container -->

<?php get_footer(); ?>