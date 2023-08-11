<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
    <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes">
    <meta http-equiv="x-ua-compatible" content="IE=Edge">
    <meta name="description" content="<?php bloginfo( 'name' ); ?>" /> 

    <!-- Chrome, Firefox OS, Opera and Vivaldi -->
    <meta name="theme-color" content="#000">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#000">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#000">

    <!-- Social Meta tags -->
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php bloginfo( 'name' ); ?>" />
    <meta property="og:description" content="<?php bloginfo( 'description' ); ?>" />
    <meta property="og:url" content="<?php bloginfo( 'url' ); ?>" />
    <meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>" />
    <meta property="og:image" itemprop="image" content="<?php echo get_template_directory_uri(); ?>/screenshot.png">
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content="<?php bloginfo( 'name' ); ?>" />
    <meta name="twitter:title" content="<?php bloginfo( 'name' ); ?>" />
    
    <!-- Favicon -->
    <link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/site/favicon.ico" color="white"> 
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/site/favicon.ico" type="image/x-icon">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
        <!-- FULL WRAPPER-->
        <div id="full_wrapper">
            <!-- HEADER -->
            <a href="javascript:void(0)" class="hamburger"><span></span></a>
            <header>
                <div class="top_col">
                    <div class="wrapper d_flex justify_content_sb align_items_c">
                        <?php 
                        if( have_rows('social_icon', 'option') ): ?>
                            <div class="social_icon">
                            <?php 
                            while ( have_rows('social_icon', 'option') ) : the_row();
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
                                } 
                            endwhile; ?>
                        </div>
                        <?php endif; ?>
                        
                        <div class="link">
                            <?php if ( is_user_logged_in() ) { ?>
                            <a href="<?php echo home_url()."/my-account" ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/site/user.png" alt="user" >
                                <?php global $current_user;
                                if(is_user_logged_in()){
                                    echo $current_user->display_name;
                                } ?>
                            </a>
                            <?php }else{
                            ?>
                                <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id'));?>">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/site/user.png" alt="user" >כניסת תלמידים                                               
                                </a>
                            <?php
                            } ?>

                            <?php 
                                $email_text = get_field('email_text', 'option');
                                $email = get_field('email', 'option');
                                $phone = get_field('phone', 'option');
                                if ($email_text || $email) {
                                    if ($email) {
                                        echo '<a href="'.$email.'"><img src="'.get_template_directory_uri().'/assets/images/site/email.png" alt="email" >'.$email_text.'</a>';
                                    }else if($email_text){
                                        echo '<a href="javascript:void(0)"><img src="'.get_template_directory_uri().'/assets/images/site/email.png" alt="email" >'.$email_text.'</a>';
                                    }
                                }
                            
                            if ($phone) { ?> <a href="tel:<?= preg_replace('/(\W*)/', '', $phone ); ?>"> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/site/tell.png" alt="tell" ><?= $phone ?></a> <?php  } ?>
                        </div>
                    </div>
                </div>
                <div class="bottom_col">
                    <div class="wrapper d_flex justify_content_fs align_items_c">

                        <?php if ( get_field( 'header_logo', 'options' ) ) : ?>
                            <a href="<?php bloginfo('url'); ?>" class="brand"><img src="<?php echo get_field( 'header_logo', 'options' )["url"]; ?>" alt="<?php if(isset(get_field( 'header_logo', 'options' )["alt"]) && get_field( 'header_logo', 'options' )["alt"] ){ echo get_field( 'header_logo', 'options' )["alt"]; }else{ bloginfo('name'); } ?>"></a>
                        <div class="mobile_menu">
                            <div class="bg"></div>   
                            <div class="inner">
                            <div class="link">
                            <?php if ( is_user_logged_in() ) { ?>
                            <a href="<?php echo home_url()."/my-account" ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/site/user.png" alt="user" >
                                <?php global $current_user;
                                if(is_user_logged_in()){
                                    echo $current_user->display_name;
                                } ?>
                            </a>
                            <?php }else{
                            ?>
                                <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id'));?>">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/site/user.png" alt="user" >כניסת תלמידים                                               
                                </a>
                            <?php
                            } ?>

                            <?php 
                                $email_text = get_field('email_text', 'option');
                                $email = get_field('email', 'option');
                                $phone = get_field('phone', 'option');
                                if ($email_text || $email) {
                                    if ($email) {
                                        echo '<a href="'.$email.'"><img src="'.get_template_directory_uri().'/assets/images/site/email.png" alt="email" >'.$email_text.'</a>';
                                    }else if($email_text){
                                        echo '<a href="javascript:void(0)"><img src="'.get_template_directory_uri().'/assets/images/site/email.png" alt="email" >'.$email_text.'</a>';
                                    }
                                }
                            
                            if ($phone) { ?> <a href="tel:<?= preg_replace('/(\W*)/', '', $phone ); ?>"> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/site/tell.png" alt="tell" ><?= $phone ?></a> <?php  } ?>
                        </div>
                            
                        <?php endif; 

                            wp_nav_menu(array(
                                'theme_location'    => 'header_menu',
                                'container'         => 'nav',
                                'container_class'   => '',
                                'menu_class'        => 'd_flex justify_content_fs align_items_c'
                            )); 
                        ?>
                       
                        <?php 
                        if( have_rows('social_icon', 'option') ): ?>
                            <div class="botton_social_link">
                            <?php 
                            while ( have_rows('social_icon', 'option') ) : the_row();
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
                                } 
                            endwhile; ?>
                        </div>
                        <?php endif; ?>
                        </div>
                        </div>
                        <a href="javascript:void(0)" class="cart_icon">
                            <span class="mini-cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/site/cart_icon.png" alt="cart_icon">
                        </a>
                            
                    </div>
                </div>                
            </header>
            <div id="mini_cart" class="cart_section">
                <div class="widget_shopping_cart_content"><?php woocommerce_mini_cart(); ?></div>
            </div>
            <!---->
            <div class="main">