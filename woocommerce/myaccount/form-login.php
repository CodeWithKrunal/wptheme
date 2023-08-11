<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>



<?php endif; ?>

<div class="login_page">
    <div class="wrap d_flex justify_content_sb flex_wrap">

		<!-- <h2><?php esc_html_e( 'Login', 'woocommerce' ); ?></h2> -->

		<div class="right_col">

			<div class="top_col">
				<h2>התחברות למערכת</h2>
				<p>אנא הזינו את הפרטים שקיבלתם מהמערכת</p>
				<ul class="d_flex justify_content_c">
					<li class="login " data-title="login">התחברות</li>
					<li class="registeration active"  data-title="registeration" >הרשמה</li>
				</ul>
			</div>

			<div class="comman_col active" id="registeration">
				<div id="message_form"></div>
                <div class="inner">
					<h3><?php echo get_field('register_form_title'); ?></h3>
					
					<form id="register-form" method="POST" action="#">

						<?php do_action( 'woocommerce_register_form_start' ); ?>

						<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>							
						
						<input type="text" class="in" name="first_name" id="first_name"  placeholder="שם פרטי"/>				

						<?php endif; ?>		
						
						<input type="text" class="in" name="last_name" id="last_name" placeholder="שם משפחה"/>
					
						<input type="email" class="in" name="email" id="reg_email" placeholder="כתובת מייל"/>
											

						<input type="text" name="contact_number" id="contact_number" placeholder="טלפון " class="in">

						<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>							
					
						<input type="password" class="in lock" name="password" id="reg_password" autocomplete placeholder="סיסמא"/>

						<input type="password" class="in lock" name="confirm_password" autocomplete id="reg_confirm_password" placeholder="סיסמא בשנית"/>

						
						<?php else : ?>

						<p><?php esc_html_e( 'A link to set a new password will be sent to your email address.', 'woocommerce' ); ?></p>

						<?php endif; ?>

						<?php wp_nonce_field('morekoren_new_user','morekoren_new_user_regi_nonce', true, true ); ?>

						<?php do_action( 'woocommerce_register_form' ); ?>					
							<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>							
							<input type="submit" class="sub" value="הרשמה" name="register">	
						<?php do_action( 'woocommerce_register_form_end' ); ?>
						<label for="term_policy_check">
						<input type="checkbox" id="term_policy_check" name="term_policy_check">
						אני מצהיר בזאת כי קראת והסכמתי ל <a href="#"><u>תנאי השירות והפרטיות</u></a>
					</label>
					<div style="display:none;" id="pass_mismatch"></div>
					</form>
					
					<div id="register-message"></div>
				</div>
				
			</div>
			
			<div class="comman_col " id="login">
                <div class="inner">					
					<form id="login-form" method="POST" action="#">					
						<?php wp_nonce_field('morekoren_new_user','morekoren_new_user_logi_nonce', true, true ); ?>
						<?php do_action( 'woocommerce_login_form_start' ); ?>				
							
							<input type="text" class="in user" name="login_username" id="login_username" autocomplete="username"  placeholder="שם משתמש"/>
						
							<input class="in lock" type="password" name="login_password" id="login_password" autocomplete placeholder="סיסמא"/>						

						<?php do_action( 'woocommerce_login_form' ); ?>	
							
							<label for="checkbox6">
								<input name="rememberme" type="checkbox" id="rememberme" />זכור אותי להבא
                            </label>				
								
					
							<a class="forgot_password" href="javascript:void(0)"><u>שכחתי סיסמא</u></a>
							
						
                            <input type="submit" class="sub" value="הרשמה">
                          <!-- <a href="#" class="connect_google"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/site/google.png" alt=""> התחבר עם גוגל </a>  -->
							<?php echo do_shortcode('[miniorange_social_login]' ); ?>

						<?php do_action( 'woocommerce_login_form_end' ); ?>

					</form>
					<div id="forgot-password" style="display:none;">
						<?php echo do_shortcode('[lost_password_form]'); ?>
					</div>
					<div id="login-message"></div>
				</div>
			</div>		
		
		</div>

		<div class="left_col" <?php if( get_field('enrollment_image') ): ?> style="background-image:url(<?php echo get_field('enrollment_image')['url']; ?>);" <?php endif; ?>></div>

	</div>
</div>


<?php do_action( 'woocommerce_after_customer_login_form' ); ?>

