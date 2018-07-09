<?php

require_once('wp-bootstrap-navwalker-master/class-wp-bootstrap-navwalker.php');
/* Theme setup */
add_action( 'after_setup_theme', 'wpt_setup' );
    if ( ! function_exists( 'wpt_setup' ) ):
        function wpt_setup() {  
            register_nav_menu( 'primary', __( 'Primary navigation', 'wptuts' ) );
        } endif;

function wpt_register_js() {
	wp_enqueue_script('jquery');
	wp_register_script('popper.bootstrap.min', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js', 'jquery');

    wp_register_script('jquery.bootstrap.min', get_template_directory_uri() . '/bootstrap-4.1.1-dist/js/bootstrap.min.js', 'jquery');
     wp_enqueue_script('popper.bootstrap.min');
    wp_enqueue_script('jquery.bootstrap.min');

}
add_action( 'init', 'wpt_register_js' );
function wpt_register_css() {
    wp_register_style( 'bootstrap.min', get_template_directory_uri() . '/bootstrap-4.1.1-dist/css/bootstrap.min.css' );
    wp_enqueue_style( 'bootstrap.min' );
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
// add_action( 'after_switch_theme', 'flush_rewrite_rules' );
// function myplugin_flush_rewrites() {
//   // call your CPT registration function here (it should also be hooked into 'init')
//   create_posttype();
//   flush_rewrite_rules();
// }
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
//file
function ibenic_download_file(){
   
  if( isset( $_GET["attachment_id"] ) && isset( $_GET['download_file'] ) ) {
    ibenic_send_file();
  }
}
add_action('init','ibenic_download_file');

function ibenic_send_file(){
  //get filedata
  $attID = $_GET['attachment_id'];
  $theFile = wp_get_attachment_url( $attID );
  
  if( ! $theFile ) {
    return;
  }
  //clean the fileurl
  $file_url  = stripslashes( trim( $theFile ) );
  //get filename
  $file_name = basename( $theFile );
  //get fileextension
 
  $file_extension = pathinfo($file_name);
  //security check
  $fileName = strtolower($file_url);
  
  //$whitelist = apply_filters( "ibenic_allowed_file_types", array('png', 'gif', 'tiff', 'jpeg', 'jpg','bmp','svg') );
  
  // if(!in_array(end(explode('.', $fileName)), $whitelist))
  // {
  //   exit('Invalid file!');
  // }
  // if(strpos( $file_url , '.php' ) == true)
  // {
  //   die("Invalid file!");
  // }
 
  $file_new_name = $file_name;
  $content_type = "";
  //check filetype
  switch( $file_extension['extension'] ) {
    case "png": 
      $content_type="text/*"; 
      break;
    case "pdf": 
      $content_type="application/pdf"; 
      break;
    case "gif": 
      $content_type="image/gif"; 
      break;
    case "tiff": 
      $content_type="image/tiff"; 
      break;
    case "jpeg":
    case "jpg": 
      $content_type="image/jpg"; 
      break;
    default: 
      $content_type="application/force-download";
  }
  
  //$content_type = apply_filters( "ibenic_content_type", $content_type, $file_extension['extension'] );
  
  header("Expires: 0");
  header("Cache-Control: no-cache, no-store, must-revalidate"); 
  header('Cache-Control: pre-check=0, post-check=0, max-age=0', false); 
  header("Pragma: no-cache"); 
  header("Content-type: {$content_type}");
  header("Content-Disposition:attachment; filename={$file_new_name}");
  header("Content-Type: application/force-download");
   
  readfile("{$file_url}");
  exit();
}

function link_array_walker( &$item, $key, $indent = 1 )
{
    printf(
        '%1$s<li><a href="%2$s">%3$s</a>',
        "\n" . str_repeat( "\t", $indent ),
        $item['__wpdm_files']
        //$item['title']
    );

    if ( ! empty ( $item['children'] ) )
    {
        print "\n" . str_repeat( "\t", $indent + 1 ) . '<ul>';
        array_walk( $item['children'], __FUNCTION__, $indent + 2 );
        print "\n" . str_repeat( "\t", $indent + 1 ) . "</ul>\n" . str_repeat( "\t", $indent );
    }
    print '</li>';
}
//file ends
?>