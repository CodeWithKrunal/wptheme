$(document).ready(function(){

  Shadowbox.init({
        language: 'en',
        players: ['img', 'html', 'iframe', 'qt', 'wmp', 'swf', 'flv']
        });

        // $(document.body).on('added_to_cart', function( event, fragments, cart_hash, button ) {
        //         $(".cart_section").addClass('active');
        // });

        $(document).on("click", " a.ajax_add_to_cart_custom", function (e) {
          e.preventDefault();
          let product_id = $(this).attr('data-product_id'); 
          let quantity = 1; // $(this).attr('data-product_id'); 
            if (product_id) {
              var data = {
                  'action': 'ajax_add_to_cart_custom',
                  'product_id': product_id,
                  'quantity': quantity,
              };

              $.ajax({
                url: AjaxObj.ajax_url,
                type: "post",
                data: data,
                beforeSend: function(xhr) {
                    $(".site-loader").addClass("active");
                },
                success: function(response) {
                  $(".site-loader").removeClass("active"); 
                   
                    if (response.error & response.product_url) {
                        window.location = response.product_url;
                        return;
                    } else {
                        jQuery( document.body ).trigger( 'added_to_cart', [ response.fragments, response.cart_hash ] );
                        $(".cart_section").addClass('active');
                    }
                    
                },
            });


            }
        });

        $(document).on("click", " a.quantity__plus, a.quantity__minus", function (e) {
          e.preventDefault();
            // Get current quantity values
            var qty = $(this).closest(".quantity").find(".qty"),
              val = parseFloat(parseFloat(qty.val()).toFixed(2)),
              max = parseFloat(parseFloat(qty.attr("max")).toFixed(2)),
              min = parseFloat(parseFloat(qty.attr("min")).toFixed(2)) ? parseFloat(parseFloat(qty.attr("min")).toFixed(2)) : parseFloat(0),
              step = parseFloat(parseFloat(qty.attr("step")).toFixed(2)),
              
              datacartitemkey = qty.attr("data-cart-item-key");
              var thisEl = $(this).parents(".col");

            // Change the value if quantity__plus or minus
            let newqty = 1;
            
            if ($(this).is(".quantity__plus")) {
              if (max && max <= val) {
                newqty = max;
                qty.val(max);
              } else {
                newqty = parseFloat(parseFloat(val + step).toFixed(2));
                qty.val(newqty);
              }
            } else {
              if (min && min >= val) {
                newqty = min;
                qty.val(min);
              } else if (val > 0.5) {
                newqty = parseFloat(parseFloat(val - step).toFixed(2)); 
                qty.val(newqty);
              }
            }

            // call function
            changeCartItemQty(datacartitemkey, newqty, thisEl);  

            // jQuery('div.woocommerce').on('change', '.qty', function(){
              // jQuery("[name='update_cart']").prop("disabled", false);
              // jQuery("[name='update_cart']").trigger("click"); 
          // });

          
          });
        
})


function changeCartItemQty(cart_item_key, quantity, thisEl ) {
  var data = {
      action: 'cart_update_quantity_change',
      quantity,
      cart_item_key
  }
    $.ajax({
        type: 'POST',
        url: AjaxObj.ajax_url,
        data: data,
        beforeSend: function() {
            thisEl.fadeTo( '400', '0.6' ).block({
          message: null,
          overlayCSS: {
            opacity: 0.6
          }
              }); 
        },
        success: function (response) {
          thisEl.stop( true ).css( 'opacity', '1' ).unblock();
          if (!response) {
            return;
          }

          if ( response.data.fragments ){
          jQuery.each(response.data.fragments, function(key, value){
              jQuery(key).replaceWith(value);
            });
          }
          // jQuery('body').trigger( 'wc_fragments_refreshed' );
          $( document.body ).trigger( 'added_to_cart' );
          // jQuery(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash]);
        },
        dataType: 'json'
    });
}