const coupon = document.querySelector('.tp-checkout-coupon-form-reveal-btn');
const show = document.querySelector('#tpCheckoutCouponForm');

 coupon.addEventListener('click', function(){
    if (show.classList.contains('showing')) {
        show.classList.remove('showing');
      } else {
        show.classList.add('showing');
    }
 });


$.ajaxSetup({
    headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
 });



// $('.changeQuantity').click(function (e) {
//     e.preventDefault();
//     var product_id = $(this).closest('.ptoduct_data').find('.prod_id').val();
//     var product_quantity = $(this).closest('.ptoduct_data').find('.quantity-input').val();

//     data = {
//         'product_id':product_id,
//         'product_qty':product_quantity,
//     }

//     $.ajax({
//         method: "POST",
//         url: "update-cart",
//         data:data,
//         success: function (response){
//             alert(response)
//         }
//     });


// });
