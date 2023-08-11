<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage morekoren
 * @since morekoren 1.0
 */

get_header(); ?>

<div class="main">

    <div class="inner_banner dflex bgset"
        style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/site/ban_bg.jpg);">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/site/green_layer.png" alt="">
        <?php the_archive_title( '<h1><u>', '</u></h1>' ); ?>
    </div>

    <?php
	if ( have_posts() ) {
		echo '<div class="building_community building_community_inner">';
        echo '<div class="wrapper dflex">';

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