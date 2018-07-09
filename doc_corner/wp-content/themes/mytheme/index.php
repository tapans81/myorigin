


<?php

get_header();

//echo do_shortcode('[wpdm_tree"]

//');

?>
<div class="row">

	<div class="col-12">&nbsp;</div></div>
	<div class="page-header">
  <h1>Categories</h1>
</div>
<div class="row">
	<div class="col-12">
<?php


$taxonomy = 'wpdmcategory';
$terms = get_terms($taxonomy, array("hide_empty" => false));
if ( $terms && !is_wp_error( $terms ) ) {

	foreach ( $terms as $term ) {

		$objects_ids=[];
	$cols_ids='';
		$objects = get_posts( array('post_type' => 'wpdmpro' , 'wpdmcategory' => $term->slug) );

foreach ($objects as $object) {
	
    $objects_ids[] = $object->ID;
}


		?>
<div class="card">
  
  <div class="card-body">
    
    
    
  
		<?php

 		
		echo '<h5 class="card-title"><a class="card-link" href="' .get_term_link($term->slug, $taxonomy).'">'.$term->name.'&nbsp;</a></h5>';
		
		
		
		echo '</div></div>';
		}
		
	}
else
{
	
	
}

?>

</div>
</div>

<?php
get_footer();
?>