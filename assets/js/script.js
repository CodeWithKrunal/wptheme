$ = jQuery.noConflict();

/* Window Load functions */
// For image to svg convert  
 jQuery("[data-svg-img]").each(function () {
        var self = jQuery(this);
        $.get(
            jQuery(this).attr("data-svg-img"),
            function (data) {
                self.html(data);
            },
            "text"
        );
    });
    function had_height(){
        var had_height = $('header').outerHeight();
        $('body').css('padding-top',had_height);
    }
$(window).load(function(){
    had_height();
    setTimeout(function(){
    });
});
$(document).ready(function(){

    jQuery('#common_footer_from .open_form').on('click',function(){
        jQuery('#mobile_con_form').addClass('open');
    });
    jQuery('#mobile_con_form .close_form').on('click',function(){
        jQuery('#mobile_con_form').removeClass('open');
    });

    // custom dropdown js start
jQuery(".main_select").each(function () {
    var jQuerythis = jQuery(this),
      selectOptions = jQuery(this).children("option").length;
  
    jQuerythis.addClass("hide-select");
    jQuerythis.wrap('<div class="select"></div>');
    jQuerythis.after('<div class="custom-select"></div>');
  
    var jQuerycustomSelect = jQuerythis.next("div.custom-select");
    jQuerycustomSelect.text(jQuerythis.children("option").eq(0).text());
  
    var jQueryoptionlist = jQuery("<ul />", {
      class: "select-options",
    }).insertAfter(jQuerycustomSelect);
  
    for (var i = 0; i < selectOptions; i++) {
      jQuery("<li />", {
        text: jQuerythis.children("option").eq(i).text(),
        rel: jQuerythis.children("option").eq(i).val(),
        "data-term": jQuerythis.children("option").eq(i).attr("data-id"),
      }).appendTo(jQueryoptionlist);
    }
  
    var jQueryoptionlistItems = jQueryoptionlist.children("li");
  
    jQuerycustomSelect.click(function (e) {
      e.stopPropagation();
      jQuery("div.custom-select.active").not(this).each(function () {
        jQuery(this).removeClass("active").next("ul.select-options").hide();
      });
      jQuery(this).toggleClass("active").next("ul.select-options").slideToggle();
    });
  
    jQueryoptionlistItems.click(function (e) {
      e.stopPropagation();
      jQuerycustomSelect.text(jQuery(this).text()).removeClass("active");
      jQuerythis.val(jQuery(this).attr("rel"));
      jQueryoptionlist.hide();
      //jQuery(".product_con select.main_select").val(jQuery.trim(jQuery(this).text())).change();
      jQuery(".product_con select.main_select option").removeAttr("selected");
      jQuery(".product_con select.main_select option[data-id='" + jQuery(this).attr("data-term") + "']").prop('selected', 'selected');
      jQuery(".product_con select.main_select").change();
    });
  
    jQuery(document).click(function () {
      jQuerycustomSelect.removeClass("active");
      jQueryoptionlist.hide();
    });
  
  });

    jQuery('.students-comment-box .read_con').on('click', function(){
        $(this).parents('.comment-info').find('.comment-lines').toggleClass('show');
        $(this).parents('.read-more-link').css('opacity',0);
        $(this).parents('.comment-info').find('.close-para-icon').toggleClass('close');
    });
    jQuery('.students-comment-box .comment-info .close-para-icon').on('click', function(){
        $(this).parents('.comment-info').find('.comment-lines').removeClass('show');
        $(this).parents('.comment-info').find('.read-more-link').css('opacity',1);
        $(this).removeClass('close');
    });
    if($(window).width() < 1024){
        $('header #mega-menu-wrap-header_menu>ul>li>.mega-sub-menu').before('<span class="drop"></span>');
        $('.drop').click(function(){
            $(this).toggleClass('open');
            $(this).next().slideToggle();
        });
    }

    // // my-account js
    // $('.woocommerce-MyAccount-navigation ul li').on('click', function(){
    //     $('.woocommerce-MyAccount-navigation ul li').removeClass('active');
    //     $(this).addClass('active');
    // });

    // var header_height = $('header').outerHeight();
    // $('.cart_section').css('top',header_height);

    $('header .cart_icon').click(function(e){
        e.stopPropagation();
        $('.cart_section').toggleClass('active');
    });

    $('.cart_section .mini-close').on('click', function(e){
        e.stopPropagation();
        $('.cart_section').removeClass('active');
    });

    $('form label input[type="checkbox"]').change(function(){
        if(this.checked) {
            $(this).parent().addClass('active')
        }
        else{
            $(this).parent().removeClass('active')
        }
    });  

     // Accordion Js
     $('.accordion-list > li:first-child').addClass('active');
     $('.accordion-list > li.active .answer').show();
     $('.accordion-list > li > h5').click(function() {
         if ($(this).parent('li').hasClass("active")) {
             $(this).parent('li').removeClass("active").find(".answer").slideUp();
         } else {
             $(".accordion-list > li.active .answer").slideUp();
             $(".accordion-list > li.active").removeClass("active");
             $(this).parent('li').addClass("active").find(".answer").slideDown();
         }
         return false;
     });
 

    $('.login_page ul li').click(function(){
        $('.login_page ul li').removeClass('active');
        $(this).addClass('active');

        var _this = $(this).attr('data-title');
        $('.login_page .comman_col').removeClass('active');
        $('#'+_this).addClass('active');
    });


    $('.moreinfo_tab .text').show();
    $('.moreinfo_tab ul li').click(function(){
        $('.moreinfo_tab ul li').removeClass('active');
        $(this).addClass('active');

        var _this = $(this).attr('data-title');
        $('.moreinfo_tab .text').removeClass('active');
        $('#'+_this).addClass('active');
    });

    $('.overview_tab ul li').click(function(){
        $('.overview_tab ul li').removeClass('active');
        $(this).addClass('active');

        var _this = $(this).attr('data-title');
        $('.overview_tab .text_content').removeClass('active');
        $('#'+_this).addClass('active');
    });

    $('.job_link_list a:first-child').addClass('active');
            $('.job_section .tab-content').hide();
            $('.job_section .tab-content:first').show();

            // Click function
            $('.job_link_list a').click(function(){
            $('.job_link_list a').removeClass('active');
            $(this).addClass('active');
            $('.job_section .tab-content').hide();
            
            var activeTab = $(this).attr('href');
            $(activeTab).fadeIn();
            return false;
            });

    had_height();
    $('.hamburger').click(function () {
        $('.hamburger').toggleClass('is-active'); 
        $('.mobile_menu ').toggleClass('active');   
    });
    $('header nav ul li a').click(function(){
        $('.hamburger').removeClass('is-active'); 
        $('.mobile_menu ').removeClass('active');   
    }); 
    $('header .bg').click(function(){
        $('.hamburger').removeClass('is-active'); 
        $('.mobile_menu ').removeClass('active');   
    }); 

    var teacher_slider = $('#teacher_slider').owlCarousel({
        margin: 0,
        center: true,
        loop: true,
        rtl: true,
        nav: true,
        responsive: {
        0: {
           items: 1
        },
        576: {
           items: 3,
        },
        768:{
            items: 1,
        },
        992:{
            items: 1,
        },
        1000: {
           items: 3,
        }
        }
    });
    teacher_slider.on('changed.owl.carousel', function (property) {
        
            var current = property.item.index;
             var _prevName = $(property.target).find('.owl-item').eq(current).find('.teacher_box').attr('data-name');
             var _prevTitle = $(property.target).find('.owl-item').eq(current).find('.teacher_box').attr('data-title');
             var _prevDesig = $(property.target).find('.owl-item').eq(current).find('.teacher_box').attr('data-designation');
             var _prevInfo =  $(property.target).find('.owl-item').eq(current).find('.teacher_box').attr('data-info');
             var _prevFaccebooklink = $(property.target).find('.owl-item').eq(current).find('.teacher_box').attr('data-facebook_link');
             var _prevTwitterlink = $(property.target).find('.owl-item').eq(current).find('.teacher_box').attr('data-twitter_link');
             var _prevImg = $(property.target).find('.owl-item').eq(current).find('.teacher_box').attr('data-teacher_img');
            
            $('#teacher_name').html(_prevName);
            $('#teacher_title').html(_prevTitle);
            $('#teacher_desig').html(_prevDesig);
            $('#teacher_detail p').html(_prevInfo);
            $('#facbook_link').attr('href',_prevFaccebooklink);
            $('#twitter_link').attr('href',_prevTwitterlink);
            $('#teacher_img').attr('src',_prevImg);
                return false;
           
    });
    $('#teacher_slider .owl-item').each(function() {
        if($(this).hasClass('center')){
            var _prevName = $(this).find('.teacher_box').attr('data-name');
            var _prevTitle = $(this).find('.teacher_box').attr('data-title');
            var _prevDesig = $(this).find('.teacher_box').attr('data-designation');
            var _prevInfo = $(this).find('.teacher_box').attr('data-info');
            var _prevFaccebooklink = $(this).find('.teacher_box').attr('data-facebook_link');
            var _prevTwitterlink = $(this).find('.teacher_box').attr('data-twitter_link');
            var _prevImg = $(this).find('.teacher_box').attr('data-teacher_img');
           
           $('#teacher_name').html(_prevName);
           $('#teacher_title').html(_prevTitle);
           $('#teacher_desig').html(_prevDesig);
           $('#teacher_detail p').html(_prevInfo);
           $('#facbook_link').attr('href',_prevFaccebooklink);
           $('#twitter_link').attr('href',_prevTwitterlink);
           $('#teacher_img').attr('src',_prevImg);
          
            return false;
        }
    });

    $('.our_courses .owl-carousel').owlCarousel({
        items:3,
        //center: true,
        //loop:true,
        margin:53,
        nav: true,
        rtl: true,
        dots: false,   
        responsiveClass:true,
    responsive:{
        0:{
            items:1,
            margin:0,
        },
        768:{
            items:2,
            margin:5,
        },
        1024:{
            items:3,
            margin:5,
        },
        1280:{
            items:3,
            margin:10,
        },
        1400:{            
            margin:53,
        }
    }    
    });
    $('.students_tell .wrapper').owlCarousel({
        items:3,
        //center: true,
        //loop:true,
        margin:30,
        nav: true,
        rtl: true,
        dots: false,    
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                margin:0,
            },
            768:{
                items:2,
                margin:5,
            },
            1024:{
                items:3,
                margin:5,
            },
            1280:{
                items:3,
                margin:10,
            },
            1400:{            
                margin:30,
            }
        }       
    });
    $(".sub-menu ul").each(function() {
        var list = $(this);
        var size = 3;
        var current_size = 0;
        list.children().each(function() {
        // console.log(current_size + ": " + $(this).text());
          if (++current_size > size) {
            var new_list = $("<ul></ul>").insertAfter(list);
            list = new_list;
            current_size = 1;
          }
          list.append(this);
        });
      });
      if($(window).width() < 767){        
        $('footer .col_left ul li:first-child').each(function(){
            var _this = $(this).html();
            $(this).parent('ul').before('<h4>'+_this+'</h4>');
        });
        $('footer .col_left h4').click(function(){
            $(this).next().slideToggle();
        });
      }
});
$(window).resize(function(){
    had_height();
});
jQuery(document).click(function (e) {
    if(!jQuery(e.target).closest('.cart_section').length){
      jQuery(".cart_section").removeClass('active');
    }
  });

//   popup js start
// Quick & dirty toggle to demonstrate modal toggle behavior
$('.modal-toggle').on('click', function(e) {
    e.preventDefault();
    $('.student-recommdation-form').toggleClass('is-visible');
  });