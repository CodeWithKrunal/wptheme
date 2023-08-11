<?php
/**
 * Template Name: Phycometric Score Calculator
 *
 * @package WordPress
 * @subpackage morekoren
 * @since morekoren 1.0
 */
get_header(); ?>
<?php if(get_field('score_banner_image') || get_field('score_banner_title') || get_field('score_banner_sub_title')): ?>
<!-- inner banner section -->
<section class="banner inner-banner-section"
    style="background-image: url('<?php echo get_field('score_banner_image')['url'];?>');">
    <div class="wrapper">
        <?php if(get_field('score_banner_title')): ?>
        <h1><?php echo get_field('score_banner_title');?></h1>
        <?php endif; ?>
        <?php if(get_field('score_banner_sub_title')): ?>
        <h2><?php echo get_field('score_banner_sub_title');?> </h2>
        <?php endif; ?>
    </div>
</section>
<!-- inner banner section end -->
<?php endif; ?>

<?php the_breadcrumb();?>

<?php if(get_field('score_header_title') || get_field('score_content') ): ?>
<div class="psychometric_calculator">
    <div class="wrapper">
        <?php if(get_field('score_header_title')): ?>
        <h2 class="h2_right h2"><?php echo get_field('score_header_title'); ?></h2>
        <?php endif; ?>

        <?php if(get_field('score_content')): ?>
        <?php echo get_field('score_content',false,false); ?>
        <?php endif; ?>

    </div>
</div>
<?php endif; ?>

<div class="calculator_blog">
    <div class="wrapper d_flex justify_content_sb flex_wrap">
        <div class="right_col">
            <?php if( get_field('grade_calculator_title') ): ?>
            <h2><?php echo get_field('grade_calculator_title'); ?></h2>
            <?php endif; ?>
            <?php if( get_field('grade_calculator_sub_title') ): ?>
            <p><?php echo get_field('grade_calculator_sub_title'); ?></p>
            <?php endif; ?>
            <form action="" id="calculate_form" method="post">
                <div class="calculate_form">
                    <div class="colin">
                        <span>חשיבה מילולית</span>
                        <input type="number" name="verbal_think" id="verbal_think" class="in">
                        <span class="error_msg error" id="verbal_error_msg"></span>
                    </div>
                    <div class="colin">
                        <span>חשיבה כמותית</span>
                        <input type="number" name="quantitaive_think" id="quantitaive_think" class="in">
                        <span class="error_msg error" id="quantitaive_error_msg"></span>
                    </div>
                    <div class="colin">
                        <span>אנגלית</span>
                        <input type="number" name="english_input" id="english_input" class="in">
                        <span class="error_msg error" id="english_error_msg"></span>
                    </div>
                    <button type="submit" class="total calculate_btn">חשב ציון</button>
                </div>
            </form>
        </div>
        <div class="left_col">
            <?php if(get_field('estimate_title')): ?>
            <h2><?php echo get_field('estimate_title'); ?></h2>
            <?php endif; ?>

            <ul>
                <li>דגש על הרב תחומי <em id="multidisciplinary_score">0</em></li>
                <li>דגש מילולי <em id="verbal_emphasis">0</em></li>
                <li>דגש כמותי <em id="quantitative_emphasis">0</em></li>
            </ul>

            <div class="contct_cal">
                <?php if(get_field('estimate_contact_form_title')): ?>
                <p><?php echo get_field('estimate_contact_form_title'); ?></p>
                <?php endif; ?>
                <?php if(get_field('estimate_contact_form')): ?>
                <?php 
                        $id     = get_field( 'estimate_contact_form')[0]->ID;                        
                        $title 	= get_the_title($id);
                        echo do_shortcode('[contact-form-7 id="'.$id.'" title="'.$title.'"]');                         
                    ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php if(get_field('for_example_title') || get_field('for_example_content') ): ?>
<div class="calculator_example">
    <div class="wrapper">
        <?php if(get_field('for_example_title')): ?>
        <h3><?php echo get_field('for_example_title'); ?></h3>
        <?php endif; ?>

        <?php if(get_field('for_example_content',false,false)): ?>
        <?php echo get_field('for_example_content'); ?>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>

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

<!-- pur course section stop -->
<?php if(get_field('location_section')): ?>
<?php get_template_part('template-parts/page/want-study');  ?>
<?php endif; ?>

<?php get_footer();