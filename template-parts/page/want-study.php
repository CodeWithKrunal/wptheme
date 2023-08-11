<?php 
    $add_study_content = get_field('add_study_content', 'option');
    $add_study = get_field('add_study', 'option');

if ($add_study_content || $add_stu) {
    # code...
}
?>
<div class="blank_div"></div>
<div class="want_study_blog">
    <div class="wrapper d_flex justify_content_sb align_items_c">
        <?php if ( $add_study_content ) : ?>
        <div class="col_right">
            <?php echo $add_study_content; ?>
        </div>
        <?php endif; ?>
        
        <?php if( have_rows('add_study', 'option') ): ?>
            <div class="col_left d_flex justify_content_sb ">
        <?php 
            while ( have_rows('add_study', 'option') ) : the_row();
                $want_study_image   = get_sub_field('want_study_image');
                $want_study_content = get_sub_field('want_study_content');
            ?>                            
                <div class="col">
                    <?php if ( $want_study_image ) : ?>
                        <img src="<?php echo $want_study_image['url'] ?>" alt="<?php echo $want_study_image['alt'] ?>">
                    <?php endif; ?>
                    <?php if ( $want_study_content ) : ?>
                        <?php echo $want_study_content; ?>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
    </div>
</div>