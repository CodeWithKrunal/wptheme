<?php  

    $banner_image   = get_sub_field('banner_image');
    $top_content    = get_sub_field('top_content');
    $banner_title   = get_sub_field('banner_title');
    $bottom_content = get_sub_field('bottom_content');
    $buttons        = get_sub_field('buttons');

    if ($banner_image) {
        $banner_image = 'style="background-image: url('.$banner_image["url"].');"';
    }else{
        $banner_image = '';
    }

    if ($banner_image || $top_content ||$banner_title ||$bottom_content || $buttons) { ?>
    <!-- Hero Banner Start -->
    <section class="banner-section hero-section bg-set" <?php echo $banner_image; ?>>
        <div class="container">
            <div class="row">
                <div class="col-5">
                    <?php if ( $top_content ) : ?>
                        <div class="welcome-text"><?php echo $top_content; ?></div>
                    <?php endif; ?>
                    <?php if ( $banner_title ) : ?>
                    <h1><?php echo $banner_title; ?></h1>
                    <?php endif; ?>
                    <?php if ( $bottom_content ) : ?>
                        <div class="subTitle-text"><?php echo $bottom_content; ?></div>
                    <?php endif; ?>
                    
                    <?php 
                        if( have_rows('buttons') ):
                            echo '<ul class="btn-row unlisted d-flex flex-wrap align-items-center">';
                            while ( have_rows('buttons') ) : the_row();

                                $white_background = get_sub_field('white_background');
                                if ($white_background) { $white_background = 'btn-border'; }else{ $white_background = ''; }  
                                
                                $banner_buttons = get_sub_field('banner_buttons');
                                $banner_buttons_tar          = ($banner_buttons["target"])?$banner_buttons["target"]:"_self";
                                
                                echo '<li><a class="btn '.$white_background.'" href="'.$banner_buttons["url"].'" target="'.$banner_buttons_tar.'">'.$banner_buttons["title"].'</a></li>';
                            endwhile;
                            echo '</ul>';
                        endif;
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Banner End-->
    <?php } ?>