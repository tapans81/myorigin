<?php
get_header(); 

?>

<?php
echo "default page template<br>";

while ( have_posts() ) 
				{ 
				the_post();

			// if(is_page(get_the_ID()))
			// {
				echo "<br>";
				//the_title();
					echo "<br>";
					
					the_content();
			}	
get_footer();
?>
