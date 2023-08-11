var _restore;
_restore = true;
var _cur_page = 2;
var $ = jQuery.noConflict();

jQuery(window).scroll(function () {
    var order_by_chk = jQuery('.tab_list').find('.active').hasClass('active');
    
    // End of the document reached?
    if(jQuery('#ajax_filter_content').length > 0) {
        if (jQuery(window).scrollTop() >= jQuery('#ajax_filter_content').offset().top + jQuery('#ajax_filter_content').outerHeight() - window.innerHeight) {
            var _total_pages = jQuery('#ajax_filter_content').attr('data-total-pages');
            if(_restore && _total_pages >= _cur_page){
                _restore = false;
                var catid = $('#selected_product_id').val();
                ajax_filter_shop_archive(catid,_cur_page,'append');                      
                _cur_page++;
            }
        }
    }
});
function ajax_filter_shop_archive(catid,page=1,html='html'){
    var thisElm = $('#ajax_filter_content');
    $.ajax({
        url: AjaxObj.ajax_url,
        type: 'post',
        data: {
            action: 'koren_ajax_filter_shop',
            catid: catid,
            paged: page,
        },
        dataType: 'json',
        beforeSend: function () {
            thisElm.fadeTo('400', '0.6').block({
                message: null,
                overlayCSS: {
                    opacity: 0.6
                }
            });
            $('.loding_col').show();
        },
        success: function (response) {
            $('.loding_col').hide();
            thisElm.stop(true).css('opacity', '1').unblock();
            if(html == 'append'){
                $('#ajax_filter_content').append(response.html);
            }
            else{
                $('#ajax_filter_content').html(response.html);
            }
            $('#ajax_filter_content').attr('data-total-pages',response.max);
        },
    });
}


jQuery("form#calculate_form").on('submit', function (e) {
    e.preventDefault();
    var verbal_think = jQuery('#verbal_think').val();
    var quantitaive_think = jQuery('#quantitaive_think').val();
    var english_input = jQuery('#english_input').val();
    var error = 0;
    $('.calculate_form .error_msg').text('');
    if(verbal_think == ''){
     var _text = 'נא למלא שדה זה';   
     $('#verbal_error_msg').text(_text);
     error = 1;
    }
    if(quantitaive_think == ''){
        var _text = 'נא למלא שדה זה';   
        $('#quantitaive_error_msg').text(_text);
        error = 1;
    }
    if(english_input == ''){
     var _text = 'נא למלא שדה זה';   
     $('#english_error_msg').text(_text);
     error = 1;
    }
    if(verbal_think != '' && verbal_think > 46){
        var _text = 'נא למלא שדה זה בין 0 ל-46';   
        $('#verbal_error_msg').text(_text);
        error = 1;
    }
    if(quantitaive_think != '' && quantitaive_think > 46){
        var _text = 'נא למלא שדה זה בין 0 ל-40';   
        $('#quantitaive_error_msg').text(_text);
        error = 1;
    }
    if(english_input != '' && english_input > 46){
        var _text = 'נא למלא שדה זה בין 0 ל-44';   
        $('#english_error_msg').text(_text);
        error = 1;
    }
    if(error > 0){
        return false;
    }
    jQuery.ajax({
        type:"POST",
        url: AjaxObj.ajax_url,
        data: {
            action: "morekoren_calculate_result",
            english_input: english_input,
            quantitaive_think : quantitaive_think,  
            verbal_think : verbal_think   
         
        },
        dataType: 'json',
        beforeSend: function () {
            $('.calculate_btn').addClass('loader');
        },
        success: function(data){
            $('.calculate_btn').removeClass('loader');
            jQuery('#multidisciplinary_score').html(data.multidisciplinary_score);
            jQuery('#verbal_emphasis').html(data.verbal_emphasis);
            jQuery('#quantitative_emphasis').html(data.quantitative_emphasis);
        },
        
    });
});
jQuery("form#login-form").on('submit', function (e) {
    e.preventDefault();
    jQuery('#login-message').hide();
    var login_user = jQuery('#login_username').val();
    var login_password = jQuery('#login_password').val();
    var login_nonce = jQuery('#morekoren_new_user_logi_nonce').val();
    var rememberme =  jQuery('#rememberme').is(':checked');   

    if(login_user !="" && login_password != ""){
        jQuery.ajax({
            type:"POST",
            url: AjaxObj.ajax_url,
            data: {
                action: "login_user_front_end",
                nonce: login_nonce,
                login_user : login_user,  
                login_password : login_password,
                rememberme : rememberme            
             
            },
            success: function(data){
             
                if (data.loggedin == false && data.status == 0){
                    jQuery('#login-message').css('color','red');
                    jQuery('#login-message').text(data.message).show();
                    setTimeout(function () {
                        jQuery('#login-message').hide();
                    }, 4000);
                }

                if(data.loggedin == true && data.status == 1){
                    jQuery('form#login-form')[0].reset();
                    jQuery('#login-message').css('color','green');
                    jQuery('#login-message').text(data.message).show();
                    setTimeout(function () {
                        jQuery('#login-message').hide();
                    }, 4000);
                    document.location.href = data.login_url;
                }
               
            },
            
        });
    }else{
        if(login_user == ""){           
            jQuery('#login-form #login_username').css('border-size','1px');
            jQuery('#login-form #login_username').css('border-color','red');
        }else{       
            jQuery('#login-form #login_username').css('border-color','#A7A7A7');
        }

        if(login_password == ""){           
            jQuery('#login-form #login_password').css('border-size','1px');
            jQuery('#login-form #login_password').css('border-color','red');
        }else{       
            jQuery('#login-form #login_password').css('border-color','#A7A7A7');
        }
       
        
    }
});

jQuery("form#register-form").on('submit', function (e) {
    e.preventDefault();

 
   
    jQuery('#register-message').hide();
    var first_name = jQuery('#first_name').val();
    var last_name = jQuery('#last_name').val();
    var reg_email = jQuery('#reg_email').val();
    var reg_password = jQuery('#reg_password').val();
    var reg_confirm_password = jQuery('#reg_confirm_password').val();
    var contact_number = jQuery('#contact_number').val();
    var reg_nonce = jQuery('#morekoren_new_user_regi_nonce').val();
    var term_policy_check = jQuery('#term_policy_check').is(':checked');

 

    //if(reg_password == reg_confirm_password && term_policy_check){
    if(first_name && last_name && reg_email && reg_password && reg_confirm_password && contact_number && reg_nonce && term_policy_check){
       
        if(reg_password == reg_confirm_password){
           
            jQuery.ajax({
                type:"POST",
                url: AjaxObj.ajax_url,
                data: {
                    action: "register_user_front_end",
                    nonce: reg_nonce,
                    first_name : first_name,
                    last_name : last_name,
                    reg_email : reg_email,
                    reg_password : reg_password,
                    contact_number: contact_number
                },
                success: function(response){
                    if(response.message == true && response.code == "200"){                   
                        jQuery('form#register-form')[0].reset();
                        jQuery('#message_form').css('color','green');          
                        jQuery('#message_form').html("נרשם בהצלחה").show();                 
                        
                        setTimeout(function () {
                            jQuery('#register-message').hide();
                        }, 3000);
                    }else if(response.message == false && response.code == "404"){
                        jQuery('#register-form #pass_mismatch').text("המשתמש כבר קיים").show();
                        setTimeout(function () {
                            jQuery('#register-message').hide();
                        }, 3000);
                    }else{
                        jQuery('#register-message').text("הרישום נכשל אנא נסה שוב מאוחר יותר").show();
                        setTimeout(function () {
                            jQuery('#register-message').hide();
                        }, 3000);
                    }
                
                },
                
            });
        }else{
            jQuery('#register-form #reg_password').css('border-size','1px');
            jQuery('#register-form #reg_password').css('border-color','red');
            jQuery('#register-form #reg_confirm_password').css('border-size','1px');
            jQuery('#register-form #reg_confirm_password').css('border-color','red');
            jQuery('#register-form #pass_mismatch').css('color','red');
            jQuery('#register-form #pass_mismatch').text("סיסמה לא תואמת").show();
            console.log('password mismatch');       
            
        }  
     }
    else{
        if(first_name == ''){
           
            jQuery('#register-form #first_name').css('border-size','1px');
            jQuery('#register-form #first_name').css('border-color','red');
        }else{
           jQuery('#register-form #first_name').css('border-color','#A7A7A7');
        }
          
        if(last_name == ''){
            jQuery('#register-form #last_name').css('border-size','1px');
            jQuery('#register-form #last_name').css('border-color','red');
        }else{
            jQuery('#register-form #last_name').css('border-color','#A7A7A7');
         }

        if(reg_password == ''){
            jQuery('#register-form #reg_password').css('border-size','1px');
            jQuery('#register-form #reg_password').css('border-color','red');
        }else{
            jQuery('#register-form #reg_password').css('border-color','#A7A7A7');
         }

        if(reg_confirm_password == ''){
            jQuery('#register-form #reg_confirm_password').css('border-size','1px');
            jQuery('#register-form #reg_confirm_password').css('border-color','red');
        }else{
            jQuery('#register-form #reg_confirm_password').css('border-color','#A7A7A7');
         }

        if(contact_number == ''){
            jQuery('#register-form #contact_number').css('border-size','1px');
            jQuery('#register-form #contact_number').css('border-color','red');
        }else{
            jQuery('#register-form #contact_number').css('border-color','#A7A7A7');
         }

        if(reg_email == ''){
            jQuery('#register-form #reg_email').css('border-size','1px');
            jQuery('#register-form #reg_email').css('border-color','red');     
        }else{
            jQuery('#register-form #reg_email').css('border-color','#A7A7A7');
         }    
         
        if(term_policy_check == false){
            jQuery('#register-form #pass_mismatch').css('color','red');
            jQuery('#register-form #pass_mismatch').text("אנא בדוק את התנאים וההגבלות").show();
           
        }else{
            jQuery('#register-form #pass_mismatch').text("").show();
        }

        if(reg_password != reg_confirm_password){
            jQuery('#register-form #reg_password').css('border-size','1px');
            jQuery('#register-form #reg_password').css('border-color','red');
            jQuery('#register-form #reg_confirm_password').css('border-size','1px');
            jQuery('#register-form #reg_confirm_password').css('border-color','red');
            jQuery('#register-form #pass_mismatch').css('color','red');
            jQuery('#register-form #pass_mismatch').text("סיסמה לא תואמת").show();
            console.log('password mismatch');   
        }else{
            //jQuery('#register-form #pass_mismatch').text("").show();
           
        }
    }
   
  });

  jQuery(".forgot_password").on('click', function (e) {
    jQuery('#login-form').hide();
    jQuery('#forgot-password').show();
  });
  
  jQuery('.login_page .login').click(function(){
    jQuery('#login-form').show();
    jQuery('#forgot-password').hide();
});

jQuery("form.lost_reset_password").on('submit', function (e) {
    e.preventDefault();
    
    var user_login = jQuery('#user_login').val();
    var forgot_nonce = jQuery('#woocommerce-lost-password-nonce').val();

    if(user_login != ""){
        jQuery.ajax({
            type:"POST",
            url: AjaxObj.ajax_url,
            data: {
                action: "password_reset_morekoren",
                nonce: forgot_nonce,
                user_login : user_login,
           
            },
            success: function(response){
                if(response.status == 0){
                    jQuery('p.status').css('color','red');
                    window.location.reload();
                }

                if(response.status == 1){
                    jQuery('p.status').css('color','green');
                } 

                jQuery('form.lost_reset_password').next('p.status').text(response.message);		
                setTimeout(function () {
                    jQuery('p.status').text("");
                    jQuery('#user_login').val("");
                    window.location.reload();	
                }, 4000);	
                
            },
            
        });
    }else{
        jQuery('form.lost_reset_password #user_login').css('border-size','1px');
        jQuery('form.lost_reset_password #user_login').css('border-color','red');  
    }
});

