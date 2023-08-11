<?php
	/**
	 * The main template file.
	 *
	 * This is the most generic template file in a WordPress theme
	 * and one of the two required files for a theme (the other being style.css).
	 * It is used to display a page when nothing more specific matches a query.
	 * E.g., it puts together the home page when no home.php file exists.
	 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
	 *
	 * @package morekoren
	 */
	
get_header(); ?>

<div class="main">

    <?php if ( is_home() && ! is_front_page() && ! empty( single_post_title( '', false ) ) ) : ?>
    <div class="inner_banner dflex bgset"
        style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/site/ban_bg.jpg);">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/site/green_layer.png" alt="">
        <h1><u><?php single_post_title(); ?></u></h1>
    </div>
    <?php endif; ?>

    <?php
	if ( have_posts() ) {
		echo '<div class="building_community building_community_inner">';
        echo '<div class="lazyload wrapper dflex">';

		echo $GLOBALS['wp_query']->request;
		// Load posts loop.
		while ( have_posts() )  : the_post();

			get_template_part( 'template-parts/posts/post', 'grid' );
			
		endwhile;

		echo '</div>';
        echo '<div class="lazyload-readmore"><a href="javascript:void(0)" class="read_more">'.__('טוענים עוד כתבות בשבילכם','morekoren').'</a>';
    	echo '</div>';

	} else {

		// If no content, include the "No posts found" template.
		get_template_part( 'template-parts/posts/post-none' );

	}
	?>

</div>

<?php get_footer();