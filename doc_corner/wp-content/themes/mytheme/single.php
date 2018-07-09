<?php
get_header();
?>
<div class="row">
	<div class="col-12">&nbsp;</div></div>
<div class="row">
<div class="col-12">
<?php
while ( have_posts() ) :
				the_post();
				echo '<div class="card"><div class="card-body">';
	echo '<h5 class="card-title">'.get_the_title().'</h5>';
	echo ' <h6 class="card-subtitle mb-2 text-muted">' .get_the_date().'</h6>';
	echo '<p class="card-text">' .get_the_content().'</p>';

	echo '</div></div>';
				endwhile;
?>
</div>
</div>
<?php
get_footer();
?>