{{-- <script src="https://js.paystack.co/v1/inline.js"></script>
  <script>
    const paymentForm = document.getElementById('paymentForm');
    paymentForm.addEventListener("submit", payWithPaystack, false);

    function payWithPaystack(e) {
    e.preventDefault();

    let handler = PaystackPop.setup({
        key: '{{$paystackPublicKey}}', // Pass the public key variable here
        email: document.getElementById("email-address").value,
        amount: {{$total}} * 100, // Pass the total price variable here
        ref: ''+Math.floor((Math.random() * 1000000000) + 1),
        onClose: function(){
        alert('Window closed.');
        },
        callback: function(response){
        let message = 'Payment complete! Reference: ' + response.reference;
        alert(message);
        }
    });

    handler.openIframe();
    }

  </script> --}}


<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editors' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
<script>
    ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
