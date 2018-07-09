 <html>
<head>

<?php 


 wp_head(); 
?>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="<?php bloginfo('url')?>">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <?php /* Primary navigation */
 wp_nav_menu( array(
   //'menu' => 'top_menu',
    'theme_location'  => 'primary',
  'depth'           => 2, // 1 = no dropdowns, 2 = with dropdowns.
  'container'       => 'div',
  //'container_class' => 'collapse navbar-collapse',
  //'container_id'    => 'bs-example-navbar-collapse-1',
  'menu_class'      => 'navbar-nav mr-auto',
  'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
  //Process nav menu using our custom nav walker
  'walker' => new wp_bootstrap_navwalker())
);

//wp_nav_menu( array( 'theme_location' => 'primary' ) );
?>
   
  </div>
</nav>
<div class="container">
    
 
