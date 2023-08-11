<?php
/**
 * Template Name: Our Course
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

<?php 
    $contact = get_field('contact');
    $why_choose_moore_koren = get_field('why_choose_moore_koren');
?>


<!-- our course detail start -->
<section class="our-course-detail-section after-breadcrumb-section">
    <div class="wrapper">
        <div class="our-course-box text-center">
            <div class="course-heading-area">
                <h2 class="bg-blue">
                    <?php the_title(); ?>
                </h2>
                <?php if ( $contact ) : ?>
                    <div class="course-detail"><?php echo $contact; ?></div>
                <?php endif; ?>
            </div>
        </div>

        <?php if ( $why_choose_moore_koren ) : ?>
            <div class="course-ques-ans text-center"><?php echo $why_choose_moore_koren; ?></div>
        <?php endif; ?>
        
        
        <?php if( have_rows('course_benifit') ): ?>
            <div class="course-benifit-list">
        <?php 
            while ( have_rows('course_benifit') ) : the_row();
                $course_title = get_sub_field('course_title');
                $course_content = get_sub_field('course_content');
                $course_image = get_sub_field('course_image');
            ?>                            
                <div class="row benifit-box">
                    <?php if ( $course_image ) : ?>
                        <div class="col-4">
                            <div class="box_img">
                                <img src="<?php echo $course_image["url"] ?>" alt="<?php echo $course_image["alt"] ?>">
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="col-7">
                        <div class="box-content">
                            <?php if ( $course_title ) : ?>
                            <h5 class="bg-small"><?php echo $course_title; ?></h5>
                            <?php endif; ?>
                            <?php if ( $course_content ) : ?>
                                <?php echo $course_content; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            </div>
        <?php endif; ?>
        
    </div>
</section>
<!-- our course detail end -->

<?php

$radiates_background    = get_field('radiates_background');
$radiates_title         = get_field('radiates_title');
$radiates_content       = get_field('radiates_content');

if ($radiates_background) {
    $radiates_background = $radiates_background['url'];
}else{
    $radiates_background = "";
}

if ($radiates_background || $radiates_content || $radiates_title) { ?>
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
<?php } ?>

<?php

$our_courses_title = get_field('our_courses_title', false, false);
$show_reading       = get_field('show_reading');

if ($show_reading) {
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

<?php if ( get_field('course_list') ) : ?>
    <?php get_template_part('template-parts/page/courses-list');  ?>
<?php endif; ?>

<?php if ( get_field('want_study') ) : ?>
    <?php get_template_part('template-parts/page/want-study');  ?>
<?php endif; ?>

<?php get_footer();