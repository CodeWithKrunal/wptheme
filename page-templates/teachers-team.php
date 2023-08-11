<?php
/**
 * Template Name: Teachers Team
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
    $page_content = get_field('page_content');
    $add_teacher = get_field('add_teacher');
?>

<!-- our course detail start -->
<section class="teachers-team-section after-breadcrumb-section">
    <div class="wrapper">
        <div class="our-course-box text-right w-100">
            <div class="course-heading-area">
                <h2 class="bg-blue">
                    <?php the_title(); ?>
                </h2>
                <?php if ( $page_content ) : ?>
                <div class="course-detail mr-0">
                    <?php echo $page_content; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<!-- our course detail end -->

<?php if( have_rows('add_teacher') ): ?>
    <!-- teachers detail start -->
    <section class="teacher-detail-section">
        <div class="wrapper">
            <div class="row">
                <div class="col-5">
                    <div class="teacher-img-box">
                        <?php if (isset($add_teacher[0]["teacher_image"])) {
                            echo '<img src="'.$add_teacher[0]["teacher_image"]["url"].'" alt="'.$add_teacher[0]["teacher_image"]["alt"].'" id="teacher_img">';
                        } ?>
                        <h6 class="bg-blue" id="teacher_name"><?php echo $add_teacher[0]["name"]; ?></h6>
                    </div>
                </div>
                <div class="col-7">
                    <div class="teacher-info">
                        <h3 class="teacher-name" id="teacher_title"><?php echo $add_teacher[0]["title"]; ?></h3>
                        <h6 class="teacher-desig" id="teacher_desig"> <?php print_r($add_teacher[0]["designation"]); ?> </h6>
                        <div class="degree-detail" id="teacher_detail">
                            <p><?php echo $add_teacher[0]["info"]; ?></p>
                        </div>
                        <ul class="contact-info d_flex align_items_c unlisted">
                            <?php if ( $add_teacher[0]["facebook_link"] ) : ?>
                                <li><a href="<?php echo $add_teacher[0]["facebook_link"]; ?>" target="_blank" id="twitter_link"><img src="<?php echo get_template_directory_uri() ?>/assets/images/site/twitter.svg" alt="twitter"></a></li>
                            <?php endif; ?>
                            <?php if ( $add_teacher[0]["twitter_link"] ) : ?>
                                <li><a href="<?php echo $add_teacher[0]["twitter_link"]; ?>" target="_blank" id="facbook_link"><img src="<?php echo get_template_directory_uri() ?>/assets/images/site/facebook.svg" alt="facebook"></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="teacher-slider-area">
                        <div class="owl-carousel" id="teacher_slider">
                        <?php 
                            while ( have_rows('add_teacher') ) : the_row();
                                $teacher_image      = get_sub_field('teacher_image');
                                $name               = get_sub_field('name');
                                $title              = get_sub_field('title');
                                $designation        = get_sub_field('designation');
                                $info               = get_sub_field('info');
                                $facebook_link      = get_sub_field('facebook_link');
                                $twitter_link       = get_sub_field('twitter_link');
                            ?>                            
                            <div class="teacher_box" data-name="<?php echo $name; ?>" data-title="<?php echo $title; ?>" data-designation="<?php echo $designation; ?>" data-info="<?php echo $info; ?>" data-facebook_link="<?php echo $facebook_link; ?>" data-twitter_link="<?php echo $twitter_link; ?>" data-teacher_img="<?php echo $teacher_image["url"] ?>">
                                <div class="box-img">
                                    <img src="<?php echo $teacher_image["url"] ?>" alt="<?php echo $teacher_image["alt"] ?>">
                                </div>
                                <h6 class="bg-blue"><?php echo $name; ?></h6>
                            </div>
                        <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- teachers detail stop -->
<?php endif; ?>

<?php 
    $good_to_know_title       = get_field('good_to_know_title');
    $good_to_know_content       = get_field('good_to_know_content');

    $ori_ng =  get_template_directory_uri()."/assets/images/site/ori_ng.jpg";

    if ($good_to_know_title || $good_to_know_content) { ?>
        <!-- good to know section start -->
        <section class="radiates_blog inner-radiates-blog" style="background-image:url(<?php echo $ori_ng; ?>) ;">
            <div class="wrapper">
                <div class="radistes-blog-content">
                    <?php if ( $good_to_know_title ) : ?>
                        <h3 class="bg-small white_bg"><?php echo $good_to_know_title; ?></h3>
                    <?php endif; ?>
                    <?php if ( $good_to_know_content ) : ?>
                        <?php echo $good_to_know_content; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <!-- good to know section end -->
    <?php 
} ?>

<!-- good to know section end -->
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

<?php if ( get_field('want_study') ) : ?>
    <?php get_template_part('template-parts/page/want-study');  ?>
<?php endif; ?>

<?php get_footer();