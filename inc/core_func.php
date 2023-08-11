<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Theme Core Functions
 *
 */

// disable Gutenberg for posts
add_filter('use_block_editor_for_post', '__return_false', 10);

// disable Gutenberg for post types
add_filter('use_block_editor_for_page', '__return_false', 10);
add_filter('should_load_block_editor_scripts_and_styles', '__return_false', 10);

/** Remove Auto P tag from CF7 */
add_filter('wpcf7_autop_or_not', '__return_false');

show_admin_bar( !wp_is_mobile() && is_user_logged_in() );

//Remove Unnecessary Code
add_action('after_setup_theme', 'cs_remove_unnecessary_code_setup');
function cs_remove_unnecessary_code_setup()
{
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'start_post_rel_link');
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
    add_filter('the_generator', '__return_false');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('set_comment_cookies', 'wp_set_comment_cookies');
    add_filter('jpeg_quality', function () {
        return 85;
    });
}

add_filter('intermediate_image_sizes_advanced', 'morekoren_intermediate_image_sizes_advanced');
function morekoren_intermediate_image_sizes_advanced($sizes)
{
    unset($sizes['thumbnail']); // 150px
    unset($sizes['small']); // 150px
    unset($sizes['medium']); // 300px
    unset($sizes['large']); // 1024px
    unset($sizes['medium_large']); // 768px
    unset($sizes['1536x1536']); // disable 2x medium-large size
    unset($sizes['2048x2048']); // disable 2x large size
    unset($sizes['150x150']); // disable 150px size
    remove_image_size('small');
    remove_image_size('medium');
    remove_image_size('large');
    remove_image_size('medium_large');
    remove_image_size('woocommerce_thumbnail');
    remove_image_size('woocommerce_single');
    remove_image_size('woocommerce_gallery_thumbnail');
    remove_image_size('shop_catalog');
    remove_image_size('shop_single');
    remove_image_size('shop_thumbnail');
    return $sizes;
}

add_filter('init', 'morekoren_remove_image_sizes');
function morekoren_remove_image_sizes()
{
    remove_image_size('small');
    remove_image_size('medium');
    remove_image_size('large');
    remove_image_size('medium_large');
    remove_image_size('woocommerce_thumbnail');
    remove_image_size('woocommerce_single');
    remove_image_size('woocommerce_gallery_thumbnail');
    remove_image_size('shop_catalog');
    remove_image_size('shop_single');
    remove_image_size('shop_thumbnail');
    remove_image_size('2048x2048');
    remove_image_size('1536x1536');
}

// Allow Upload SVG
add_filter('upload_mimes', 'morekoren_mime_types');
function morekoren_mime_types($file_types)
{
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes);
    return $file_types;
}

// exclude theme scandir form optimize speed up
// add_filter( 'theme_scandir_exclusions', 'ws_exclude_dir_scan', 10, 1 );
function ws_exclude_dir_scan($exclusions)
{
    $exclusions[] = 'assets';
    $exclusions[] = 'inc';
    $exclusions[] = 'images';
    $exclusions[] = 'languages';
    $exclusions[] = 'css';
    $exclusions[] = 'js';
    return $exclusions;
}

/**
 * Auto Add Alt to images from iamge title
 */
add_filter('wp_get_attachment_image_attributes', 'auto_add_alt_to_image_from_image_title', 99, 2);
function auto_add_alt_to_image_from_image_title($arr1, $arr2)
{
    if (empty($arr1['alt'])) {
        $arr1['alt'] = $arr2->post_title;
    }
    return $arr1;
}

/**
 * Setup Theme Functions
 */
add_action('after_setup_theme', 'morekoren_theme_setup');
function morekoren_theme_setup()
{

    load_theme_textdomain('morekoren', get_template_directory() . '/languages');
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support( 'post-formats', array(  'video', 'audio' ) );
    add_theme_support('woocommerce');

}

// Register Navigation Menus
add_action('init', 'morekoren_menus');
function morekoren_menus()
{
    $locations = array(
        'header_menu' => __('Header Menu', 'morekoren'),
    );
    register_nav_menus($locations);
}

add_filter( 'get_the_archive_title', function ($title) {    
    if ( is_category() ) {    
            $title = single_cat_title( '', false );    
        } elseif ( is_tag() ) {    
            $title = single_tag_title( '', false );    
        } elseif ( is_author() ) {    
            $title = '<span class="vcard">' . get_the_author() . '</span>' ;    
        } elseif ( is_tax() ) { //for custom post types
            $title = sprintf( __( '%1$s' ), single_term_title( '', false ) );
        } elseif (is_post_type_archive()) {
            $title = post_type_archive_title( '', false );
        }
    return $title;    
});

add_filter( 'comment_form_fields', 'move_comment_field' );
function move_comment_field( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}


function morekoren_get_comment_author_link ($comment) {

    if ($comment->user_id == '0') {
        if (!empty ($comment->comment_author_url)) {
            $url = $comment->comment_author_url;
        } else {
            $url = '#';
        }
    } else {
        $url = get_author_posts_url($comment->user_id);
    }

    echo "<a href=\"" . $url . "\">" .get_comment_author () . "</a>";
}

add_filter( 'cancel_comment_reply_link', '__return_false' );


function getYoutubeEmbedUrlnew($url) {
    $url = parse_url($url);
    $url = $url['path'];
    $url = explode('/', $url);
    $id = $url[count($url) - 1];
    return "https://www.youtube.com/embed/" . $id;
}

add_filter('nav_menu_css_class' , 'special_nav_class' , 50 , 2);
function special_nav_class ($classes, $item) {
  if (in_array('current-menu-item', $classes) ){
    $classes[] = 'active ';
  }
  return $classes;
}

add_action( 'wp_ajax_morekoren_calculate_result', 'morekoren_calculate_result' );
add_action( 'wp_ajax_nopriv_morekoren_calculate_result', 'morekoren_calculate_result' );
function morekoren_calculate_result(){
    $english_input = $_POST['english_input'];
    $quantitaive_think = $_POST['quantitaive_think'];
    $verbal_think = $_POST['verbal_think'];

    $multidisciplinary_score = 0;
    $verbal_emphasis  = 0;
    $quantitative_emphasis = 0;
    if($english_input != '' && $quantitaive_think != '' && $verbal_think != ''){
        $multidisciplinary_score = round(($verbal_think / 46 * 240) + ($quantitaive_think / 40 * 240) + ($english_input / 44 * 120) + 200 , 0);
        $verbal_emphasis = round(($verbal_think / 46 * 360) + ($quantitaive_think / 40 * 120) + ($english_input / 44 * 120) + 200 , 0);
        $quantitative_emphasis = round(($verbal_think / 46 * 120) + ($quantitaive_think / 40 * 360) + ($english_input / 44 * 120) + 200 , 0);
    }
    echo json_encode(
        array(
            'multidisciplinary_score' => $multidisciplinary_score,
            'verbal_emphasis' => $verbal_emphasis,
            'quantitative_emphasis' => $quantitative_emphasis
        )
    );
    exit;
}

add_action( 'wp_footer', 'mycustom_wp_footer' );
function mycustom_wp_footer() {
    if (is_page(561)) {
        ?>
        <script>
            document.addEventListener( 'wpcf7mailsent', function( event ) {
                location = '<?php echo get_the_permalink(1529) ?>';
            }, false );
        </script>
        <?php
    }
}

add_action("wpcf7_before_send_mail", "morekoren_wpcf7_do_something_else");  
function morekoren_wpcf7_do_something_else($cf7) {
    $form_id = $cf7->id();
    $submission = WPCF7_Submission::get_instance();
    $posted_data = $submission->get_posted_data();
    $post_title = $posted_data['page-title'];
    $array = array();
    if($form_id == 5){
        $fullname = $posted_data['your-name'];
        $array['first_name'] = explode(' ', $fullname)[0];
        $array['last_name'] = explode(' ', $fullname)[1];
        $array['phone'] = '';
        $array['email'] = $posted_data['your-email'];
        $array['message'] = $posted_data['your-message'];
    }
    else if($form_id == 922){
        $fullname = $posted_data['text-131'];
        $array['first_name'] = explode(' ', $fullname)[0];
        $array['last_name'] = explode(' ', $fullname)[1];
        $array['phone'] = $posted_data['tel-837'];
        $array['email'] = $posted_data['email-837'];
        $array['message'] = '';
    }
    else if($form_id == 1491){
        $fullname = $posted_data['text-308'];
        $array['first_name'] = explode(' ', $fullname)[0];
        $array['last_name'] = explode(' ', $fullname)[1];
        $array['phone'] = $posted_data['tel-474'];
        $array['email'] = $posted_data['email-169'];
        $array['message'] = $posted_data['textarea-28'];
    }
    else if($form_id == 645){
        $fullname = $posted_data['text-590'];
        $array['first_name'] = explode(' ', $fullname)[0];
        $array['last_name'] = explode(' ', $fullname)[1];
        $array['phone'] = $posted_data['text-591'];
        $array['email'] = '';
        $array['message'] = '';
    }
    else if($form_id == 694){
        $fullname = $posted_data['text-483'];
        $array['first_name'] = explode(' ', $fullname)[0];
        $array['last_name'] = explode(' ', $fullname)[1];
        $array['phone'] = $posted_data['text-484'];
        $array['email'] = '';
        $array['message'] = '';
    }
    else if($form_id == 569){
        $fullname = $posted_data['fullname'];
        $array['first_name'] = explode(' ', $fullname)[0];
        $array['last_name'] = explode(' ', $fullname)[1];
        $array['email'] = $posted_data['email'];
        $array['phone'] = $posted_data['phone'];
        $array['message'] = $posted_data['message'];
    }
    else if($form_id == 2272){
        $fullname = $posted_data['fullname'];
        $array['first_name'] = explode(' ', $fullname)[0];
        $array['last_name'] = explode(' ', $fullname)[1];
        $array['email'] = $posted_data['email'];
        $array['phone'] = $posted_data['phone'];
        $array['message'] = $posted_data['selectinterest'];
    }
    if(!empty($array)){
        $args = array(
            '_cust_fname'=>$array['first_name'],
            '_cust_lname'=>$array['last_name'],
            '_cust_email'=>$array['email'],
            '_cust_mobile'=>$array['phone'],
            '_cust_source'=>'morkoren',
            '_cust_field[12]'=>$array['message'],
            '_cust_token'=>'be0b6d1d79e383314e02ee7e5894aa1b4485f79b',
        );
        $result = wp_remote_post( 'https://wisebox.co.il/index.php/lead_form/recieve_lead', array(
            'body' => $args,
            'timeout' => 15,
            'blocking' => true,
            'headers' => array('Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8'),
        ));
    }
    return $cf7;
}

add_filter('wpcf7_validate_number*', 'koren_number_confirmation_validation_filter', 20, 2);

function koren_number_confirmation_validation_filter($result, $tag) {
    $tag = new WPCF7_FormTag($tag);

    if ('tel-837' == $tag->name) {
        $phone_number = isset($_POST['tel-837']) ? $_POST['tel-837'] : '';
        $number = strlen($phone_number);
        if($number != 10){
            $result->invalidate($tag, "נא להזין עד 10 ספרות בלבד");
        }
    }
    if ('tel-474' == $tag->name) {
        $phone_number = isset($_POST['tel-474']) ? $_POST['tel-474'] : '';
        $number = strlen($phone_number);
        if($number != 10){
            $result->invalidate($tag, "נא להזין עד 10 ספרות בלבד");
        }
    }
    if ('text-484' == $tag->name) {
        $phone_number = isset($_POST['text-484']) ? $_POST['text-484'] : '';
        $number = strlen($phone_number);
        if($number != 10){
            $result->invalidate($tag, "נא להזין עד 10 ספרות בלבד");
        }
    }
    if ('phone' == $tag->name) {
        $phone_number = isset($_POST['phone']) ? $_POST['phone'] : '';
        $number = strlen($phone_number);
        if($number != 10){
            $result->invalidate($tag, "נא להזין עד 10 ספרות בלבד");
        }
    }
    if ('text-591' == $tag->name) {
        $phone_number = isset($_POST['text-591']) ? $_POST['text-591'] : '';
        $number = strlen($phone_number);
        if($number != 10){
            $result->invalidate($tag, "נא להזין עד 10 ספרות בלבד");
        }
    }
    return $result;
}