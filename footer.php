</div>
            <div class="push"><!-- --></div>
        </div>
<?php 

    $footer_logo = get_field('footer_logo', 'option');
    $footer_content = get_field('footer_content', 'option');
    $menu_one_title = get_field('menu_one_title', 'option');
    $menu_one_links = get_field('menu_one_links', 'option');
    $menu_two_title = get_field('menu_two_title', 'option');
    $menu_two_links = get_field('menu_two_links', 'option');
    $menu_three_title = get_field('menu_three_title', 'option');
    $menu_three_links = get_field('menu_three_links', 'option');
    $menu_four_title = get_field('menu_four_title', 'option');
    $menu_four_links = get_field('menu_four_links', 'option');
    $menu_five_title = get_field('menu_five_title', 'option');
    $menu_five_links = get_field('menu_five_links', 'option');
    $contact_text = get_field('contact_text', 'option');
    $social_text = get_field('social_text', 'option');
    $copyright_text = get_field('copyright_text', 'option');
    $development_stote_link = get_field('development_stote_link', 'option');

?>    
        <!-- FOOTER -->
        <footer>
            <div class="wrapper top_footer d_flex justify_content_sb flex_wrap">
                <div class="col_right">
                    <?php if ( get_field( 'header_logo', 'options' ) ) : ?>
                        <a href="<?php bloginfo('url'); ?>" class="footer_logo"><img src="<?php echo get_field( 'header_logo', 'options' )["url"]; ?>" alt="<?php if(isset(get_field( 'header_logo', 'options' )["alt"]) && get_field( 'header_logo', 'options' )["alt"] ){ echo get_field( 'header_logo', 'options' )["alt"]; }else{ bloginfo('name'); } ?>"></a>
                    <?php endif; ?>
                   
                    <?php if ( $footer_content ) : ?>
                    <?php echo $footer_content; ?>
                    <?php endif; ?>
                    
                    <div class="contect">
                        <?php if ( $contact_text ) : ?>
                            <h3><?php echo $contact_text; ?></h3>
                        <?php endif; ?>
                        <?php 
                            $footer_email = get_field('footer_email', 'option');
                            $phone = get_field('footer_phone', 'option');
                            
                            if ($phone) { ?> <a href="tel:<?= preg_replace('/(\W*)/', '', $phone ); ?>"> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/site/f_tel.png" alt="tell" ><?= $phone ?></a></br> <?php  } 

                            if ($footer_email) {
                                echo '<a href="mailto:'.$footer_email.'"><img src="'.get_template_directory_uri().'/assets/images/site/f_mail.png" alt="email" >'.$footer_email.'</a>';
                            }
                        ?>
                    </div>
                </div>
                <div class="col_left d_flex justify_content_sb flex_wrap">
                    <?php if ( $menu_one_title || $menu_one_links) : ?>
                        <ul>
                            <li><strong><?php echo ($menu_one_title)? $menu_one_title : '' ; ?></strong></li>
                            <?php if ( $menu_one_links ) : 
                                foreach ($menu_one_links as $key => $value) {
                                    $add_link     = $value['add_menu_link'];
                                    $add_link_tar = ($add_link["target"])? $add_link["target"]:"_self";
                                    echo '<li><a class="" href="'.$add_link["url"].'" target="'.$add_link_tar.'">'.$add_link["title"].'</a></li>';
                                }
                            endif; ?>
                        </ul>
                    <?php endif; ?>
                        
                    <?php if ( $menu_two_title || $menu_two_links) : ?>
                        <ul>
                            <li><strong><?php echo ($menu_two_title)? $menu_two_title : '' ; ?></strong></li>
                            <?php if ( $menu_two_links ) : 
                                foreach ($menu_two_links as $key => $value) {
                                    $add_link     = $value['add_menu_link'];
                                    $add_link_tar = ($add_link["target"])? $add_link["target"]:"_self";
                                    echo '<li><a class="" href="'.$add_link["url"].'" target="'.$add_link_tar.'">'.$add_link["title"].'</a></li>';
                                }
                            endif; ?>
                        </ul>
                    <?php endif; ?>

                    <?php if ( $menu_three_title || $menu_three_links) : ?>
                        <ul>
                            <li><strong><?php echo ($menu_three_title)? $menu_three_title : '' ; ?></strong></li>
                            <?php if ( $menu_three_links ) : 
                                foreach ($menu_three_links as $key => $value) {
                                    $add_link     = $value['add_menu_link'];
                                    $add_link_tar = ($add_link["target"])? $add_link["target"]:"_self";
                                    echo '<li><a class="" href="'.$add_link["url"].'" target="'.$add_link_tar.'">'.$add_link["title"].'</a></li>';
                                }
                            endif; ?>
                        </ul>
                    <?php endif; ?>

                    <?php if ( $menu_four_title || $menu_four_links) : ?>
                        <ul>
                            <li><strong><?php echo ($menu_four_title)? $menu_four_title : '' ; ?></strong></li>
                            <?php if ( $menu_four_links ) : 
                                foreach ($menu_four_links as $key => $value) {
                                    $add_link     = $value['add_menu_link'];
                                    $add_link_tar = ($add_link["target"])? $add_link["target"]:"_self";
                                    echo '<li><a class="" href="'.$add_link["url"].'" target="'.$add_link_tar.'">'.$add_link["title"].'</a></li>';
                                }
                            endif; ?>
                        </ul>
                    <?php endif; ?>

                    <?php if ( $menu_five_title || $menu_five_links) : ?>
                        <ul>
                            <li><strong><?php echo ($menu_five_title)? $menu_five_title : '' ; ?></strong></li>
                            <?php if ( $menu_five_links ) : 
                                foreach ($menu_five_links as $key => $value) {
                                    $add_link     = $value['add_menu_link'];
                                    $add_link_tar = ($add_link["target"])? $add_link["target"]:"_self";
                                    echo '<li><a class="" href="'.$add_link["url"].'" target="'.$add_link_tar.'">'.$add_link["title"].'</a></li>';
                                }
                            endif; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
            <div class="bottom_col">
                <?php if ( $social_text ) : ?>
                <h3><?php echo $social_text; ?></h3>
                <?php endif; ?>

               
                <?php 

                if( have_rows('footer_social_icon', 'option') ): ?>
                    <div class="inner d_flex justify_content_c align_items_c">
                    <?php 
                    while ( have_rows('footer_social_icon', 'option') ) : the_row();
                    
                        $icon_image = get_sub_field('icon_image');
                        $icon_link  = get_sub_field('icon_link');
                        $contactImg     =  '';
                        
                        if ($icon_image) { 
                            $contactImg = '<img src="'.$icon_image["url"].'" alt="'.$icon_image["alt"].'">'; 
                        }else if($icon_link){
                            $contactImg = $icon_link["title"]; 
                        } 
                        if ($icon_link) {
                            $icon_link_tar = ($icon_link["target"])?$icon_link["target"]:"_self";
                            echo '<a href="'.$icon_link["url"].'" target="'.$icon_link_tar.'">'.$contactImg.'</a>';
                        }elseif ($icon_image) {
                            echo '<a href="javascript:void(0)">'.$contactImg.'</a>';
                        } 
                    endwhile; ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="copyright-back">
                <?php if ( $copyright_text ) : ?>
                    <p><?php echo $copyright_text; ?></p>
                <?php endif; ?>
                <?php if($development_stote_link):?>
                        <p>
                        פיתוח ועיצוב חנויות און ליין   
                        <a href="<?php echo $development_stote_link['url'];?>" target="<?php echo $development_stote_link['target'];?>" class="development-link">
                                <?php echo $development_stote_link['title'];?>
                            </a>
                            בע"מ
                    </p>
                <?php endif;?>
            </div>
        </footer>
        <div id="common_footer_from" class="common_foo_form">
            <div class="wrapper">
                <div class="form-area">
                    <div class="mobile_area">
                        <a href="javascript:;" class="open_form"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/site/icon-circle-plus-yellow.svg" alt="plus"></a>
                        <?php if(get_field( 'footer_form_title', 'options'  )): ?><h3><?php the_field( 'footer_form_title', 'options' ); ?></h3><?php endif; ?>
                    </div>
                   <div class="deska_area">
                    <?php if(get_field( 'footer_form_title', 'options'  )): ?><h3><?php the_field( 'footer_form_title', 'options' ); ?></h3><?php endif; ?>
                        <?php 
						if ( is_singular( 'morekoren_jobs' ) ) {
							echo do_shortcode( '[contact-form-7 id="2977" title="Common Form_copy"]' );							
						} else {
                            $posts = get_field('common_footer_form', 'options' );
                            if( $posts ): 
                                foreach( $posts as $p ): // variable must NOT be called $post (IMPORTANT) 
                                    $cf7_id= $p->ID;
                                        echo do_shortcode( '[contact-form-7 id="'.$cf7_id.'" ]' ); 
                                endforeach;     
                            endif;  
						}
                        ?>
                   </div>
                </div>
            </div>
        </div>
        <div id="mobile_con_form" class="common_foo_form">
            <div class="form-area">
            <a href="javascript:;" class="close_form"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/site/mobile-x-black.svg" alt="plus"></a>
                <?php if(get_field( 'footer_form_title', 'options'  )): ?><h3><?php the_field( 'footer_form_title', 'options' ); ?></h3><?php endif; ?>
                <?php 
                    $posts = get_field('common_footer_form', 'options' );
                    if( $posts ): 
                        foreach( $posts as $p ): // variable must NOT be called $post (IMPORTANT) 
                            $cf7_id= $p->ID;
                                echo do_shortcode( '[contact-form-7 id="'.$cf7_id.'" ]' );
                        endforeach;    
                    endif;              
                ?>
            </div>
        </div>
    <?php wp_footer(); ?>
    </body>
</html>