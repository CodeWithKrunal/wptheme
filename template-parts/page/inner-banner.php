 <!-- inner banner section -->
 <?php if(get_field('inner_page_banner_image','option') || get_field('inner_page_banner_title','option') || get_field('inner_page_banner_subtitle','option')):?>
 <section class="banner inner-banner-section" style="background-image: url('<?php echo get_field('inner_page_banner_image','option')['url'];?>');">
     <div class="wrapper">
        <?php if(get_field('inner_page_banner_title','option')):?>
         <h1><?php echo get_field('inner_page_banner_title','option');?></h1>
        <?php endif;?>
        <?php if(get_field('inner_page_banner_subtitle','option')):?>
         <h2><?php echo get_field('inner_page_banner_subtitle','option');?></h2>
        <?php endif;?>
     </div>
 </section>
    <?php endif;?>
 <!-- inner banner section end -->