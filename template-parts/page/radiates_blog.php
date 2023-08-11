<?php

$radiates_background    = get_field('radiates_background', 'option');
$radiates_content       = get_field('radiates_content', 'option');

if ($radiates_background) {
    $radiates_background = $radiates_background['url'];
}else{
    $radiates_background = "";
}

if ($radiates_background || $radiates_content) { ?>
    <!-- good to know section start -->
    <section class="radiates_blog inner-radiates-blog book_blog" style="background-image:url(<?php echo $radiates_background; ?>) ;">
        <div class="wrapper">
        <?php if ( $radiates_content ) : ?>
            <div class="radistes-blog-content">
                <?php echo $radiates_content; ?>
            </div>
        <?php endif; ?>
        </div>
    </section>
    <!-- good to know section end -->
<?php } ?>