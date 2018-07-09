


<?php

get_header();

?>

<div class="row">
	<div class="col-12">&nbsp;</div></div>
	<div class="page-header">
  <h1>Categories</h1>
</div>
<div class="row">
	<div class="col-12">
<?php
// $a=get_post_meta(66);
// $args = array(
// 	'post_type'		=>	'wpdmpro',
// 	'meta_query'	=>	array(
// 		array(
// 			'key'=>'__wpdm_files',
// 			'value'	=>	'php_course_contents.txt',
// 			'compare' => 'LIKE',
// 		)
// 	)
// );
// $my_query = new WP_Query( $args );
// //var_dump($my_query);die;
// if( $my_query->have_posts() ) {
//   while( $my_query->have_posts() ) {
//     $my_query->the_post();
//  echo get_the_ID();
//   } // end while
// } // end if
// else
// echo "sorry";
// wp_reset_postdata();
// die;
// print_r($a);die;
// foreach ($a as $key => $value) {
// 	if($key=="__wpdm_files")
// 	{
// 	var_dump(unserialize($a[$key][0]));
// 	echo "<br>";
// 	}
// }
// //print_r(get_post_meta(66));
// die;
// print "<ul>";
// $a=get_post_meta(66);
// array_walk( $a, 'link_array_walker' );
// print "\n</ul>";
// die;


$taxonomy = 'doc_category';
$terms = get_terms($taxonomy, array("hide_empty" => false));
if ( $terms && !is_wp_error( $terms ) ) {

	foreach ( $terms as $term ) {

		$objects_ids=[];
	$cols_ids='';
		$objects = get_posts( array('post_type' => 'docs' , 'doc_category' => $term->slug) );

foreach ($objects as $object) {
	
    $objects_ids[] = $object->ID;
}

$collections = wp_get_object_terms( $objects_ids, 'doc_tag' );
foreach ($collections as $object) {
	if(count($collections)>1)
    $cols_ids.= $object->name.",";
else
	$cols_ids.= $object->name;
}

		?>
<div class="card">
  
  <div class="card-body">
    
    
    
  
		<?php

 		
		echo '<h5 class="card-title"><a class="card-link" href="' .get_term_link($term->slug, $taxonomy).'">'.$term->name.'&nbsp;<span class="badge badge-dark">'.count($objects_ids).'</span></a></h5>';
		
		echo '<p class="card-text"><i>Tags</i> : ' .$cols_ids.'</p>';
		
		echo '</div></div>';
		}
		
	}
else
{
	
	
}

?>

</div>
</div>
</body>
</html>