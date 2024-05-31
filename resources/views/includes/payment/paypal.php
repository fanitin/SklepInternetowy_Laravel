<div class="col-md-4 box">
    <div class="mb-3">
        <label for="id_email" class="form-label text-white">Wprowadz e-mail</label>
        <input type="email" id="id_email" name="email" class="form-control">
        <div id="emailError" class="text-danger"></div>
    </div>
    <div class="mb-3">
        <label for="id_phone" class="form-label text-white">Wprowadź numer telefonu</label>
        <input type="text" id="id_phone" name="phone" class="form-control">
        <div id="phoneError" class="text-danger"></div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('orderForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var email = document.getElementById('id_email').value.trim();
            var phone = document.getElementById('id_phone').value.trim();
            var emailError = document.getElementById('emailError');
            var phoneError = document.getElementById('phoneError');

            emailError.textContent = '';
            phoneError.textContent = '';
            
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var phonePattern = /^\+48\d{9}$/;
            
            if( !emailPattern.test(email) ) {
                emailError.textContent = 'Niepoprawny adres email.';
            }
            
            if( !phonePattern.test(phone) ) {
                phoneError.textContent = 'Numer telefonu musi być w formacie +48XXXXXXXXX.';
            }
            
            if(emailError.textContent || phoneError.textContent) {
                return;
            }

            this.submit();
        });
    });
</script>
