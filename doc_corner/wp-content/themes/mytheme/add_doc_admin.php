<?php
/**
 * Plugin Name: Add Document User
  */
function add_doc_admin_activate() {
 add_role('Doc_admin',
            'Documents Admin',
            array(
                'read' => true,
                'edit_posts' => true,
                'delete_posts' => true,
                'publish_posts' => true,
                'upload_files' => true,
            )
        );
   }
   register_activation_hook( __FILE__, 'add_doc_admin_activate' );
   ?>