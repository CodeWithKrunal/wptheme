<?php 
if(!is_user_logged_in()){
    wp_redirect( get_permalink( get_option('woocommerce_myaccount_page_id') ) );
}
$user = wp_get_current_user();
$user_id = $user->ID;
global $wpdb;
    $querystr = "select
       p.ID as order_id
    from
       wp_posts as p,
       wp_postmeta as pm,
       wp_woocommerce_order_items as i,
       wp_woocommerce_order_itemmeta as im
    where
       p.post_type = 'shop_order'
       and p.post_status IN ('wc-processing','wc-completed')
       and p.ID = pm.post_id
       and p.ID = i.order_id
       and i.order_item_id = im.order_item_id
       and pm.meta_key = '_customer_user'
       and pm.meta_value = $user_id
       and im.meta_key = 'online_course'
       and im.meta_value = ".get_the_ID();
    $orders = $wpdb->get_results($querystr);
    if(empty($orders)){
        wp_redirect( home_url());
    }
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
    <?php if(get_field('good_to_know_section')):?>
    <?php get_template_part('template-parts/page/good-know');  ?>
    <?php endif;?>
   
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