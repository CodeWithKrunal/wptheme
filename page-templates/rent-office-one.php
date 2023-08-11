<?php
/**
 * Template Name: Rent Office One
 *
 * @package WordPress
 * @subpackage morekoren
 * @since morekoren 1.0
 */
get_header(); ?>
<?php if(get_field('job_second_banner_image') || get_field('job_second_banner_title') || get_field('job_second_banner_sub_title')): ?>
<!-- inner banner section -->
<section class="banner inner-banner-section" style="background-image: url('<?php echo get_field('job_second_banner_image')['url'];?>');">
    <div class="wrapper">
        <?php if(get_field('job_second_banner_title')): ?>
        <h1><?php echo get_field('job_second_banner_title');?></h1>
        <?php endif; ?>
        <?php if(get_field('job_second_banner_sub_title')): ?>
        <h2><?php echo get_field('job_second_banner_sub_title');?> </h2>
        <?php endif; ?>
    </div>
</section>
<!-- inner banner section end -->
<?php endif; ?>

<!-- breadcrumb start -->
<?php the_breadcrumb();?>
<!-- breadcrumb end -->

<div class="job_section">
    <div class="wrapper d_flex justify_content_sb flex_wrap ">
        <div class="right_col">
            <?php if(have_rows('job_second_pages_list')): ?>
            <div class="job_link_list">
                <?php while(have_rows('job_second_pages_list')): the_row(); ?> 
                    <?php if( get_sub_field('job_second_pages_link') ): ?>  
                    <a href="<?php echo get_sub_field('job_second_pages_link'); ?>" class=""><?php echo get_sub_field('job_second_pages_link_title'); ?></a>
                    <?php endif; ?>
                <?php endwhile; ?>  
            </div>
            <?php endif; ?>

            <?php if(get_field('job_second_contact_form_title') || get_field('job_second_contact_form') ): ?>
            <div class="talk_to_me">
                <?php if( get_field('job_second_contact_form_title') ): ?>
                <?php echo htmlspecialchars_decode(get_field('job_second_contact_form_title',false, false)); ?>
                <?php endif; ?>
                <?php 
                    if( get_field('job_second_contact_form') ):
                        $jobcontact_form_id = get_field('job_second_contact_form')[0]->ID; 
                        echo do_shortcode('[contact-form-7 id="'.$jobcontact_form_id.'"]');
                    endif;
                ?>                  
            </div>
            <?php endif; ?>

            <?php if(get_field('phycometric_test_title') || get_field('phycometric_test_link') || get_field('phycometric_test_image')): ?>
            <div class="suggestion-box-area">
                <div class=" suggestion-box">
                    <div class="content-box">
                        <div class="box-img">
                            <?php if( get_field('phycometric_test_image') ): ?>
                            <img src="<?php echo get_field('phycometric_test_image')['url']; ?>" alt="suggestion-box">
                            <?php endif; ?>
                        </div>
                        <?php if( get_field('phycometric_test_link') ): ?>
                        <a href="<?php echo get_field('phycometric_test_link'); ?>" class="bg-small"><?php echo get_field('phycometric_test_title'); ?> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/site/white_arrow.svg" alt="white_arrow">
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <?php if( get_field('job_second_header') || get_field('job_second_content') || get_field('job_second_content_image')): ?>
        <div class="left_col">
            <?php if( get_field('job_second_header') ): ?>
            <h2 class="h2 h2_right"><?php echo get_field('job_second_header'); ?></h2>
            <?php endif; ?>

            <?php if( get_field('job_second_content') ): ?>
                <?php echo get_field('job_second_content'); ?>
            <?php endif; ?>

            <?php if( get_field('job_second_content_image') ): ?>
            <div class="office_img"><img src=" <?php echo get_field('job_second_content_image')['url']; ?>" alt="office_img"></div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</div>


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
<?php } }

if(get_field('location_section')):
    get_template_part('template-parts/page/want-study'); 
endif;
?>

<?php get_footer();