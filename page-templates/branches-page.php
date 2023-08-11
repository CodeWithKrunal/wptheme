<?php
/**
 * Template Name: Branches Page
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

<!-- our course detail start -->
<section class="branches-section about-section after-breadcrumb-section">
                    <div class="wrapper">
                        <div class="brance-heading text-center">
                            <?php if(get_field('study_title')):?>
                            <h2 class="h2"><?php echo get_field('study_title');?></h2>
                            <?php endif; ?>
                            <?php if(get_field('study_subtitle')):?>
                            <div class="about-con"><p><?php echo get_field('study_subtitle');?></p></div>
                            <?php endif; ?>
                        </div>
                        <?php if(have_rows('branch_address_list')): ?>
                        <div class="brach-box-area d_flex">
                            <?php while(have_rows('branch_address_list')): the_row(); ?>
                            <div class="branch-box">
                                <div class="icon_box_area text-center">
                                    <?php if(get_sub_field('icon')): ?>
                                    <div class="icon_box"><img src="<?php echo get_sub_field('icon')['url'];?>" alt="<?php echo get_sub_field('icon')['alt'];?>"></div>
                                    <?php endif; ?>
                                    <?php if(get_sub_field('title')): ?>
                                    <h2><?php echo get_sub_field('title');?></h2>
                                    <?php endif; ?>
                                </div>
                                <div class="about-con">
                                    <?php if(get_sub_field('content')): ?>
                                        <?php echo get_sub_field('content');?>
                                    <?php endif; ?>
                                </div>
                                <?php if(get_sub_field('button_label')): ?>
                                <a href="<?php echo get_sub_field('button_url');?>" class="branch-btn"><?php if(get_sub_field('button_icon')):?> <img src="<?php echo get_sub_field('button_icon')['url'];?>" alt="<?php echo get_sub_field('button_icon')['alt'];?>"><?php endif;?> <?php echo get_sub_field('button_label');?></a>
                                <?php endif; ?>
                            </div>
                            <?php endwhile; ?>
                        </div>
                        <?php endif; ?>
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
                                    <li><a href="<?php echo get_field('instagram_link');?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/site/blue_instagram.svg" alt="instagram"></a></li>
                                    <?php endif; ?>
                                    <?php if(get_field('facebook_link')): ?>
                                    <li><a href="<?php echo get_field('facebook_link');?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/site/blue_facebook-f.svg" alt="facebook"></a></li>
                                    <?php endif; ?>
                                    <?php if(get_field('twitter_link')): ?>
                                    <li><a href="<?php echo get_field('twitter_link');?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/site/blue_twitter.svg" alt="twitter"></a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </section>
                <!-- our course detail end -->

<?php if(get_field('big_results_title') || get_field('big_results_content')): ?>
<!-- good to know section start -->
<section class="radiates_blog">
    <?php if(get_field('big_results_title')): ?>
    <h2><?php echo get_field('big_results_title');?></h2>
    <?php endif; ?>
    <?php if(get_field('big_results_content')): ?>
        <?php echo get_field('big_results_content');?>
    <?php endif; ?>
</section>
<!-- good to know section end -->
<?php endif; ?>


<?php
$show_courses       = get_field('show_courses');
if ($show_courses) {
if(get_field('reading_title') || have_rows('reading_list')){ ?>
<!-- our course section start -->
<section class="our_courses suggestion-section">
    <div class="wrapper">
        <?php if(get_field('reading_title')): ?>
        <?php echo get_field('reading_title');?>
        <?php endif; ?>
        <?php if(have_rows('reading_list')): ?>
        <div class="row suggestion-box-area">
            <?php while(have_rows('reading_list')): the_row(); ?>
            <div class="col-4 suggestion-box">
                <div class="content-box">
                    <div class="box-img">
                        <?php if(get_sub_field('image')): ?>
                        <img src="<?php echo get_sub_field('image')['url'];?>" alt="<?php echo get_sub_field('image')['alt'];?>">
                        <?php endif; ?>
                    </div>
                    <?php if(get_sub_field('title')): ?>
                    <a href="<?php echo get_sub_field('link');?>" class="bg-small"><?php echo get_sub_field('title');?> <img
                            src="<?php echo get_template_directory_uri();?>/assets/images/site/white_arrow.svg" alt="white_arrow"> </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
<!-- pur course section stop -->
<?php } } ?>

<?php if('location_section'): ?>
<?php get_template_part('template-parts/page/want-study');  ?>
<?php endif; ?>

<?php get_footer();