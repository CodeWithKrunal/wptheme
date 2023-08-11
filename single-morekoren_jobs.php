<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage morekoren
 * @since morekoren 1.0
 */

get_header();
$job_post_id		 	= get_the_Id();

if(get_field('job_banner',$job_post_id) || get_field('job_banner_title',$job_post_id) || get_field('job_banner_sub_title',$job_post_id)): ?>
<!-- inner banner section -->
<section class="banner inner-banner-section" <?php if(get_field('job_banner',$job_post_id)): ?>
    style="background-image: url('<?php echo get_field('job_banner',$job_post_id)['url'];?>'); <?php endif; ?>">
    <div class="wrapper">
        <?php if(get_field('job_banner_title',$job_post_id)): ?>
        <h1><?php echo get_field('job_banner_title',$job_post_id);?></h1>
        <?php endif; ?>
        <?php if(get_field('job_banner_sub_title',$job_post_id)): ?>
        <h2><?php echo get_field('job_banner_sub_title',$job_post_id);?> </h2>
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
            <div class="job_link_list tabs-nav">
                <?php
                $args=array(
                    'post__not_in'=> array(get_the_ID()),
                    'post_type' => 'morekoren_jobs',
                    'order'          => 'DESC',
                    'posts_per_page' => -1 
              
                  );
                  $catquery = new WP_Query( $args );
                $index = 1; while($catquery->have_posts()) : $catquery->the_post(); ?>
                <a href="<?php echo get_permalink();?>" class="active"><?php echo get_the_title(); ?> </a>
                <?php $index++; endwhile; wp_reset_postdata(); ?>
            </div>
            <?php if(get_field('job_contact_form_title','option') || get_field('job_contact_form', 'option') ): ?>
            <div class="talk_to_me">
                <?php if( get_field('job_contact_form_title','option') ): ?>
                <?php echo htmlspecialchars_decode(get_field('job_contact_form_title','option', false)); ?>
                <?php endif; ?>
                <?php 
                        if( get_field('job_contact_form', 'option') ):
                            $jobcontact_form_id = get_field('job_contact_form', 'option')[0]->ID; 
                            echo do_shortcode('[contact-form-7 id="'.$jobcontact_form_id.'"]');
                        endif;
                    ?>
            </div>
            <?php endif; ?>

            <?php if(get_field('suggestion_box_title') || get_field('suggestion_box_link') || get_field('suggestion_box_image')): ?>
            <div class="suggestion-box-area">
                <div class=" suggestion-box">
                    <div class="content-box">
                        <div class="box-img">
                            <?php if( get_field('suggestion_box_image') ): ?>
                            <img src="<?php echo get_field('suggestion_box_image')['url']; ?>"
                                alt="suggestion-box">
                            <?php endif; ?>
                        </div>
                        <?php if( get_field('suggestion_box_link') ): ?>
                        <a href="<?php echo get_field('suggestion_box_link'); ?>"
                            class="bg-small"><?php echo get_field('suggestion_box_title'); ?> <img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/site/white_arrow.svg"
                                alt="white_arrow">
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <div class="left_col">
            <?php if(get_field('job_content')): ?>
            <div class="tab-contents">
                <h2 class="h2 h2_right"><?php the_title();?></h2>
                <?php echo get_field('job_content'); ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
$job_blog_title    = get_field('job_blog_title');
$radiates_background    = get_field('radiates_background');
$radiates_content       = get_field('radiates_content');
$show_job       = get_field('show_hide_job_background');

if ($radiates_background) {
    $radiates_background = $radiates_background['url'];
}else{
    $radiates_background = "";
}
?>
  
<?php 
if ($show_job) {
if($job_blog_title || $radiates_background || $radiates_content):?>
<section class="radiates_blog inner-radiates-blog radiates_blog_new" style="background-image:url(<?php echo $radiates_background; ?>) ;">
    <div class="wrapper">
        <div class="radistes-blog-content">
            <?php if($job_blog_title):?>
            <h3 class="bg-small white_bg"><?php echo $job_blog_title;?></h3>
            <?php endif;?>
            <?php if($radiates_content):?>
            <?php echo $radiates_content;?>
            <?php endif;?>
        </div>
    </div>
</section>
<?php endif;
}
?>  
  
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
if(get_field('location_section',$job_post_id)):
    get_template_part('template-parts/page/want-study'); 
endif;

?>


<?php
get_footer();