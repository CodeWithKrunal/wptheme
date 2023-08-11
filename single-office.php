<?php
get_header();?>
<?php while(have_posts()): the_post();?>
<?php get_template_part('template-parts/page/inner-banner');  ?>

<?php the_breadcrumb(); ?>

<div class="job_section">
    <div class="wrapper d_flex justify_content_sb flex_wrap ">
        <div class="right_col">
            <div class="job_link_list">
            <?php
                $args=array(
                    // 'post__not_in'=> array(get_the_ID()),
                    'post_type' => 'office',
                    'post_status' => 'publish',
                    'posts_per_page' => 3
              
                  );
                  $catquery = new WP_Query( $args );
                $index = 1; while($catquery->have_posts()) : $catquery->the_post(); ?>
                <a href="<?php echo get_permalink();?>" class="active"><?php echo get_the_title(); ?> </a>
                <?php $index++; endwhile; wp_reset_postdata(); ?>
            </div>

            <?php if(get_field('office_contactform_title','option') || get_field('office_contact_form','option') ): ?>
            <div class="talk_to_me">
                <?php if( get_field('office_contactform_title','option') ): ?>
                <?php echo htmlspecialchars_decode(get_field('office_contactform_title','option',false, false)); ?>
                <?php endif; ?>
                <?php 
                    if( get_field('office_contact_form','option') ):
                        $jobcontact_form_id = get_field('office_contact_form','option')[0]->ID; 
                        echo do_shortcode('[contact-form-7 id="'.$jobcontact_form_id.'"]');
                    endif;
                ?>                  
            </div>
            <?php endif; ?>

            <?php if(get_field('sidebar_ad_title') || get_field('sidebar_ad_link') || get_field('sidebar_ad_image')): ?>
            <div class="suggestion-box-area">
                <div class=" suggestion-box">
                    <div class="content-box">
                        <div class="box-img">
                            <?php if( get_field('sidebar_ad_image') ): ?>
                            <img src="<?php echo get_field('sidebar_ad_image')['url']; ?>" alt="suggestion-box">
                            <?php endif; ?>
                        </div>
                        <?php if( get_field('sidebar_ad_title') ): ?>
                        <a href="<?php echo get_field('sidebar_ad_link'); ?>" class="bg-small"><?php echo get_field('sidebar_ad_title'); ?> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/site/white_arrow.svg" alt="white_arrow">
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <?php if(get_field('post_content') || get_field('office_image')): ?>
        <div class="left_col">
            <h2 class="h2 h2_right"><?php echo get_the_title(); ?></h2>
            <?php if( get_field('post_content') ): ?>
                <?php echo get_field('post_content'); ?>
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
    <section class="radiates_blog" style="background-image:url(<?php echo $radiates_background; ?>) ;">
        <?php if ( $radiates_content ) : ?>
                <?php echo $radiates_content; ?>
        <?php endif; ?>
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
<?php } } ?>

<?php    
    get_template_part('template-parts/page/want-study'); 
?>
<?php endwhile;?>
<?php get_footer();?>