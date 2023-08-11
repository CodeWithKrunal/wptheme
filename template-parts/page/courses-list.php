<?php if(get_field('courses_title','option') || get_field('courses_list','option') || get_field('courses_button_label','option') || get_field('courses_button_url','option')):?>
<div class="our_courses inner-our-courses">
    <?php if(get_field('courses_title','option')):?>
    <?php echo get_field('courses_title','option');?>
    <?php endif;?>
    <?php if(get_field('courses_list','option')):?>
    <div class="wrapper owl-carousel courses-row">
        <?php foreach(get_field('courses_list','option') as $course):
        setup_postdata($course);
        $course_image = wp_get_attachment_url( get_post_thumbnail_id($course->ID), 'full' );
                    $course_subtitle = get_field('course_subtitle', $course->ID);
                    $course_persons = get_field('course_persons', $course->ID);
                    $course_duration = get_field('course_duration', $course->ID);
                    $course_date = get_field('course_date', $course->ID);
        ?>
        <div class="colin">
            <div class="col">
                <div class="img" style="background-image:url('<?php echo $course_image;?>');"></div>
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
        <?php endforeach;?>        
    </div>
    <?php endif; ?>
    <?php if(get_field('courses_button_label','option')): ?>
    <a href="<?php echo get_field('courses_button_url','option');?>" class="btn"><span data-svg-img="<?php echo get_template_directory_uri();?>/assets/images/site/btn_arrow.svg"></span><?php echo get_field('courses_button_label','option');?> </a>
    <?php endif; ?>
</div>
<?php endif;?>