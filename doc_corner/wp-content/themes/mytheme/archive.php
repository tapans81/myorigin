<?php

    
get_header();


	?>
	<div class="row">
	<div class="col-12">&nbsp;</div></div>
<div class="row">
<div class="col-12">	

	<?php

$histories = [];

while (have_posts() ) {

	the_post();
	echo '<div class="card"><div class="card-body">';
	echo '<h5 class="card-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h5>';
	echo ' <h6 class="card-subtitle mb-2 text-muted">' .get_the_date().'</h6>';
	echo '<p class="card-text">' .get_the_content().'</p>';


echo do_shortcode("[wpdm_package id='".get_the_ID()."']");
echo "<button type='button' class='show_history' id='".get_the_ID()."' data-toggle='modal' data-target='#mymodal'>history</button>";
echo get_the_ID();
$history=user_download_history(get_the_ID(),get_current_user_id());
foreach ($history as $value) {
  $value->timestamp=date('Y-m-d H:i:s',$value->timestamp);
  //print_r($value);
  //echo "<br>";
}
//die;

array_push($histories, $history);

//var_dump(count($history));


echo "</div></div>";


}


?>
<div class="modal" id="mymodal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <!--  <div class="modal-header">
        <h5 class="modal-title">Downloads</h5>
        
      </div> -->
      <div class="modal-body">
        <p>Downloads</p>
       <table class="table">
        <thead>
          <tr>
            <th scope="col">Date</th>
            
          </tr>
        </thead>
        <tbody>
          </tbody>
      </table>
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  var mysdata = '<?php echo json_encode($histories); ?>';
</script>
</div>
</div>


<?php
get_footer();
?>