<?php include STYLESHEETPATH . '/custom-header.php';	 ?>

	<?php 
	
	if( have_posts() ):
		
		while( have_posts() ): the_post(); ?>
			
			<p><?php the_content(); ?></p>
			
			<h3><?php the_title(); ?></h3>
			
			<hr>
		
		<?php endwhile;
		
	endif;
			
	?>

