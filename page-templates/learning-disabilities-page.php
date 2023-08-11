<?php
/**
 * Template Name: Learning Disabilities Page
 *
 * @package WordPress
 * @subpackage Medicom
 * @since Medicom 1.0
 */
get_header();?>
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
<div class="club_700 learning_disabilities">
    <div class="wrapper d_flex justify_content_sb flex_wrap">
      <?php if(get_field('page_content')):?>
        <div class="right_col">
            <?php echo get_field('page_content');?>
        </div>
        <div class="left_col benifit-box">
            <?php if(get_field('page_image')):?>
            <div class="box_img"><img src="<?php echo get_field('page_image')['url'];?>" alt="<?php echo get_field('page_image')['alt'];?>"></div>
            <?php endif;?>
        </div>
    </div>
    <?php endif;?>
    <?php if(have_rows('course_feature_list')):?>
    <div class="wrapper">
        <div class="course_structure_col d_flex justify_content_sb flex_wrap">
            <?php while(have_rows('course_feature_list')): the_row();?>
            <div class="colin">
                <img src="<?php echo get_sub_field('icon')['url'];?>" alt="<?php echo get_sub_field('icon')['alt'];?>">
                <h4><?php echo get_sub_field('title');?></h4>
            </div>
           <?php endwhile; ?>
        </div>
        <?php endif; ?>
        <?php if(get_field('course_benefits_title')):?>
        <h2 class="h2 h2_right"><?php echo get_field('course_benefits_title');?></h2>
        <?php endif; ?>
        <?php if(have_rows('course_benefits_list')):?>
        <ul class="course_structure_list">
            <?php while(have_rows('course_benefits_list')): the_row();?>
            <li><?php echo get_sub_field('content');?></li> 
            <?php endwhile; ?>
        </ul>
        <?php endif; ?>
    </div>
</div>
<?php if(get_field('good_to_know_title') || get_field('good_to_know_content')):?>
<section class="radiates_blog inner-radiates-blog radiates_blog_new">
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

<?php if(get_field('courses_section')):?>
<?php get_template_part('template-parts/page/courses-list');  ?>
<?php endif; ?>
<?php if(get_field('address_section')):?>
<?php get_template_part('template-parts/page/want-study');  ?>
<?php endif; ?>
<?php get_footer();