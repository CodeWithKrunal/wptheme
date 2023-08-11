<?php
/**
 * Template Name: Home Page
 *
 * @package WordPress
 * @subpackage morekoren
 * @since morekoren 1.0
 */
get_header(); 

$banner_inage = get_field('banner_inage');
$banner_content = get_field('banner_content');

$backgroundImage = '';
if ($banner_inage) {
    $backgroundImage = 'style="background-image: url('.$banner_inage["url"].');" ';
} ?>

<div class="banner" <?php echo $backgroundImage; ?>>
    <div class="wrapper">
        <div class="colin">
            <?php if ( $banner_content ) : ?>
                <?php echo $banner_content; ?>
            <?php endif; ?>

            <?php if( have_rows('inner_content') ): ?>
                <div class="inner d_flex justify_content_fs flex_wrap">
            <?php 
                while ( have_rows('inner_content') ) : the_row();
                    $icon = get_sub_field('icon');
                    $content = get_sub_field('content');
                ?>                            
                    <div class="col">
                        <?php if ( $icon ) : ?>
                            <div class="img_col"><img src="<?php echo $icon["url"]; ?>" alt="<?php echo $icon["alt"]; ?>"></div>
                        <?php endif; ?>
                        <?php if ( $content ) : ?>
                            <?php echo $content; ?>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php  
    $exam_look_title = get_field('exam_look_title', false, false);
    if ($exam_look_title || have_rows('exam_look')) { ?>

    <div class="the_look">
        <?php if ( $exam_look_title ) : ?>
            <h2 class="h2">
                <?php echo $exam_look_title; ?>
            </h2>
        <?php endif; ?>
        
        <?php if( have_rows('exam_look') ): ?>
            <div class="wrapper d_flex justify_content_sb flex_wrap">
        <?php 
            while ( have_rows('exam_look') ) : the_row();
                $exam_look_image = get_sub_field('exam_look_image');
                $exam_look_content = get_sub_field('exam_look_content');
            ?>                            
            <div class="col">
                <?php if ( $exam_look_image ) : ?>
                <div class="img_col">
                    <div class="in" data-svg-img="<?php echo $exam_look_image["url"]; ?>"></div>
                </div>
                <?php endif; ?>
                <?php if ( $exam_look_content ) : ?>
                    <?php echo $exam_look_content; ?>
                <?php endif; ?>
            </div>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
    </div>
<?php  } ?>

<?php  
    $courses_title = get_field('courses_title', false, false);
    $courses_button = get_field('courses_button');
    $add_courses = get_field('add_courses');

    if ($courses_title || $courses_button || $add_courses) { ?>

    <div class="our_courses">
        <?php if ( $courses_title ) : ?>
        <h2 class="h2">
            <?php echo $courses_title; ?>
        </h2>
        <?php endif; ?>

        <?php if( $add_courses ): ?>
            <div class="wrapper owl-carousel courses-row">
        <?php 
            foreach(get_field('add_courses') as $course):
                setup_postdata($course);

                $course_image = wp_get_attachment_url( get_post_thumbnail_id($course->ID), 'full' );
                $course_subtitle = get_field('course_subtitle', $course->ID);
                $course_persons = get_field('course_persons', $course->ID);
                $course_duration = get_field('course_duration', $course->ID);
                $course_date = get_field('course_date', $course->ID);
            ?>
                <div class="colin">
                    <div class="col">
                    <a href="<?php echo get_permalink($course->ID);?>" style="width:100%;"><div class="img" style="background-image:url('<?php echo $course_image;?>');"></div></a>
                        <div class="text">
                            <a href="<?php echo get_permalink($course->ID);?>"><?php echo get_the_title($course->ID);?></a>
                            <span><img src="<?php echo get_template_directory_uri();?>/assets/images/site/star.png" alt=""></span>
                            <?php if($course_subtitle):?>
                                <p><?php echo $course_subtitle;?></p>
                                <?php endif;?>
                                <div class="in">
                                    <?php if($course_persons):?>
                                    <span><img src="<?php echo get_template_directory_uri();?>/assets/images/site/oc1.png" alt=""><?php echo $course_persons;?></span>
                                    <?php endif;?>
                                    <?php if($course_duration):?>
                                    <span><img src="<?php echo get_template_directory_uri();?>/assets/images/site/oc2.png" alt=""><?php echo $course_duration;?></span>
                                    <?php endif;?>
                                    <?php if($course_date):?>
                                    <span><img src="<?php echo get_template_directory_uri();?>/assets/images/site/oc3.png" alt=""><?php echo $course_date;?></span>
                                    <?php endif;?>
                                </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; wp_reset_postdata(); ?>
        </div>
        <?php endif; ?>
        <?php 
            if ($courses_button) {
                $courses_button_tar          = ($courses_button["target"])? $courses_button["target"]:"_self";
                echo '<a class="btn" href="'.$courses_button["url"].'" target="'.$courses_button_tar.'">'.$courses_button["title"].'<span data-svg-img="'.get_template_directory_uri().'/assets/images/site/btn_arrow.svg"></span>'.'</a>';
            }
        ?>
    </div>
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
                    $reading_title = get_sub_field('reading_title');
                ?>                            
                    <div class="col-4 suggestion-box">
                        <div class="content-box">
                            <?php if ( $courses_image ) : ?>
                                <div class="box-img"><img src="<?php echo $courses_image['url']; ?>" alt="suggestion-box"></div>
                            <?php endif; 
                            if ($reading_title) {

                                $courses_title_tar          = ($reading_title["target"])? $reading_title["target"]:"_self";
                                echo '<a class="bg-small" href="'.$courses_title["url"].'" target="'.$courses_title_tar.'">'.$reading_title["title"].'<img src="'.get_template_directory_uri().'/assets/images/site/white_arrow.svg" alt="white_arrow"></a>';                                
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


<?php 
    $study_blog_title = get_field('study_blog_title');
    $study_blog_button = get_field('study_blog_button');
    $study_blog_image = get_field('study_blog_image');

    if ($study_blog_title || $study_blog_button || $study_blog_image || have_rows('study_blog_points')) { ?>
    <div class="study_blog">
        <div class="wrapper d_flex justify_content_sb align_items_c">
            <div class="col_right">
                <?php if ( $study_blog_title ) : ?>
                    <?php echo $study_blog_title; ?>
                <?php endif; ?>
                <?php if( have_rows('study_blog_points') ): ?>
                    <ul>
                    <?php 
                    while ( have_rows('study_blog_points') ) : the_row();
                        $points = get_sub_field('points');
                        if ($points) {  ?>                            
                            <li><img src="<?php echo get_template_directory_uri(); ?>/assets/images/site/pluce.png" alt=""> <?php echo $points; ?></li>
                    <?php } endwhile; ?>
                    </ul>
                <?php endif; ?>
                <?php 
                    if ($study_blog_button) {
                        $study_blog_button_tar  = ($study_blog_button["target"])? $study_blog_button["target"]:"_self";
                        echo '<a class="btn" href="'.$study_blog_button["url"].'" target="'.$study_blog_button_tar.'">'.$study_blog_button["title"].'</a>';
                    }
                ?>
            </div>
            <?php if ( $study_blog_image ) : ?>
            <div class="col_left">
                <img src="<?php echo $study_blog_image['url']; ?>" alt="<?php echo $study_blog_image['alt']; ?>">
            </div>
            <?php endif; ?>
        </div>
    </div>
<?php
    }
    
    $radiates_blog_content = get_field('radiates_blog_content');
    $radiates_blog_button = get_field('radiates_blog_button');
    $radiates_background = get_field('radiates_background');

    if ($radiates_blog_content || $radiates_blog_button || $radiates_background) { 
        
        if ($radiates_background) {
            $radiates_background = $radiates_background['url'];
        }else{
            $radiates_background = "";
        }
    ?>
    <div class="radiates_blog" style="background-image:url('<?php echo $radiates_background ?>');">
        <?php if ( $radiates_blog_content ) : ?>
            <?php echo $radiates_blog_content; ?>
        <?php endif; ?>
        <?php if ( $radiates_blog_button ) : 
            $radiates_blog_button_tar          = ($radiates_blog_button["target"])? $radiates_blog_button["target"]:"_self";
            echo '<a class="btn" href="'.$radiates_blog_button["url"].'" target="'.$radiates_blog_button_tar.'">'.$radiates_blog_button["title"].'</a>';
        endif; ?>
    </div>
<?php } 

    $students_course_title  = get_field('students_course_title', false, false);
    $students_course_button = get_field('students_course_button');

    if ($students_course_title || $students_course_button || have_rows('students_course')) { ?>
    <div class="students_course">
        <?php if ( $students_course_title ) : ?>
            <h2 class="h2"><?php echo $students_course_title; ?></h2>
        <?php endif; ?>
        
        <?php if( have_rows('students_course') ): ?>
            <div class="wrapper ">
        <?php 
            while ( have_rows('students_course') ) : the_row();
                $course_video = get_sub_field('course_video');

                $course_background_image = get_sub_field('course_background_image');
                $course_title = get_sub_field('course_title');
                $course_text = get_sub_field('course_text');
                $user = get_sub_field('user');
            ?>                            
                <div class="colin">
                    <div class="col">
                        <?php 
                            if ($course_video) {
                                    if ($course_background_image) {
                                        $course_background_image = $course_background_image['url'];
                                    }else{
                                        $course_background_image = "";
                                    }
                                ?>
                                <a href="<?php echo getYoutubeEmbedUrlnew($course_video); ?>" class="img" style="background-image:url('<?php echo $course_background_image; ?>');" data-title="title will goes here" data-rel="Shadowbox;player=iframe;width=985px;height=460px;"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/site/video_icon.png" alt=""></a>
                                <?php
                            }
                        ?>
                        <div class="text">
                            <?php if ($course_title) {
                                $course_title_tar          = ($course_title["target"])? $course_title["target"]:"_self";
                                echo '<a class="" href="'.$course_title["url"].'" target="'.$course_title_tar.'">'.$course_title["title"].'</a>';
                            } 
                            if ($course_text) {
                                echo $course_text;
                            }
                            if ($user) { ?>
                            <div class="in">
                                <span><img src="<?php echo get_template_directory_uri(); ?>/assets/images/site/oc1.png" alt=""><?php echo $user; ?></span>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
        <?php 
            if ($students_course_button) {
                $students_course_button_tar          = ($students_course_button["target"])? $students_course_button["target"]:"_self";
                echo '<a class="btn" href="'.$students_course_button["url"].'" target="'.$students_course_button_tar.'">'.$students_course_button["title"].'</a>';
            }
        ?>
    </div>
<?php } 

$students_title = get_field('students_title', false, false);

if ($students_title || have_rows('students_tell')) { ?>
    <div class="students_tell">
           <?php if ( $students_title ) : ?>
           <h2 class="h2"><?php echo $students_title; ?></h2>
           <?php endif; ?>
           
           <?php if( have_rows('students_tell') ): ?>
            <div class="wrapper owl-carousel d_flex justify_content_sb flex_wrap">
            <?php 
                while ( have_rows('students_tell') ) : the_row();
                    $students_content   = get_sub_field('students_content');
                    $review             = get_sub_field('review');
                ?>                            
                <div class="colin">
                    <div class="col">
                        <?php if ($students_content) {
                            echo $students_content;
                        } ?>
                        <span><img src="<?php echo get_template_directory_uri(); ?>/assets/images/site/star1.png" alt=""></span>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            <?php endif; ?>
    </div>

<?php 
}

if(get_field('location_section')): ?>
<?php get_template_part('template-parts/page/want-study');  ?>
<?php endif; ?>

<?php get_footer();
