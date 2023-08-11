<?php
/**
 * Template Name: Online Course Page
 *
 * @package WordPress
 * @subpackage Medicom
 * @since Medicom 1.0
 */
get_header();?>

<section class="cource_blog">
    <div class="wrapper d_flex justify_content_sb flex_wrap">
        <div class="right_col">
          <?php if(get_field('page_title') || get_field('page_subtitle') || get_field('course_time_duration') || get_field('course_date') || get_field('course_persons') || have_rows('course_video_timestamp_list')):?>
            <div class="quantitative_course">
                <div class="top_col">
                    <?php if(get_field('page_title')):?>
                    <h2><?php echo get_field('page_title');?></h2>
                    <?php endif;?>
                    <?php if(get_field('page_subtitle')):?>
                    <p><?php echo get_field('page_title');?> </p>
                    <?php endif;?>
                    <div class="list">
                        <?php if(get_field('course_time_duration')):?>
                        <span><img src="<?php echo get_template_directory_uri();?>/assets/images/site/ll1.png" alt=""> <?php echo get_field('course_time_duration');?></span>
                        <?php endif;?>
                        <?php if(get_field('course_date')):?>
                        <span><img src="<?php echo get_template_directory_uri();?>/assets/images/site/ll2.png" alt=""> <?php echo get_field('course_date');?></span>
                        <?php endif;?>
                        <?php if(get_field('course_persons')):?>
                        <span><img src="<?php echo get_template_directory_uri();?>/assets/images/site/ll3.png" alt=""> <?php echo get_field('course_persons');?></span>
                        <?php endif;?>
                    </div>
                    <img src="<?php echo get_template_directory_uri();?>/assets/images/site/arrow.png" alt="">
                </div>
                <?php if(have_rows('course_video_timestamp_list')):?>
                <div class="text">
                    <ul>
                        <?php while(have_rows('course_video_timestamp_list')):the_row();?>
                        <li>
                            <a href="<?php echo get_sub_field('link');?>)"><img src="<?php echo get_template_directory_uri();?>/assets/images/site/ply.svg" alt=""><?php echo get_sub_field('title');?></a>
                            <span><?php echo get_sub_field('time');?></span>
                        </li>
                        <?php endwhile;?>
                    </ul>
                </div>
                <?php endif;?>
            </div>
          <?php endif;?>
          <?php if(have_rows('course_features_list')):?>
            <div class="overview_tab">
                <ul>
                    <?php $k=0; while(have_rows('course_features_list')):the_row();?>
                    <li class="<?php echo ($k==0)?'active':'';?>" data-title="overview<?php echo $k;?>"><?php echo get_sub_field('title');?></li>
                    <?php $k++; endwhile;?>
                </ul>
                <div class="text_blog">
                <?php $k=0; while(have_rows('course_features_list')):the_row();?>
                    <div class="text_content <?php echo ($k==0)?'active':'';?>" id="overview<?php echo $k;?>">
                       <?php echo get_sub_field('content');?>
                    </div>
                    <?php $k++; endwhile;?>
                </div>
            </div>
          <?php endif;?>
        </div>
        <div class="left_col">
          <?php if(get_field('course_video_url')):
            $video_url = get_field('course_video_url');
            ?>
            <iframe src="<?php echo $video_url;?>" title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
          <?php endif;?>
        </div>
    </div>
</section>

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


<?php if(get_field('address_section')):?>
	<?php get_template_part('template-parts/page/want-study');  ?>
<?php endif;?>
<?php get_footer();