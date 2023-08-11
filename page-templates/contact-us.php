<?php
/**
 * Template Name: Contact Us
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
    $contact_title = get_field('contact_title');
    $contact_sub_title = get_field('contact_sub_title');
    $contact_us_image = get_field('contact_us_image');
?>
<!-- our course detail start -->
<section class="about-section contact-us-section after-breadcrumb-section">
    <div class="wrapper">
        <div class="row justify_content_sb">
            <div class="col-7 about-info">
                <div class="about-detail">
                    <?php if ( $contact_title ) : ?>
                        <h2 class="h2 h2_right"><?php echo $contact_title; ?></h2>
                    <?php endif; ?>
                    <?php if ( $contact_sub_title ) : ?>
                        <div class="about-con"><p><?php echo $contact_sub_title; ?></p></div>
                    <?php endif; ?>
                    <?php 
                        $id     = get_field( 'contact_form')[0]->ID;
                        echo '<div class="contact_form">';
                            $title 	= get_the_title($id);
                            echo do_shortcode('[contact-form-7 id="'.$id.'" title="'.$title.'"]'); 
                        echo '</div>';
                    ?>
                </div>
            </div>
            <?php if ( $contact_us_image ) : ?>
                <div class="col-5">
                    <div class="about-img">
                        <img src="<?php echo $contact_us_image['url']; ?>" alt="<?php echo $contact_us_image['alt']; ?>">
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php if(get_field('contact_us_title') || get_field('contact_phone_number') || get_field('contact_email_address') || get_field('followus_title') || get_field('instagram_link') || get_field('facebook_link') || get_field('twitter_link')): ?>
            <div class="contact-detail d_flex justify_content_c">
                <div class="address-detail con-detail-box">
                    <?php if(get_field('contact_us_title')): ?>
                    <h2><?php echo get_field('contact_us_title');?></h2>
                    <?php endif; ?>
                    <ul class="unlisted">
                        <?php if(get_field('contact_phone_number')): ?>
                        <li><a href="tel:<?php echo get_field('contact_phone_number');?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/site/blue_call.svg" alt="call"><?php echo get_field('contact_phone_number');?></a></li>
                        <?php endif; ?>
                        <?php if(get_field('fax_number')): ?>
                        <li><a href="tel:<?php echo get_field('fax_number');?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/site/blue_printer.svg" alt="call"><?php echo get_field('fax_number');?></a></li>
                        <?php endif; ?>
                        <?php if(get_field('contact_email_address')): ?>
                        <li><a href="mailto:<?php echo get_field('contact_email_address');?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/site/blue_email.svg" alt="email"><?php echo get_field('contact_email_address');?></a></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="social-medial-detail con-detail-box">
                    <?php if(get_field('followus_title')): ?>
                    <h2><?php echo get_field('followus_title');?></h2>
                    <?php endif; ?>
                    <ul class="unlisted d_flex align_items_c">
                        <?php if(get_field('instagram_link')): ?>
                        <li><a target="_blank" href="<?php echo get_field('instagram_link');?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/site/blue_instagram.svg" alt="instagram"></a></li>
                        <?php endif; ?>
                        <?php if(get_field('facebook_link')): ?>
                        <li><a target="_blank" href="<?php echo get_field('facebook_link');?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/site/blue_facebook-f.svg" alt="facebook"></a></li>
                        <?php endif; ?>
                        <?php if(get_field('twitter_link')): ?>
                        <li><a target="_blank" href="<?php echo get_field('twitter_link');?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/site/blue_twitter.svg" alt="twitter"></a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <?php endif; ?>
    </div>
</section>
<!-- our course detail end -->

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