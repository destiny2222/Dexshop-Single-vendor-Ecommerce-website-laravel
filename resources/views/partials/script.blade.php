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
    const passwordInput = document.getElementById('tp_password');
    const Showpassword = document.getElementById('close-eye');
    const HideIcon = document.getElementById('open-eye');

    Showpassword.addEventListener('click', function () {
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        Showpassword.style.display = 'none';
        HideIcon.style.display = 'block';
    } else {
        passwordInput.type = 'password';
        Showpassword.style.display = 'block';
        HideIcon.style.display = 'none';
    }
    });

    HideIcon.addEventListener('click', function () {
    if (passwordInput.type === 'text') {
      passwordInput.type = 'password';
      Showpassword.style.display = 'block';
      HideIcon.style.display = 'none';
    }
  });
</script>




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
