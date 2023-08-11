<?php global $product;?>
<div class="psychometric_preparation_course">
     <div class="wrapper">
         <div class="colin">
             <h2 class="h2 h2_right"><?php the_title();?></h2>
             <?php the_content();?>
             <div class="list">
                <?php if(get_field('course_date')):?>
                 <span><img src="<?php echo get_template_directory_uri() ?>/assets/images/site/ll4.png" alt=""> עדכון אחרון <?php echo get_field('course_date');?></span>
                <?php endif;?>
                <?php if(get_field('course_language')):?>
                 <span><img src="<?php echo get_template_directory_uri() ?>/assets/images/site/ll5.png" alt=""> <?php echo get_field('course_language');?></span>
                <?php endif;?>
                <?php if(get_field('course_persons')):?>
                 <span><img src="<?php echo get_template_directory_uri() ?>/assets/images/site/ll6.png" alt=""> למעלה מ <?php echo get_field('course_persons');?> תלמידים</span>
                <?php endif;?>
             </div>
         </div>
     </div>
 </div>
 <section class="course_structure_blog">
     <div class="wrapper d_flex justify_content_sb flex_wrap">
         <div class="right_col">
            <?php if(get_field('course_structure_title')):?>
             <h2 class="h2 h2_right"><?php echo get_field('course_structure_title');?></h2>
            <?php endif;?>
            <?php if(get_field('course_structure_content')):?>
                <?php echo get_field('course_structure_content');?>
            <?php endif;?>
            <?php if(have_rows('course_structure_list')):?>
             <div class="course_structure_col d_flex justify_content_sb flex_wrap">
                <?php while(have_rows('course_structure_list')):the_row();?>
                 <div class="colin">
                    <?php if(get_sub_field('icon')):?>
                     <img src="<?php echo get_sub_field('icon')['url'];?>" alt="<?php echo get_sub_field('icon')['alt'];?>">
                    <?php endif;?>
                    <?php if(get_sub_field('title')):?>
                     <h4><?php echo get_sub_field('title');?></h4>
                    <?php endif;?>
                 </div>
                <?php endwhile;?>
             </div>
            <?php endif;?>
         </div>
         <div class="left_col">
             <div class="mix_commen">
             <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' ); ?>
                 <div class="video_mix d_flex justify_content_c align_items_c"
                     style="background-image:url('<?php echo $url;?>');">
                     <?php if(get_field('course_youtube_url')):
                            $video_url = getYoutubeEmbedUrlnew(get_field('course_youtube_url'));
                        ?>
                     <a href="<?php echo $video_url;?>" data-title="title will goes here"
                         data-rel="Shadowbox;player=iframe;width=985px;height=460px;">
                         <img src="<?php echo get_template_directory_uri() ?>/assets/images/site/v_mix_icon.png" alt="">
                     </a>
                     <?php endif; ?>
                 </div>
                 <div class="price_mix">
                     <div class="price">
                         <?php echo $product->get_price_html();?>
                     </div>
                     <?php if(get_field('course_price_time_period')):?>
                     <label class="price_text"><?php echo get_field('course_price_time_period');?></label>
                     <?php endif;?>
                     <?php woocommerce_template_single_add_to_cart();?>
                    <?php if(get_field('course_terms_text')):?>
                     <?php echo get_field('course_terms_text');?>
                    <?php endif;?>
                 </div>
                 <?php if(get_field('course_include_title')):?>
                 <h3><?php echo get_field('course_include_title');?></h3>
                <?php endif;?>
                <?php if(have_rows('course_include_list')):?>
                 <ul class="course_includes">
                    <?php while(have_rows('course_include_list')):the_row();?>
                     <li>
                        <?php if(get_sub_field('icon')):?>
                        <img src="<?php echo get_sub_field('icon')['url'];?>" alt="<?php echo get_sub_field('icon')['alt'];?>"> <?php endif;?> <?php echo get_sub_field('title');?>
                    </li>
                     <?php endwhile;?>  
                 </ul>
                 <?php endif; ?>

                 <div class="social_col d_flex justify_content_sb align_items_c">
                     <a href="https://twitter.com/share?url=<?php echo get_permalink();?>&text=<?php echo get_the_title();?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" data-svg-img="<?php echo get_template_directory_uri() ?>/assets/images/site/msc1.svg"></a>
                     <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink();?>&t=<?php echo get_the_title();?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" data-svg-img="<?php echo get_template_directory_uri() ?>/assets/images/site/msc2.svg"></a>
                     <a href="https://plus.google.com/share?url=<?php echo get_permalink();?>" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" data-svg-img="<?php echo get_template_directory_uri() ?>/assets/images/site/msc3.svg"></a>
                     <a href="whatsapp://send?text=<?php echo get_permalink();?>" data-action="share/whatsapp/share" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" data-svg-img="<?php echo get_template_directory_uri() ?>/assets/images/site/msc4.svg"></a>
                 </div>
             </div>
         </div>
     </div>
 </section>
<?php get_template_part('template-parts/page/radiates_blog');  ?>
<?php get_template_part('template-parts/page/our_course');  ?>
<?php get_template_part('template-parts/page/want-study');  ?>