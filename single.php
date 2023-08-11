<?php get_header(); ?>
<?php while(have_posts()): the_post();?>
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

<?php the_breadcrumb(); ?>

<div class="club_700">
    <div class="wrapper d_flex justify_content_sb">
        <div class="right_col">
            <?php if(get_field('post_content')):?>
            <?php echo get_field('post_content');?>
            <?php endif;?>
        </div>
        <div class="left_col">
            <?php if(get_field('sidebar_ad_section')):?>
            <?php if(get_field('sidebar_ad_image') || get_field('sidebar_ad_title') || get_field('sidebar_ad_url')):?>
            <div class="suggestion-box-area">
                <div class=" suggestion-box">
                    <div class="content-box">
                        <?php if(get_field('sidebar_ad_image')):?>
                        <div class="box-img"><img src="<?php echo get_field('sidebar_ad_image')['url'];?>"
                                alt="<?php echo get_field('sidebar_ad_image')['alt'];?>"></div>
                        <?php endif;?>
                        <?php if(get_field('sidebar_ad_title')):?>
                        <a href="<?php echo get_field('sidebar_ad_url');?>"
                            class="bg-small"><?php echo get_field('sidebar_ad_title');?> <img
                                src="<?php echo get_template_directory_uri();?>/assets/images/site/white_arrow.svg"
                                alt="white_arrow"></a>
                        <?php endif;?>
                    </div>
                </div>
            </div>
            <?php endif;?>
            <?php endif;?>
            <?php if(get_field('sidebar_contact_form_section')):?>
            <div class="talk_to_me">
                <?php 
                        if( get_field('sidebar_contact_form') ):
                            $jobcontact_form_id = get_field('sidebar_contact_form')[0]->ID; 
                            echo do_shortcode('[contact-form-7 id="'.$jobcontact_form_id.'"]');
                        endif;
                    ?>
            </div>
            <?php endif;?>
            <?php if(get_field('sidebar_course_section')):?>
            <div class="courses-row">
            <?php if(get_field('sidebar_course_list')):?>
                <?php $i=1; foreach(get_field('sidebar_course_list') as $course):
                     setup_postdata($course);
                     $product_image = wp_get_attachment_url( get_post_thumbnail_id($course->ID), 'full' );
                     $course_date = get_field('course_date', $course->ID);
                     $course_duration = get_field('course_duration', $course->ID);
                     $course_persons = get_field('course_persons', $course->ID);
                     $excerpt = get_the_excerpt($course->ID);
                        ?>
                <div class="col">
                    <div class="img" style="background-image:url('<?php echo $product_image;?>');"></div>
                    <div class="text">
                        <a href="<?php echo get_permalink($course->ID);?>"><?php echo get_the_title($course->ID);?></a>
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
                    </div>
                </div>
                <?php $i++; endforeach;?>
                <?php endif;?>

                <?php if(get_field('sidebar_course_product_list')):?>
                <?php $i=1; foreach(get_field('sidebar_course_product_list') as $course):
                     setup_postdata($course);
                     $product_image = wp_get_attachment_url( get_post_thumbnail_id($course->ID), 'full' );
                     $course_date = get_field('course_date', $course->ID);
                     $course_duration = get_field('course_duration', $course->ID);
                     $course_persons = get_field('course_persons', $course->ID);
                     $excerpt = get_the_excerpt($course->ID);
                        ?>
                <div class="col">
                    <div class="img" style="background-image:url('<?php echo $product_image;?>');"></div>
                    <div class="text">
                        <a href="<?php echo get_permalink($course->ID);?>"><?php echo get_the_title($course->ID);?></a>
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
                    </div>
                </div>
                <?php $i++; endforeach;?>
                <?php endif;?>
            </div>
            <?php endif;?>

        </div>
    </div>
    <?php if(get_field('post_bottom_cotton')):?>
    <div class="wrapper textbottom">
        <?php echo get_field('post_bottom_cotton');?>
    </div>
    <?php endif;?>
</div>

<?php get_template_part('template-parts/page/good-know');  ?>
<?php get_template_part('template-parts/page/courses-list');  ?>
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
<?php get_template_part('template-parts/page/want-study');  ?>
<?php endwhile;?>
<?php get_footer();?>