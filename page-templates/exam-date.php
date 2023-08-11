<?php
/**
 * Template Name: Exam Date
 *
 * @package WordPress
 * @subpackage morekoren
 * @since morekoren 1.0
 */
get_header(); ?>

<?php if(get_field('exam_date_banner_image') || get_field('exam_date_banner_title') || get_field('exam_date_banner_sub_title')): ?>
<!-- inner banner section -->
<section class="banner inner-banner-section" style="background-image: url('<?php echo get_field('exam_date_banner_image')['url'];?>');">
    <div class="wrapper">
        <?php if(get_field('exam_date_banner_title')): ?>
        <h1><?php echo get_field('exam_date_banner_title');?></h1>
        <?php endif; ?>
        <?php if(get_field('exam_date_banner_sub_title')): ?>
        <h2><?php echo get_field('exam_date_banner_sub_title');?> </h2>
        <?php endif; ?>
    </div>
</section>
<!-- inner banner section end -->
<?php endif; ?>

<!-- breadcrumb start -->
<?php the_breadcrumb();?>
<!-- breadcrumb end -->

 <!-- our course detail start -->
 <?php if(get_field('course_detail_title') || get_field('course_detail_content') || get_field('exam_location_content') || get_field('insititute_factors_header') || get_field('insititute_factors_content') || get_field('exam_header') || have_rows('exam_table_header_columns_list') || have_rows('exam_table_content_columns_list') ): ?>
 <section class="exam-date-section after-breadcrumb-section-small">
    <div class="wrapper">
        <div class="our-course-box text-right w-100">
            <div class="course-heading-area">
                <?php if(get_field('course_detail_title')): ?>
                <h2 class="h2 h2_right"><?php echo get_field('course_detail_title'); ?></h2>
                <?php endif; ?>
                
                <?php if(get_field('course_detail_content')): ?>
                <div class="course-detail mr-0">
                    <?php echo get_field('course_detail_content'); ?>
                </div>
                <?php endif; ?>
            </div>

            <?php if(get_field('exam_location_content')): ?>
            <div class="exam-location course-detail mr-0">
                <?php echo get_field('exam_location_content'); ?>
            </div>
            <?php endif; ?>

            <div class="insititute-factors-area">
                <div class="factor-box date_heading">
                    <?php if(get_field('insititute_factors_header')): ?>
                    <h4 class="bg-orange small-bg-orange"><?php echo get_field('insititute_factors_header'); ?></h4>
                    <?php endif; ?>

                    <?php if(get_field('insititute_factors_content')): ?>
                    <div class="factor-content course-detail mr-0">
                    <?php echo get_field('insititute_factors_content'); ?>
                    </div>
                    <?php endif; ?>

                    <?php if( get_field('exam_header') || have_rows('exam_table_header_columns_list') || have_rows('exam_table_content_columns_list') ) : ?>
                    <div class="exam_time_table">
                        <?php if(get_field('exam_header')): ?>
                        <h5><?php echo get_field('exam_header'); ?></h5>
                        <?php endif; ?>
                        <div class="time_table">
                            <table>
                                <?php if(have_rows('exam_table_header_columns_list')): ?>
                                <thead>
                                    <tr>
                                        <?php while(have_rows('exam_table_header_columns_list')): the_row(); ?>
                                        <th><?php echo get_sub_field('due_in_header'); ?></th>
                                        <th><?php echo get_sub_field('exam_dates_header'); ?></th>
                                        <th><?php echo get_sub_field('registration_and_date_header'); ?></th>
                                        <th><?php echo get_sub_field('exam_languages_header'); ?></th>
                                        <th><?php echo get_sub_field('exam_location_header'); ?></th>
                                        <?php endwhile; ?>
                                    </tr>
                                </thead>
                                <?php endif; ?>

                                <?php if(have_rows('exam_table_content_columns_list')): ?>
                                <tbody>
                                    <?php while(have_rows('exam_table_content_columns_list')): the_row(); ?>
                                    <tr>
                                        <td><?php echo get_sub_field('due_in_content'); ?></td>
                                        <td><?php echo get_sub_field('exam_dates_content'); ?></td>
                                        <td><?php echo get_sub_field('registration_and_date_content'); ?></td>
                                        <td><?php echo get_sub_field('exam_languages_content'); ?></td>
                                        <td><?php echo get_sub_field('exam_location_content'); ?></td>
                                    </tr>                                   
                                    <?php endwhile; ?>
                                </tbody>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- our course detail end -->

<?php if(get_field('good_to_know_title') || get_field('good_to_know_content')):?>
<section class="radiates_blog inner-radiates-blog">
    <div class="wrapper">
        <div class="radistes-blog-content">
            <?php if(get_field('good_to_know_title')):?>
            <h3 class="bg-small white_bg"><?php echo get_field('good_to_know_title');?></h3>
            <?php endif;?>
            <?php if(get_field('good_to_know_content')):?>
            <?php echo get_field('good_to_know_content');?>
            <?php endif;?>
        </div>
    </div>
</section>
<?php endif;?>

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

<?php if ( get_field('course_section') ) : ?>
    <?php get_template_part('template-parts/page/courses-list');  ?>
<?php endif; ?>

<?php if(get_field('location_section')):?>
<?php get_template_part('template-parts/page/want-study');  ?>
<?php endif;?>

<?php get_footer();