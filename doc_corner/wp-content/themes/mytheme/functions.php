<?php

require_once('wp-bootstrap-navwalker-master/class-wp-bootstrap-navwalker.php');
/* Theme setup */
add_action( 'after_setup_theme', 'wpt_setup' );
    if ( ! function_exists( 'wpt_setup' ) ):
        function wpt_setup() {  
            register_nav_menu( 'primary', __( 'Primary navigation', 'wptuts' ) );
        } endif;

function wpt_register_js() {
	
   wp_register_script('custom_js', get_template_directory_uri() . '/js/mycustom.js', 'jquery');
	wp_register_script('popper.bootstrap.min', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js', 'jquery');

    wp_register_script('jquery.bootstrap.min', get_template_directory_uri() . '/bootstrap/dist/js/bootstrap.min.js', 'jquery');

     
}
add_action( 'init', 'wpt_register_js' );
//init
function wpt_enq_js() {
wp_enqueue_script('jquery');
wp_enqueue_script('popper.bootstrap.min');
    wp_enqueue_script('jquery.bootstrap.min');
    wp_enqueue_script('custom_js');
  }
add_action( 'wp_enqueue_scripts', 'wpt_enq_js' );

function wpt_register_css() {
    wp_register_style( 'bootstrap.min', get_template_directory_uri() . '/bootstrap/dist/css/bootstrap.min.css' );
    wp_register_style( 'main', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'bootstrap.min' );
    wp_enqueue_style( 'main' );
}
add_action( 'wp_enqueue_scripts', 'wpt_register_css' );


function create_posttype() {

  register_post_type( 'docs',
  
    array(
      'labels' => array(
        'name' => __( 'Docs' ),
        'singular_name' => __( 'Doc' ),
        'add_new_item'=>("Add new doc"),
        'edit_item'=>("Edit doc")
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'documents'),
      'exclude_from_search' => false,
      'supports'=> array('title','editor','author','thumbnail','tag'),
       'capability_type'     => array('doc_admin_cap','doc_admin_caps'),
                        'map_meta_cap'        => true,
    )
  );
}

 add_action( 'init', 'create_posttype' );

function create_book_taxonomies() {
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name'              => _x( 'Categories', 'taxonomy general name', 'textdomain' ),
    'singular_name'     => _x( 'Category', 'taxonomy singular name', 'textdomain' ),
    'search_items'      => __( 'Search categories', 'textdomain' ),
    'all_items'         => __( 'All Categories', 'textdomain' ),
    'parent_item'       => __( 'Parent category', 'textdomain' ),
    'parent_item_colon' => __( 'Parent category:', 'textdomain' ),
    'edit_item'         => __( 'Edit category', 'textdomain' ),
    'update_item'       => __( 'Update category', 'textdomain' ),
    'add_new_item'      => __( 'Add New category', 'textdomain' ),
    'new_item_name'     => __( 'New category Name', 'textdomain' ),
    'menu_name'         => __( 'Category', 'textdomain' ),
  );

  $args = array(
    //'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'public'=>true,
    'capabilities' => array (
                'manage_terms' => 'manage_categories', //by default only admin
                'edit_terms' => 'manage_doc_admin_caps',
                'delete_terms' => 'manage_doc_admin_caps',
                'assign_terms' => 'edit_doc_admin_caps' 
                ),
    // 'rewrite'           => array( 'slug' => 'category' ),
  );

  register_taxonomy( 'doc_category', array( 'docs' ), $args,1 );
}
add_action( 'init', 'create_book_taxonomies' );
//jshd
function create_tag_taxonomies() {
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name'              => _x( 'tags', 'taxonomy general name', 'textdomain' ),
    'singular_name'     => _x( 'tag', 'taxonomy singular name', 'textdomain' ),
    'search_items'      => __( 'Search tags', 'textdomain' ),
    'all_items'         => __( 'All tags', 'textdomain' ),
    'parent_item'       => __( 'Parent tag', 'textdomain' ),
    'parent_item_colon' => __( 'Parent tag:', 'textdomain' ),
    'edit_item'         => __( 'Edit tag', 'textdomain' ),
    'update_item'       => __( 'Update tag', 'textdomain' ),
    'add_new_item'      => __( 'Add New tag', 'textdomain' ),
    'new_item_name'     => __( 'New tag Name', 'textdomain' ),
    'menu_name'         => __( 'tag', 'textdomain' ),
  );

  $args = array(
    //'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'capabilities' => array (
                'manage_terms' => 'manage_categories', //by default only admin
                'edit_terms' => 'manage_doc_admin_caps',
                'delete_terms' => 'manage_doc_admin_caps',
                'assign_terms' => 'edit_doc_admin_caps' 
                ),
    // 'rewrite'           => array( 'slug' => 'category' ),
  );

  register_taxonomy( 'doc_tag', array( 'docs' ), $args,1 );
}
add_action( 'init', 'create_tag_taxonomies' );



// if( get_role('Doc_admin') ){
//       remove_role( 'Doc_admin' );
// }

 add_role('Doc_admin',
            'Documents Admin',
            array(
                'read' => true,
                'edit_posts' => true,
                'delete_posts' => true,
                'publish_posts' => true,
                'upload_files' => true,
                'manage_categories' =>true
            )
        );
  
  add_action('admin_init','psp_add_role_caps',999);
    function psp_add_role_caps() {
 
 // Add the roles you'd like to administer the custom post types
 $roles = array('Doc_admin','editor','administrator');
 
 // Loop through each role and assign capabilities
 foreach($roles as $the_role) { 
 
      $role = get_role($the_role);
 
              $role->add_cap( 'read' );
              $role->add_cap( 'read_doc_admin_caps');
              $role->add_cap( 'read_private_doc_admin_caps' );
              $role->add_cap( 'edit_doc_admin_caps' );
              $role->add_cap( 'edit_doc_admin_caps' );
              $role->add_cap( 'edit_others_doc_admin_caps' );
              $role->add_cap( 'edit_published_doc_admin_caps' );
              $role->add_cap( 'publish_doc_admin_caps' );
              $role->add_cap( 'delete_others_doc_admin_caps' );
              $role->add_cap( 'delete_private_doc_admin_caps' );
              $role->add_cap( 'delete_published_doc_admin_caps' );
              //$role->add_cap( 'manage_doc_admin_caps' );
 
 } 
}

function my_login_logo_one() { 
?> 
<style type="text/css"> 
body.login div#login h1 a {
background-image: url(http://lorempixel.com/600/600); 
padding-bottom: 30px; 
} 
</style>
<?php 
} add_action( 'login_enqueue_scripts', 'my_login_logo_one' );

function is_user_downloaded($pid, $uid){
    global $wpdb;
    $uid = (int)$uid;
    $pid = (int)$pid;
    $ret = $wpdb->get_var("select uid from {$wpdb->prefix}ahm_download_stats where uid='$uid' and pid = '$pid'");
    if($ret && $ret == $uid) return true;
    return false;
}
function user_download_history($pid, $uid){
    global $wpdb;
    $uid = (int)$uid;
    $pid = (int)$pid;
    $ret = $wpdb->get_results("select * from {$wpdb->prefix}ahm_download_stats where uid='$uid' and pid = '$pid'");
    // if($ret) return $ret;
    // return false;
    return $ret;
}

?>