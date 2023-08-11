<?php
get_header();?>
<?php while(have_posts()): the_post();?>

 <!-- inner banner section -->
 <?php if(get_field('psycho_banner_image') || get_field('psycho_banner_title') || get_field('psycho_banner_subtitle')):?>
 <section class="banner inner-banner-section" style="background-image: url('<?php echo get_field('psycho_banner_image')['url'];?>');">
     <div class="wrapper">
        <?php if(get_field('psycho_banner_title')):?>
         <h1><?php echo get_field('psycho_banner_title');?></h1>
        <?php endif;?>
        <?php if(get_field('psycho_banner_subtitle')):?>
         <h2><?php echo get_field('psycho_banner_subtitle');?></h2>
        <?php endif;?>
     </div>
 </section>
    <?php endif;?>
 <!-- inner banner section end -->

<?php the_breadcrumb(); ?>

<div class="job_section">
    <div class="wrapper d_flex justify_content_sb flex_wrap ">
        <div class="right_col">
            <div class="job_link_list">
            <?php
				wp_nav_menu( array( 'fallback_cb' => 'custom_primary_menu_fallback', 'menu' => 'Psychometry Menu', 'container' => false, 'menu_id' => 'menu', 'menu_class'=>'sidebarMenuDiv', 'theme_location'=>'primary-menu' ) );

						function custom_primary_menu_fallback() {
						  ?>
						  <ul id="menu"><li><a href="/">Home</a></li><li><a href="/wp-admin/nav-menus.php">Set primary menu</a></li></ul>
						  <?php
						}

			   ?>
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

            <?php if(get_field('psycho_sidebar_ad_title') || get_field('psycho_sidebar_ad_link') || get_field('psycho_sidebar_ad_image')): ?>
            <div class="suggestion-box-area">
                <div class=" suggestion-box">
                    <div class="content-box">
                        <div class="box-img">
                            <?php if( get_field('psycho_sidebar_ad_image') ): ?>
                            <img src="<?php echo get_field('psycho_sidebar_ad_image')['url']; ?>" alt="suggestion-box">
                            <?php endif; ?>
                        </div>
                        <?php if( get_field('psycho_sidebar_ad_title') ): ?>
                        <a href="<?php echo get_field('psycho_sidebar_ad_link'); ?>" class="bg-small"><?php echo get_field('psycho_sidebar_ad_title'); ?> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/site/white_arrow.svg" alt="white_arrow">
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <?php if(get_field('psycho_post_content') || get_field('office_image')): ?>
        <div class="left_col">
            <h2 class="h2 h2_right"><?php echo get_the_title(); ?></h2>
            <?php if( get_field('psycho_post_content') ): ?>
                <?php echo get_field('psycho_post_content'); ?>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</div>


<?php
$psycho_radiates_title  = get_field('psycho_title');
$radiates_background    = get_field('psycho_radiates_background');
$radiates_content       = get_field('psycho_radiates_content');
$show_psycho       = get_field('psycho_radiates_show_hide');

if ($radiates_background) {
    $radiates_background = $radiates_background['url'];
}else{
    $radiates_background = "";
}
 ?>

<?php 
if ($show_psycho) {
if($psycho_radiates_title || $radiates_background || $radiates_content):?>
<section class="radiates_blog inner-radiates-blog radiates_blog_new" style="background-image:url(<?php echo $radiates_background; ?>) ;">
    <div class="wrapper">
        <div class="radistes-blog-content">
            <?php if($psycho_radiates_title):?>
            <h3 class="bg-small white_bg"><?php echo $psycho_radiates_title;?></h3>
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
$our_courses_title  = get_field('psycho_our_courses_title', false, false);
$show_courses       = get_field('psycho_show_courses');

if ($show_courses) {
if ($our_courses_title || have_rows('psycho_our_courses', )) { ?>
    <section class="our_courses suggestion-section">
        <div class="wrapper">
            <?php if ( $our_courses_title ) : ?>
            <h2 class="h2"><?php echo $our_courses_title; ?></h2>
            <?php endif; ?>
            <?php if( have_rows('psycho_our_courses', ) ): ?>
                <div class="row suggestion-box-area">
            <?php 
                while ( have_rows('psycho_our_courses', ) ) : the_row();
                    $courses_image = get_sub_field('psycho_courses_image');
                    $courses_title = get_sub_field('psycho_courses_title');
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