<?php get_header(); ?>

<div id="page_content" class="site-content" tabindex="-1">
	<main id="main" class="site-main" role="main">
		
		<?php
		if ( have_posts() ) {
			
			if ( have_rows( 'page_content' ) ) {
				while ( have_rows( 'page_content' ) ) { the_row();
					get_template_part( 'template-parts/page/content', get_row_layout() );
				}
				
			} else {
				echo '<div class="page-inner def-page">';
				echo '<div class="container">';
					the_title( '<h1>', '</h1>' );
					the_content();
				echo '</div>';
				echo '</div>';
			}
			
		}
		?>
	</main>
</div>

<?php get_footer(); ?>