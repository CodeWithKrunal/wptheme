<?php
/**
 * Template Name: About Page
 *
 * @package WordPress
 * @subpackage morekoren
 * @since morekoren 1.0
 */
get_header(); ?>
<?php if(get_field('banner_image') || get_field('banner_title') || get_field('banner_sub_title')): ?>
<!-- inner banner section -->
<section class="banner inner-banner-section" style="background-image: url('<?php echo get_field('banner_image')['url'];?>');">
    <div class="wrapper">
        <?php if(get_field('banner_title')): ?>
        <h1><?php echo get_field('banner_title');?></h1>
        <?php endif; ?>
        <?php if(get_field('banner_sub_title')): ?>
        <h2><?php echo get_field('banner_sub_title');?> </h2>
        <?php endif; ?>
    </div>
</section>
<!-- inner banner section end -->
<?php endif; ?>

<?php the_breadcrumb();?>
<?php if(get_field('aboutus_title') || get_field('aboutus_content') || get_field('aboutus_image')): ?>
<!-- our course detail start -->
<section class="about-section after-breadcrumb-section">
    <div class="wrapper">
        <div class="row justify_content_sb">
            <div class="col-7 about-info">
                <div class="about-detail">
                    <?php if(get_field('aboutus_title')): ?>
                    <h2 class="h2 h2_right"><?php echo get_field('aboutus_title');?></h2>
                    <?php endif; ?>
                    <?php if(get_field('aboutus_content')): ?>
                    <div class="about-con">
                    <?php echo get_field('aboutus_content');?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-4">
                <div class="about-img">
                    <?php if(get_field('aboutus_image')): ?>
                    <img src="<?php echo get_field('aboutus_image')['url'];?>" alt="<?php echo get_field('aboutus_image')['alt'];?>">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- our course detail end -->
<?php endif; ?>

<?php
$radiates_background    = get_field('radiates_background');
$radiates_content       = get_field('radiates_content');

if ($radiates_background) {
    $radiates_background = $radiates_background['url'];
}else{
    $radiates_background = "";
}

if ($radiates_background || $radiates_content) { ?>
    <!-- good to know section start -->
    <section class="radiates_blog inner-radiates-blog book_blog" style="background-image:url(<?php echo $radiates_background; ?>) ;">
        <div class="wrapper">
        <?php if ( $radiates_content ) : ?>
            <div class="radistes-blog-content">
                <?php echo $radiates_content; ?>
            </div>
        <?php endif; ?>
        </div>
    </section>
    <!-- good to know section end -->
<?php } ?>

<?php

$our_courses_title = get_field('our_courses_title', false, false);
$show_courses       = get_field('show_courses');

if ($show_courses) {
if ($our_courses_title || have_rows('our_courses', )) { ?>

    <!-- our course section start -->
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
    <!-- pur course section stop -->
<?php } } ?>

<?php if(get_field('location_section')):
    get_template_part('template-parts/page/want-study'); 
endif;
?>

<?php get_footer();