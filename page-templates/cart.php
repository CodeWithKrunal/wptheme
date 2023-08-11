<?php
/**
 * Template Name: Cart Page
 *
 * @package WordPress
 * @subpackage Medicom
 * @since Medicom 1.0
 */
get_header();?>

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

<?php 
    $radiates_background    = get_field('radiates_background');
    $radiates_title         = get_field('radiates_title');
    $radiates_content       = get_field('radiates_content');

    if ($radiates_background) {
        $radiates_background = $radiates_background['url'];
    }else{
        $radiates_background = "";
    }

    if ($radiates_background || $radiates_content) { ?>
        <!-- good to know section start -->
        <section class="radiates_blog inner-radiates-blog" style="background-image:url(<?php echo $radiates_background; ?>) ;">
            <div class="wrapper">
                <div class="radistes-blog-content">
                    <?php if ( $radiates_title ) : ?>
                        <h3 class="bg-small white_bg"><?php echo $radiates_title; ?></h3>
                    <?php endif; ?>
                    <?php if ( $radiates_content ) : ?>
                        <?php echo $radiates_content; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <!-- good to know section end -->
    <?php 
} ?>


<?php
$our_courses_title  = get_field('our_courses_title', false, false);
$show_courses       = get_field('show_courses');

if ($show_courses) {
if ($our_courses_title || have_rows('our_courses', )) { ?>
    <section class="our_courses suggestion-section">
        <div class="wrapper">
            <?php if ( $our_courses_title ) : ?>
            <h2 class="h2"><?php echo $our_courses_title; ?></h2>
            <?php endif; ?>
            <?php if( have_rows('our_courses', ) ): ?>
                <div class="row suggestion-box-area">
            <?php 
                while ( have_rows('our_courses', ) ) : the_row();
                    $courses_image = get_sub_field('courses_image');
                    $courses_title = get_sub_field('courses_title');
                ?>                            
                    <div class="col-4 suggestion-box">
                        <div class="content-box">
                            <?php if ( $courses_image ) : ?>
                                <div class="box-img"><img src="<?php echo $courses_image['url']; ?>" alt="suggestion-box"></div>
                            <?php endif; 
                            if ($courses_title) {

                                $courses_title_tar          = ($courses_title["target"])? $courses_title["target"]:"_self";
                                echo '<a class="bg-small" href="'.$courses_title["url"].'" target="'.$courses_title_tar.'">'.$courses_title["title"].'<img src="'.get_template_directory_uri().'/assets/images/site/white_arrow.svg" alt="white_arrow"></a>';                                
                            }
                            ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <?php endif; ?>
        </div>
    </section>
<?php } } ?>

<?php if ( get_field('study_blog') ) : ?>
    <?php get_template_part('template-parts/page/want-study');  ?>
<?php endif; ?>

<?php get_footer();