<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
// Remove each style one by one
add_filter( 'woocommerce_enqueue_styles', 'morekoren_dequeue_styles' );
function morekoren_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] );    // Remove the gloss
	unset( $enqueue_styles['woocommerce-layout'] );     // Remove the layout
	unset( $enqueue_styles['woocommerce-smallscreen'] );    // Remove the smallscreen optimisation
	return $enqueue_styles;
}
add_action( 'wp_enqueue_scripts', 'morekoren_manage_woocommerce_styles', 99 );
function morekoren_manage_woocommerce_styles() {
	// remove generator meta tag
	remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
	// first check that woo exists to prevent fatal errors
	if ( function_exists( 'is_woocommerce' ) ) {
		// dequeue scripts and styles
		if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
			wp_dequeue_style( 'woocommerce_frontend_styles' );
			wp_dequeue_style( 'woocommerce_fancybox_styles' );
			wp_dequeue_style( 'woocommerce_chosen_styles' );
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
			wp_dequeue_script( 'wc_price_slider' );
			wp_dequeue_script( 'wc-single-product' );
			wp_dequeue_script( 'wc-chosen' );
			wp_dequeue_script( 'prettyPhoto' );
			wp_dequeue_script( 'prettyPhoto-init' );
			wp_dequeue_script( 'jquery-placeholder' );
			wp_dequeue_script( 'fancybox' );
			// wp_dequeue_script( 'wc-add-to-cart' );
			wp_dequeue_script( 'wc-checkout' );
			wp_dequeue_script( 'wc-add-to-cart-variation' );
			wp_dequeue_script( 'jquery-blockui' );
			wp_dequeue_script( 'jqueryui' );
			wp_dequeue_script( 'woocommerce' );
			wp_dequeue_script( 'wc-cart' );
			wp_dequeue_script( 'wc-cart-fragments' );
		}
	}
}


add_filter( 'woocommerce_add_to_cart_fragments', 'morekoren_mini_cart_refresh_number');
function morekoren_mini_cart_refresh_number($fragments){
    ob_start();
?>
    <span class="mini-cart-count">
        <?php echo WC()->cart->get_cart_contents_count(); ?>
    </span>
<?php
    $fragments['.mini-cart-count'] = ob_get_clean();
    return $fragments;
}


add_action('wp_ajax_register_user_front_end', 'morekoren_register_user_front_end', 0);
add_action('wp_ajax_nopriv_register_user_front_end', 'morekoren_register_user_front_end');
function morekoren_register_user_front_end() {	
	// Verify nonce
	if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'morekoren_new_user' ) )
    die( 'Ooops, something went wrong, please try again later.' );
 
  // Post values
    $first_name 		= $_POST['first_name'];
    $last_name 			= $_POST['last_name'];
    $reg_email    		= $_POST['reg_email'];
    $reg_password     	= $_POST['reg_password'];
    $contact_number     = $_POST['contact_number'];

    $userdata = array(
        'user_login' => $reg_email,
        'user_pass'  => $reg_password,
        'user_email' => $reg_email,
		'first_name' => $first_name,
		'last_name' => $last_name,
        'user_nicename' => $first_name." ".$last_name,
        'display_name'  => $first_name." ".$last_name,
    );

    $email = sanitize_text_field(wp_unslash($reg_email));
    // do check.
    if (email_exists($email)) {
        $data = array(
			'message' => false,	
            'code' => '404',
            'reason' => "Email already exist"	
		);
    } elseif(!is_wp_error($user_id)) {
       
        $user_id = wp_insert_user( $userdata ) ;
        $data = array(
			'message' => true,	
            'code' => '200',	
		);
    }else {
		$data = array(
			'message' => false,	
            'code' => '500',	
		);
	   
    } 
  
    wp_send_json($data);
  die();
}

add_action('wp_ajax_login_user_front_end', 'morekoren_login_user_front_end', 0);
add_action('wp_ajax_nopriv_login_user_front_end', 'morekoren_login_user_front_end');
function morekoren_login_user_front_end() {
    	// Verify nonce
        if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'morekoren_new_user' ) )
        die( 'אופס, משהו השתבש, בבקשה נסה שוב מאוחר יותר.' );
     
      // Post values
        $info = array();
        $info['user_login'] 	= $_POST['login_user'];
        $info['user_password'] 	= $_POST['login_password'];
        $info['remember'] 		= $_POST['rememberme'];    
       
        $user_signon = wp_signon( $info, false);
        $redirect_url = home_url()."/my-account/";
        if ( is_wp_error($user_signon) ){
            wp_set_current_user($user_signon->ID);
            wp_set_auth_cookie($user_signon->ID);
            $data = array('loggedin'=>false, 'message'=>__('שם משתמש או סיסמא אינם נכונים'), 'status'=> 0);
        } else {
            $data = array( 'loggedin'=>true, 'message'=>__('הכניסה מוצלחת, מפנה מחדש...'),'login_url' => $redirect_url, 'status'=> 1);
        }    
        wp_send_json($data);
        die();
}

add_action('wp_ajax_password_reset_morekoren', 'morekoren_password_reset', 0);
add_action('wp_ajax_nopriv_password_reset_morekoren', 'morekoren_password_reset');
function morekoren_password_reset() {
	// First check the nonce, if it fails the function will break
    check_ajax_referer( 'lost_password', 'nonce' );
	global $wpdb, $wp_hasher;
	
	$account = $_POST['user_login'];

	$exists = email_exists( $user_login );
    if ( $exists ) {
      $user_data = get_user_by('login', $user_login);
    } else {
      $data = array('loggedin'=>false, 'message'=>'אימייל לא קיים', 'status'=> 0); 
      wp_send_json($data);
      die();
    }

    do_action('lostpassword_post');

	// redefining user_login ensures we return the right case in the email
    $user_login = $user_data->user_login;
    $user_email = $user_data->user_email;

    do_action('retreive_password', $user_login);  // Misspelled and deprecated
    do_action('retrieve_password', $user_login);

    $allow = apply_filters('allow_password_reset', true, $user_data->ID);

    if ( ! $allow )
        return false;
    else if ( is_wp_error($allow) )
        return false;
        
    $key = wp_generate_password( 20, false );
    do_action( 'retrieve_password_key', $user_login, $key );

    if ( empty( $wp_hasher ) ) {
        require_once ABSPATH . 'wp-includes/class-phpass.php';
        $wp_hasher = new PasswordHash( 8, true );
    }
    $hashed = time() . ':יש לאפס את הסיסמה עבור החשבון הבא' . $wp_hasher->HashPassword( $key );
    $wpdb->update( $wpdb->users, array( 'user_activation_key' => $hashed ), array( 'user_login' => $user_login ) );

    $message = __(':') . "\r\n\r\n";
    $message .= network_home_url( '/' ) . "\r\n\r\n";
    $message .= sprintf(__('שם משתמש: %s'), $user_login) . "\r\n\r\n";
    $message .= __('אם זו הייתה טעות, פשוט התעלם מהמייל הזה ושום דבר לא יקרה.') . "\r\n\r\n";
    $message .= __('כדי לאפס את הסיסמה שלך, בקר בכתובת הבאה:') . "\r\n\r\n";
    $message .= '<' . network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . ">\r\n";

    if ( is_multisite() )
        $blogname = $GLOBALS['current_site']->site_name;
    else
        $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

    $title = sprintf( __('[%s] איפוס סיסמא'), $blogname );

    $title = apply_filters('retrieve_password_title', $title);
    $message = apply_filters('retrieve_password_message', $message, $key);

    if ( $message && !wp_mail($user_email, $title, $message) ){

      //wp_die( __('The e-mail could not be sent.') . "<br />\n" . __('Possible reason: your host may have disabled the mail() function...') );
      
      $error = '.לא ניתן היה לשלוח את המייל'. __('function...  the mail() ייתכן שהמארח שלך השבית :סיבה אפשרית');	
      $data = array('loggedin'=>false, 'message'=>__($error), 'status'=> 0);     
    }else{
      $success = "קישור לאיפוס סיסמה נשלח אליך באימייל. אנא בדוק את האימייל שלך";
      $data = array('loggedin'=>true, 'message'=>__($success), 'status'=> 1);
    } 
    wp_send_json($data);
    die();

	/*if( empty( $account ) ) {
		$error = 'Enter an username or e-mail address.';
	} else {
		if(is_email( $account )) {
			if( email_exists($account) ) 
				$get_by = 'email';
			else	
				$error = 'There is no user registered with that email address.';			
		}
		else if (validate_username( $account )) {
			if( username_exists($account) ) 
				$get_by = 'login';
			else	
				$error = 'There is no user registered with that username.';				
		}
		else
			$error = 'Invalid username or e-mail address.';		
	}	

	if(empty ($error)) {
		// lets generate our new password
		//$random_password = wp_generate_password( 12, false );
		$random_password = wp_generate_password();
 
			
		// Get user data by field and data, fields are id, slug, email and login
		$user = get_user_by( $get_by, $account );
	
			
		$update_user = wp_update_user( array ( 'ID' => $user->ID, 'user_pass' => $random_password ) );
			
		// if  update user return true then lets send user an email containing the new password
		if( $update_user ) {
			
			$from = get_bloginfo('admin_email'); // Set whatever you want like mail@yourdomain.com
			
			if(!(isset($from) && is_email($from))) {		
				$sitename = strtolower( $_SERVER['SERVER_NAME'] );
				if ( substr( $sitename, 0, 4 ) == 'www.' ) {
					$sitename = substr( $sitename, 4 );					
				}
				$from = 'admin@'.$sitename; 
			}
			
			$to = $user->user_email;
			$subject = 'הסיסמא החדשה שלך';
			//$sender = 'From: '.get_option('name').' <'.$from.'>' . "\r\n";
			$sender = "\n\r".' <'.$from.'>'.get_option('name').':מ';
			
			$message = $random_password.' : הסיסמה החדשה שלך היא';
				
			$headers[] = 'MIME-Version: 1.0' . "\r\n";
			$headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers[] = "X-Mailer: PHP \r\n";
			$headers[] = $sender;
				
			$mail = wp_mail( $to, $subject, $message, $headers );
			if( $mail ) 
				$success = 'בדוק את כתובת הדוא"ל שלך עבור הסיסמה החדשה שלך.';
			else
				$error = 'המערכת לא מצליחה לשלוח לך דואר המכיל את הסיסמה החדשה שלך.';						
		} else {
			$error = 'אופס! משהו השתבש במהלך עדכון החשבון שלך.';
		}
	}
	
	if( ! empty( $error ) )
		$data = array('loggedin'=>false, 'message'=>__($error), 'status'=> 0);
			
	if( ! empty( $success ) )
		$data = array('loggedin'=>false, 'message'=>__($success), 'status'=> 1);

	wp_send_json($data);
	die();*/
}

function morekroen_cart_update_quantity_change() {
    $quantity = isset($_POST['quantity']) && !empty($_POST['quantity']) ? sanitize_text_field($_POST['quantity']) : 0;
	$cart_item_key = isset($_POST['cart_item_key']) && !empty($_POST['cart_item_key']) ? sanitize_text_field($_POST['cart_item_key']) : false;
	
	if( !$cart_item_key )
		wp_send_json_error();
	
	$cart_item = WC()->cart->get_cart_item($cart_item_key);
	$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
	$product_id         = $cart_item['product_id'];
	$is_course = get_field('is_it_course',$product_id);
	if($is_course){}
	else{
	WC()->cart->set_quantity($cart_item_key, $quantity);
	}

    ob_start();
	?>
        <div class="widget_shopping_cart_content"><?php woocommerce_mini_cart(); ?></div>
	<?php
	$fragments['.widget_shopping_cart_content'] = ob_get_clean();


    ob_start();
	?>
	 <span class="mini-cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
	<?php
	$fragments['.mini-cart-count'] = ob_get_clean();

    
    ob_start();
	?>
	 <a href="javascript:void(0)" class="cart_icon_page">
        <span><?php echo WC()->cart->get_cart_contents_count(); ?></span>
        <img src="<?php echo get_template_directory_uri();?>/assets/images/site/cart_icon1.png" alt="cart_icon">
    </a>
	<?php
	$fragments['a.cart_icon_page'] = ob_get_clean();
    
	/* @var WC_Product $_product*/
	$_parent_id = $_product->get_parent_id() > 0 ? $_product->get_parent_id() : $_product->get_id();
	
	wp_send_json_success(
		[
			'fragments'     => $fragments,
			'product'       => $_parent_id,
			'product_qty'   => $quantity,
			'cart_hash'     => $cart_item_key,
		]
	);
	die();
}
add_action('wp_ajax_cart_update_quantity_change', 'morekroen_cart_update_quantity_change');
add_action('wp_ajax_nopriv_cart_update_quantity_change', 'morekroen_cart_update_quantity_change');

add_shortcode( 'lost_password_form', 'morekoren_custom_lost_password_form' );
function morekoren_custom_lost_password_form( $atts ) {
    return wc_get_template( 'myaccount/form-lost-password.php', array( 'form' => 'lost_password' ) );
}

add_filter ( 'woocommerce_account_menu_items', 'morekoren_forgot_pass_func', 30 );
function morekoren_forgot_pass_func( $menu_links ){	
	$menu_links = array_slice( $menu_links, 0, 4, true ) 
	+ array( 'forgot-password' => 'החשבון שלי', 'our-courses' => 'הקורסים שלי' )
	+ array_slice( $menu_links, 4, NULL, true );	
	return $menu_links;
}

// register permalink endpoint
add_action( 'init', 'morekoren_add_endpoint' );
function morekoren_add_endpoint() {
	add_rewrite_endpoint( 'forgot-password', EP_PAGES );
	add_rewrite_endpoint( 'our-courses', EP_PAGES );
}

// content for the new page in My Account, woocommerce_account_{ENDPOINT NAME}_endpoint
add_action( 'woocommerce_account_forgot-password_endpoint', 'morekoren_my_account_forgot_pass_endpoint_content' );
function morekoren_my_account_forgot_pass_endpoint_content() {
	echo do_shortcode('[lost_password_form]');
}

add_action( 'woocommerce_account_our-courses_endpoint', 'morekoren_my_account_our_courses_endpoint_content' );
function morekoren_my_account_our_courses_endpoint_content() {
	?>
		<h2>הקורסים שלי</h2>
		<table class="course-table">
			<thead>
				<tr>
					<th>שם הקורס</th>
					<th>תאריך התחלה</th>
					<th>תאריך סיום</th>
					<th>התקדמות</th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td></td>
				</tr>
			</tbody>
		</table>
	<?php
	//echo do_shortcode('[lost_password_form]');
}

add_filter ( 'woocommerce_account_menu_items', 'morekoren_reorder_my_account_menu' );
function morekoren_reorder_my_account_menu($newtaborder) {
	unset( $newtaborder[ 'dashboard' ] );
    $newtaborder = array(      
		'our-courses'    	 => __( 'הקורסים שלי', 'woocommerce' ),         
        'orders'             => __( 'היסטוריית הזמנות', 'woocommerce' ),
		'edit-account'       => __( 'החשבון שלי', 'woocommerce' ),
        'forgot-password'    => __( 'שינוי סיסמא', 'woocommerce' ),
        'customer-logout'    => __( 'התנתקות', 'woocommerce' ),
    );	
    return $newtaborder;
}

add_filter('woocommerce_checkout_fields', function($fields) {	
	/*Rename Biiling fields in checkout page*/
	//$fields['billing']['billing_last_name']['label'] = __('bill last name label', 'woocommerce');
	$fields['billing']['billing_last_name']['placeholder'] = __('שם משפחה ', 'woocommerce');
	$fields['billing']['billing_first_name']['placeholder'] = __('שם פרטי  ', 'woocommerce');
	$fields['billing']['billing_company']['placeholder'] = __('שם החברה  ', 'woocommerce');
	$fields['billing']['billing_postcode']['placeholder'] = __('מיקוד ', 'woocommerce');
	$fields['billing']['billing_city']['placeholder'] = __('עיר ', 'woocommerce');
	$fields['billing']['billing_phone']['placeholder'] = __('טלפון  ', 'woocommerce');
	$fields['billing']['billing_email']['placeholder'] = __('כתובת אימייל  ', 'woocommerce');

	/*Rename Shipping fields in checkout page*/
	$fields['shipping']['shipping_last_name']['placeholder'] = __('כתובת אימייל  ', 'woocommerce');
	$fields['shipping']['shipping_first_name']['placeholder'] = __('שם פרטי  ', 'woocommerce');
	$fields['shipping']['shipping_company']['placeholder'] = __('שם החברה  ', 'woocommerce');
	$fields['shipping']['shipping_city']['placeholder'] = __('עיר ', 'woocommerce');
	$fields['shipping']['shipping_postcode']['placeholder'] = __('מיקוד ', 'woocommerce');
	return $fields;
});


/*add_filter( 'woocommerce_account_menu_items', 'moerekoren_remove_my_account_dashboard' );
function moerekoren_remove_my_account_dashboard( $menu_links ){	
	unset( $menu_links[ 'dashboard' ] );
	return $menu_links;	
}

add_action( 'template_redirect', 'morekoren_redirect_to_courses_from_dashboard' );
function morekoren_redirect_to_courses_from_dashboard(){	
 	if( is_account_page() ){
		wp_safe_redirect( wc_get_account_endpoint_url( 'our-courses' ) );
		exit;
 	}	
 }

 function WOO_login_redirect( $redirect, $user ) {

    $redirect_page_id = url_to_postid( $redirect );
    $checkout_page_id = wc_get_page_id( 'checkout' );

    if ($redirect_page_id == $checkout_page_id) {
        return $redirect;
    }

    return get_permalink(get_option('woocommerce_myaccount_page_id')) . 'our-courses/';

}

add_action('woocommerce_login_redirect', 'WOO_login_redirect', 10, 2);
*/