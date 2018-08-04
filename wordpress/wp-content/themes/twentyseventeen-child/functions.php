<?php
function custom_post_type() {
 
// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Events', 'Post Type General Name', 'twentyseventeen-child' ),
        'singular_name'       => _x( 'Event', 'Post Type Singular Name', 'twentyseventeen-child' ),
        'menu_name'           => __( 'Event', 'twentyseventeen-child' ),
        'parent_item_colon'   => __( 'Parent Events', 'twentyseventeen-child' ),
        'all_items'           => __( 'All Events', 'twentyseventeen-child' ),
        'view_item'           => __( 'View Event', 'twentyseventeen-child' ),
        'add_new_item'        => __( 'Add New Event', 'twentyseventeen-child' ),
        'add_new'             => __( 'Add New', 'twentyseventeen-child' ),
        'edit_item'           => __( 'Edit Event', 'twentyseventeen-child' ),
        'update_item'         => __( 'Update Event', 'twentyseventeen-child' ),
        'search_items'        => __( 'Search Event', 'twentyseventeen-child' ),
        'not_found'           => __( 'Not Found', 'twentyseventeen-child' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentyseventeen-child' ),
    );
     
// Set other options for Custom Post Type
     
    $args = array(
        'label'               => __( 'Events', 'twentyseventeen-child' ),
        'description'         => __( 'Event news and reviews', 'twentyseventeen-child' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'taxonomies'          => array( 'genres' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
     
    // Registering your Custom Post Type
    register_post_type( 'Events', $args );
 
} 
add_action( 'init', 'custom_post_type', 0 );

$args = array(
  'labels'	=>	array(
						'all_items' => 	'Regsitered Users',
						'menu_name'	=>	'Regsitered Users',
						'singular_name' =>	'Regsitered User',
					 	'edit_item' =>	'Edit User',
					 	'new_item'  =>	'New User',
					 	'view_item' =>	'View User',
					 	'items_archive' =>	'User Achrive',
					 	'search_items'  =>	'Search Regsitered Users',
					 	'not_found'	    =>	'No Regsitered Users found.',
					 	'not_found_in_trash'  => 'No Regsitered Users found in trash.'
					),
	'supports'      =>array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields' ),				
	'show_in_menu'  =>	'edit.php?post_type=events', // This is where we tell WordPress to add 'Regsitered Users' as a submenu
	'public'		    =>	true
);
register_post_type( 'registered-users', $args );






// sidebar function
add_action( 'widgets_init', 'child_register_sidebar' );
function child_register_sidebar(){
    register_sidebar(array(
        'name' => 'Custom Sidebar',
        'id' => 'sidebar-10',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));
}

function twentyseventeen_child_script_enqueue() {
wp_register_script( 'custom_js', get_template_directory_uri() . '/js/jquery.custom.js', array( 'jquery' ), '1.0', TRUE );
wp_enqueue_script( 'custom_js',TRUE );
wp_register_script( 'validation', 'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js', array( 'jquery' ) );
wp_enqueue_script( 'validation' );

}
add_action( 'wp_enqueue_scripts', 'twentyseventeen_child_script_enqueue');

add_action('wp_ajax_my_special_action', 'my_action_callback');
add_action('wp_ajax_nopriv_my_special_action', 'my_action_callback');
function my_action_callback() {

        // Do some minor form validation to make sure there is content
      if (isset ($_POST['name'])) {
                $title =  $_POST['name'];
        } else {
                echo 'Please enter a title';
        }
 
        
        $listingemail = $_POST['email'];
        $listingphone = $_POST['phone'];
 
        // Add the content of the form to $post as an array
        $post = array(
                'post_title'    => $title,
                'post_status'   => 'pending',                     // Choose: publish, preview, future, etc.
                'comment_status' => 'closed',
                'post_author' => '10',
                'listingemail'    =>   $listingemail,
                'listingphone'    =>   $listingphone,
                'post_type'    =>   'registered-users',

        );
        $post_id = wp_insert_post($post);

        wp_set_post_terms($post_id,$type,'Type',true);
        add_post_meta($post_id, 'metatestemail', $listingemail, false);
        add_post_meta($post_id, 'metatestphone', $listingphone, false);
        if ($post_id) {
        	# code...
        	$res = "registered";
        	 echo json_encode($res);
        }
        exit();

}
// shortcode to display all the registered users in the table
add_shortcode('registered_users', 'registered_users_Function');
function registered_users_Function() {

global $post;
	global $i;
			$args = array(
				"post_type" => "registered-users",
				"post_status" => "publish",
				'posts_per_page' => -1
				);
			$myposts = get_posts($args);
			 $i=0;
			foreach($myposts as $post):
			setup_postdata($post);
   
			  if ($i % 2 == 0)
			  {
			    $class='';
			  }
			  else
			  {
			     $class='pull-right';
			  }
			  $i++;

			$id = $post->ID;
			$post_content = get_the_content();
			$sr_img = get_the_post_thumbnail_url();
			$postTitle = get_the_title();
			
		    
			echo '<li>'.$postTitle.'</li>';
			endforeach; 

			wp_reset_postdata();
$cont = ob_get_contents();
ob_get_clean();
return $cont;
}
add_action('admin_menu', 'register_my_custom_submenu_page');
function register_my_custom_submenu_page() {
  add_submenu_page( 'edit.php?post_type=events', 'My Custom Submenu Page', 'Registered-users', 'manage_options', 'my-custom-submenu-page', 'my_custom_submenu_page_callback' ); 
}
function my_custom_submenu_page_callback() {
	echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
		echo '<h2>Regsitered Users</h2>';
		echo do_shortcode('[registered_users]');
	echo '</div>';
}