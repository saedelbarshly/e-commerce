<script>
  $(window).on('load', function() {
    setTimeout(function() {
      $('#newyear').modal('show');
    }, 2500);
  });
  feather.replace();



  $(function () {
    // console.log('subscribes.js loaded');
    $('#subscribeForm').submit(function (e) {
      e.preventDefault();
      var email = $('#email').val();
      var data = {
        email: email
      };
      console.log(data);
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: data,
        // processData: false,
        // contentType: false,
        dataType: 'json',
        beforeSend: function () {
            $(document).find('span.text-error').text('');
        },
        success: function(data) {
            if (data.error) {
              $.each(data.error, function (prefix, val) {
                    alert(val[0]);
                    $('span.' + prefix + '_error').text(val[0]);
                });
            } else {
              $('#subscribeForm')[0].reset();
              const Toast = Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: ' {{ trans("common.ThanksForSubscribing!") }}',
                showConfirmButton: false,
                timer: 1500
              });
            }
        }
      });
    }
    );
  });


  $(function () {
    $('#Message_Form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: new FormData(this),
            processData: false,
            contentType: false,
            dataType: 'json',
            beforeSend: function () {
                $(document).find('span.text-error').text('');
            },
            success: function(data) {
                if (data.status == 0) {
                    $.each(data.error, function (prefix, val) {
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                } else {
                    $('#Message_Form')[0].reset();
                    const Toast = Swal.fire({
                      toast: true,
                      position: 'top-end',
                      icon: 'success',
                      title: ' {{ trans("common.successMessageText") }}',
                      showConfirmButton: false,
                      timer: 1500
                    });
                }
            }
        });
    });
  });

  function openSearch() {
    document.getElementById("search-overlay").style.display = "block";
  }

  function closeSearch() {
    document.getElementById("search-overlay").style.display = "none";
  }

  function changeQuantity(action, elem) {
    var row = elem.parentNode.parentNode;
    var quantity_input = $(row).find('#quantity');
    var quantity = $(row).find('#quantity').val();
    if (action == 'increase') {
      quantity = Number(quantity) + 1;
      quantity_input.val(quantity);
    } else {
      if (quantity > 1) {
        quantity = Number(quantity) - 1;
        quantity_input.val(quantity);
      }
    }
    console.log(quantity);
  }

  function changePriceByOption(product_id) {
    var price = 0;
    $.ajax({ //create an ajax request to display.php
      type: "GET",
      url: "<?php echo url('/getProductPrice?product_id="+product_id+"'); ?>",
      dataType: "html", //expect html to be returned
      success: function(data) {
        price = data;

        $('.productOptionList').each(function(i, obj) {
          let option_val = $(this).find(':selected').val();
          let option_id = $(this).data("optionid");
          $.ajax({ //create an ajax request to display.php
            type: "GET",
            url: "<?php echo url('/getPriceAfterOption?option_val="+option_val+"'); ?>",
            dataType: "html", //expect html to be returned
            success: function(data) {
              price = Number(price) + Number(data);
              $('#thePrice').html(price);
              $('#inputPrice').val(price);
            }
          });
        });

      }
    });
  }

  function changeShippingPrice() {
    var shipping_price = $("#ShippingLocations").find(':selected').data("price");

    var total_price = Number($('#totalShopping').attr('data-totalPrice')) + Number(shipping_price);
    console.log(total_price);
    $('#totalShopping').html(total_price);
    $('#totalPrice').val(total_price);
    $('#shippingPrice').val(shipping_price);
  }

  function checkCode(val) {
    console.log(val);
    var coupon = val;
    $.ajax({
      url: "{{ route('cart.applyCoupon') }}",
      type: "POST",
      data: {
        "_token": "{{ csrf_token() }}",
        "coupon": coupon,
      },
      success: function(data) {
        console.log(data);
        if (data.status == true) {
          $('#couponCode').html(data.message);
          $('#couponCode').removeClass('text-danger');
          $('#totalShopping').html(data.total);
        } else {
          $('#couponCode').html(data.message);
          $('#couponCode').addClass('text-danger');
          $('#totalShopping').html(data.total);
        }
      }
    });
  }

  function changeCartQuantity(action, elem) {
    var row = elem.parentNode.parentNode.parentNode.parentNode.parentNode;
    // console.log(row);
    var quantity_input = $(row).find('.quantity');
    var quantity = $(row).find('.quantity').val();
    var itemPrice = $(row).find('#itemPrice').val();
    var itemId = $(row).find('.cartIncrement').val();

     console.log(quantity);
    if (action == 'increase') {
      url = "{{ route('cart.increment',':itemId') }}";
      url = url.replace(':itemId', itemId);
      quantity_input.val(Number(quantity)+1);
      $.ajax({
        type: "post",
        url: url,
        data: {
          '_token': "{{csrf_token()}}",
          'itemId': itemId
        },
        success: function(response) {
          $(row).find('#itemTotal').html(response.itemTotal);
          $('.cartTotal').html(response.cartTotal);

        }
      });
    } else {
      if (quantity > 1) {
        url = "{{ route('cart.decrement',':itemId') }}";
        url = url.replace(':itemId', itemId);
        quantity_input.val(Number(quantity)-1);
        $.ajax({
          type: "post",
          url: url,
          data: {
            '_token': "{{csrf_token()}}",
            'itemId': itemId,
          },
          success: function(response) {
            $(row).find('#itemTotal').html(response.itemTotal);
            $('.cartTotal').html(response.cartTotal);
          }
        });
      }
    }

  }
</script>


<script>
  function deleteFromCart(product_id) {
    url ="<?php echo url('cart/delete/"+product_id+"'); ?>";
     //console.log(product_id);
    $.ajax({
        type:"get",
        url:url,
        dataType:' text',
        success: function(response){
            var response = response.replace('#!/usr/bin/env php','');
            response = $.parseJSON(response);
            $('.deleteDiv'+product_id).remove();
            $('.cart_qty_cls').html(response.cartCount);
            $('.cartTotal').html(response.cartTotal);
            const Toast = Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: ' {{ trans('common.Deleted!') }}',
                showConfirmButton: false,
                timer: 1500
          });
        }
    });
  }
</script>
<script>
  function addToCart(elem) {
      var product_id = $(elem).attr('data-product-id');
      url ="{{ route('cart.store') }}";

      $.ajax({
          type: "POST",
          url: url,
          data: {_token:"{{csrf_token()}}", product_id:product_id},
          dataType:' text',
          success: function(response){
              // var response = response.replace('#!/usr/bin/env php','');
              response = $.parseJSON(response);
              console.log(response);

              $('.cart_qty_cls').html(response.cartCount);
              $('.cartTotal').html(response.cartTotal);
              $('.shopping-cart-items').empty().html(response.cartContentList);
              // $('.headerCartItem').remove();
              const Toast = Swal.fire({
                  toast: true,
                  position: 'top-end',
                  icon: 'success',
                  title: ' {{ trans('common.addedToCartSuccessfully') }}',
                  showConfirmButton: false,
                  timer: 1500
              });
          },
          error: function(ts) { alert(ts.responseText) }
      });
  }

  function addToFav(elem) {
      var product_id = $(elem).attr('data-product-id');
      url ="{{ route('wishlist.add') }}";

      $.ajax({
          type: "POST",
          url: url,
          data: {_token:"{{csrf_token()}}", product_id:product_id},
          dataType:' text',
          success: function(response){
              const Toast = Swal.fire({
                  toast: true,
                  position: 'top-end',
                  icon: 'success',
                  title: ' {{ trans('common.addedToFavList') }}',
                  showConfirmButton: false,
                  timer: 1500
              });
          },
          error: function(ts) { alert(ts.responseText) }
      });
  }
</script>

<script>
  $(document).ready(function(){
    var form = $('.cart-form');
    $(form).on('submit', function(event){
        event.preventDefault();
        var product_id =$('.product_id').val();
        var option_id = $('.product_options').attr('option_id');
        var option_value = $('.product_options option:selected').val();
        var form_data = new FormData(this);
        form_data.append('option_id',option_id);
        form_data.append('product_id',product_id);
        form_data.append('option_value',option_value);
        var url = $(this).attr('data-action');
        $.ajax({
            url: url,
            type:"POST",
            data: form_data,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(response)
            {
                $(form).trigger("reset");
               // alert(response.success)
                $('.shopping-cart-items').html(response.cartContentList);
                $('.cart_qty_cls').html(response.cartCount);
                $('.cartTotal').html(response.cartTotal);
                //console.log('hi');
                const Toast = Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: ' {{ trans('common.addedToCartSuccessfully') }}',
                showConfirmButton: false,
                timer: 1500
                });
            },
            error: function(response) {
            }
        });
    });

});
</script>
