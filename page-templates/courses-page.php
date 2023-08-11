<?php
/**
 * Template Name: Courses Page
 *
 * @package WordPress
 * @subpackage morekoren
 * @since morekoren 1.0
 */
get_header();        
?>
<?php if(get_field('banner_image') || get_field('banner_title') || get_field('banner_sub_title')): ?>
<!-- inner banner section -->
<section class="banner inner-banner-section"
    style="background-image: url('<?php echo get_field('banner_image')['url'];?>');">
    <div class="wrapper">
        <?php if(get_field('banner_title')): ?>
        <h1><?php echo get_field('banner_title');?></h1>
        <?php endif; ?>
        <?php if(get_field('banner_sub_title')): ?>
        <h2><?php echo get_field('banner_sub_title');?></h2>
        <?php endif; ?>
    </div>
</section>
<!-- inner banner section end -->
<?php endif; ?>
<?php the_breadcrumb(); ?>
<?php if(get_field('courses_title') || get_field('courses_content') || get_field('courses_list')): ?>
<!-- our course start -->
<section class="our-courses-section our_courses1">
    <div class="wrapper">
        <div class="row">
            <div class="col-8 topTitle text-right">
                <?php if(get_field('courses_title')): ?>
                <h2><?php echo get_field('courses_title');?></h2>
                <?php endif; ?>
                <?php if(get_field('courses_content')): ?>
                <?php echo get_field('courses_content');?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php if(get_field('courses_list')):?>
    <div class="wrapper">
        <div class="courses-row row">
		
		

            <?php  $i=1; foreach(get_field('courses_list') as $course):
                 setup_postdata($course);
                    $course_image = wp_get_attachment_url( get_post_thumbnail_id($course->ID), 'full' );
                    $course_subtitle = get_field('course_subtitle', $course->ID);
                    $course_persons = get_field('course_persons', $course->ID);
                    $course_duration = get_field('course_duration', $course->ID);
                    $course_date = get_field('course_date', $course->ID);

                ?>
            <div class="col-4">
                <div class="col">
                    <div class="img" style="background-image:url('<?php echo $course_image;?>');"></div>
                    <div class="text">
                        <div class="top_area">
                            <a
                                href="<?php echo get_permalink($course->ID);?>"><?php echo get_the_title($course->ID);?></a>
                            <span><img src="<?php echo get_template_directory_uri();?>/assets/images/site/star.png"
                                    alt=""></span>
                        </div>
                        <?php if($course_subtitle):?>
                        <?php echo $course_subtitle;?>
                        <?php endif;?>
                        <div class="in">
                            <?php if($course_persons):?>
                            <span><img src="<?php echo get_template_directory_uri();?>/assets/images/site/oc1.png"
                                    alt=""><?php echo $course_persons;?></span>
                            <?php endif;?>
                            <?php if($course_duration):?>
                            <span><img src="<?php echo get_template_directory_uri();?>/assets/images/site/oc2.png"
                                    alt=""><?php echo $course_duration;?></span>
                            <?php endif;?>
                            <?php if($course_date):?>
                            <span><img src="<?php echo get_template_directory_uri();?>/assets/images/site/oc3.png"
                                    alt=""><?php echo $course_date;?></span>
                            <?php endif;?>
                        </div>
                        <div class="btns text-left">
                            <a href="<?php echo get_permalink($course->ID);?>"
                                class="btn blue-btn small-btn"><?php echo __('פרטים נוספים','morekoren');?></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php wp_reset_postdata(); 
             $i++; endforeach;  ?>
        </div>
    </div>
    <?php endif; ?>
</section>
<!-- our course start -->
<?php endif; ?>
<?php if(get_field('show_course_products_section')):?>
<?php if(get_field('product_title') || get_field('product_content') || get_field('product_list')):?>
<!-- our course start -->
<section class="our-courses-section gray-bg">
    <div class="wrapper">
        <div class="row">
            <div class="col-8 topTitle text-center">
                <?php if(get_field('product_title')): ?>
                <h2> <?php echo get_field('product_title');?> </h2>
                <?php endif; ?>
                <?php if(get_field('product_content')): ?>
                <?php echo get_field('product_content');?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php if(get_field('product_list')):?>
    <div class="wrapper">
        <div class="courses-row row">
            <?php $i=1; foreach(get_field('product_list') as $cproduct):
                    setup_postdata($cproduct);
                        $product_image = wp_get_attachment_url( get_post_thumbnail_id($cproduct->ID), 'full' );
                        $course_date = get_field('course_date', $cproduct->ID);
                        $course_duration = get_field('course_duration', $cproduct->ID);
                        $course_persons = get_field('course_persons', $cproduct->ID);
                        $excerpt = get_the_excerpt($cproduct->ID);
                    ?>
            <div class="col-4">
                <div class="col">
                    <div class="img" style="background-image:url('<?php echo $product_image;?>');"></div>
                    <div class="text">
                        <a
                            href="<?php echo get_permalink($cproduct->ID);?>"><?php echo get_the_title($cproduct->ID);?></a>
                        <span><img src="<?php echo get_template_directory_uri();?>/assets/images/site/star.png"
                                alt=""></span>
                        <p><?php echo $excerpt;?></p>
                        <div class="in">
                            <?php if($course_persons):?>
                            <span><img src="<?php echo get_template_directory_uri();?>/assets/images/site/oc1.png"
                                    alt=""><?php echo $course_persons;?></span>
                            <?php endif;?>
                            <?php if($course_duration):?>
                            <span><img src="<?php echo get_template_directory_uri();?>/assets/images/site/oc2.png"
                                    alt=""><?php echo $course_duration;?></span>
                            <?php endif;?>
                            <?php if($course_date):?>
                            <span><img src="<?php echo get_template_directory_uri();?>/assets/images/site/oc3.png"
                                    alt=""><?php echo $course_date;?></span>
                            <?php endif;?>
                        </div>
                        <div class="btns text-left">
                            <a href="<?php echo get_permalink($cproduct->ID);?>"
                                class="btn blue-btn small-btn"><?php echo __('פרטים נוספים','morekoren');?></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php wp_reset_postdata(); 
                    $i++; endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</section>
<!-- our course start -->
<?php endif;?>
<?php if(get_field('offering_title') || get_field('offering_content') || get_field('offering_image')):?>
<section class="offers_online_courses gray-bg">
    <div class="wrapper">
        <div class="colin">
            <?php if(get_field('offering_title')): ?>
            <?php echo get_field('offering_title');?>
            <?php endif; ?>
            <?php if(get_field('offering_content')): ?>
            <?php echo get_field('offering_content');?>
            <?php endif; ?>
        </div>
        <?php if(get_field('offering_image')):?>
        <img src="<?php echo get_field('offering_image')['url'];?>" class="three_img"
            alt="<?php echo get_field('offering_image')['alt'];?>">
        <?php endif;?>
    </div>
</section>
<?php endif;?>
<?php endif;?>
<?php if(get_field('responsible_title') || get_field('responsible_content')):?>
<section class="radiates_blog inner-radiates-blog book_blog">
    <div class="wrapper">        
        <?php if(get_field('responsible_title')):?>
        <h3 class=""><?php echo get_field('responsible_title');?></h3>
        <?php endif;?>

        <?php if(get_field('responsible_content')):?>
        <div class="radistes-blog-content">
        <?php echo get_field('responsible_content');?>
        </div>
        <?php endif;?>        
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


<?php if(get_field('location_section')):?>
<?php get_template_part('template-parts/page/want-study');  ?>
<?php endif;?>
<?php get_footer();