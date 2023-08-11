<?php $shop_id = woocommerce_get_page_id('shop'); ?> 
<!-- inner banner section -->
<?php if(get_field('banner_image',$shop_id) || get_field('banner_title',$shop_id) || get_field('banner_sub_title',$shop_id)): ?>
<section class="banner inner-banner-section" style="background-image: url('<?php echo get_field('banner_image',$shop_id)['url'];?>');">
    <div class="wrapper">
        <?php if(get_field('banner_title',$shop_id)): ?>
        <h1><?php echo get_field('banner_title',$shop_id);?> </h1>
        <?php endif; ?>
        <?php if(get_field('banner_sub_title',$shop_id)): ?>
        <h2><?php echo get_field('banner_sub_title',$shop_id);?></h2>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>
<!-- inner banner section end -->