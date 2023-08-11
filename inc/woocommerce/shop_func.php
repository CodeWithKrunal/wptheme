<?php  
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );

add_action('woocommerce_before_main_content','koren_add_banner_section_shop', 10);
function koren_add_banner_section_shop() {
    if ( is_shop() || is_product()) {
        wc_get_template_part( 'content', 'banner-shop' );
        the_breadcrumb();
    }
}
add_action('woocommerce_before_main_content','koren_add_divs_loop_start', 20);
function koren_add_divs_loop_start(){
  if(is_shop()){
    $shop_id = woocommerce_get_page_id('shop');
    echo '<div class="book_store">
    <div class="wrapper">';
    if(get_field('page_title',$shop_id)):
       echo '<h2 class="h2 h2_right">'.get_field('page_title',$shop_id).'</h2>';
    endif;
    if(get_field('page_content',$shop_id)):
        echo get_field('page_content',$shop_id);
    endif;
  }
}
add_action('woocommerce_after_main_content','koren_close_divs_loop_end', 11);
function koren_close_divs_loop_end(){
  if(is_shop()){
    echo '</div></div>';
  }
}
add_action('woocommerce_before_shop_loop_item_title','koren_add_div_before_loop_image',9);
function koren_add_div_before_loop_image(){
    echo '<div class="img">';
}
add_action('woocommerce_before_shop_loop_item_title','koren_close_div_after_loop_image',11);
function koren_close_div_after_loop_image(){
    echo '</div>';
}
remove_action( 'woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
add_action('woocommerce_shop_loop_item_title', 'koren_template_loop_product_title', 10 );
function koren_template_loop_product_title() {
    echo '<h3>' . get_the_title() . '</h3>';
    if(get_field('kit_includes')):
        echo '<p> הערכה כוללת :<br>'.get_field('kit_includes').'</p>';
    endif;
    $price = get_post_meta( get_the_ID(), '_regular_price', true); // Retrive products regular price
    $sale_price = get_post_meta( get_the_ID(), '_sale_price', true); // Retrive products regular price
    if($sale_price != '' && $sale_price < $price){
        $price = '<div class="price">
        <span class="rightpr"><strong>'.wc_price( $sale_price ).'</strong></span>
        <span class="leftpr">'.wc_price( $price ).'</span>
        </div>';
    }
    else{
        $price = '<div class="price">
        <span class="rightpr"><strong>'.wc_price( $price ).'</strong></span>
                    </div>';
                }
                echo $price;
}
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
add_action('woocommerce_after_shop_loop_item','koren_add_readmore_btn_atlast_loop');
function koren_add_readmore_btn_atlast_loop(){
    echo '<a href="'.get_permalink().'" class="btn">פרטים נוספים</a>';
}


add_action( 'wp_ajax_koren_ajax_filter_shop', 'koren_ajax_filter_shop' );
add_action( 'wp_ajax_nopriv_koren_ajax_filter_shop', 'koren_ajax_filter_shop' );
function koren_ajax_filter_shop(){
  $catid = $_POST['catid'];
  $page = $_POST['paged'];
  $args = array(
    'post_type' => 'product',
    'post_status' => 'publish',
    'posts_per_page' => 12,
    'paged' => $page,
    'orderby' => 'menu_order  post_title',
    'order' => 'ASC',
  );
  $args['tax_query'] = array(
    array(
      'taxonomy' => 'product_cat',
      'field' => 'slug',
      'terms' => array( 'courses' ), 
      'operator' => 'NOT IN'
    )
    );
  if($catid > 0){
    $args['tax_query'] = array(
      array(
        'taxonomy' => 'product_cat',
        'field' => 'term_id',
        'terms' => $catid
      )
      );
  }
  $loop = new WP_Query($args);
  $max = $loop->max_num_pages;
  $html = '';
  if($loop->have_posts()){
    while($loop->have_posts()){
      $loop->the_post();
      $html .= wc_get_template_html( 'content-product.php', array(
        'product' => $loop->post,
        'class' => ''
      ) );
    }
  }
  else{
    $html .= '<div class="no_product_found">
    <div class="not_fouund_img">
        <img src="'.get_template_directory_uri().'/assets/images/site/noproduct.png" alt="">
    </div>
    <h3>לא נמצאו מוצרים התואמים את בחירתך.</h3>
</div>';
  }
  wp_reset_postdata();
  $array = array('html' => $html,'max' => $max);
  echo json_encode($array);
  die();
}

function morekoren_shoppage_pre_get_posts_query( $q ) {

  $tax_query = (array) $q->get( 'tax_query' );

  $tax_query[] = array(
         'taxonomy' => 'product_cat',
         'field' => 'slug',
         'terms' => array( 'courses' ), 
         'operator' => 'NOT IN'
  );


  $q->set( 'tax_query', $tax_query );

}
add_action( 'woocommerce_product_query', 'morekoren_shoppage_pre_get_posts_query' );  