<div class="box">
    <div class="mb-4">
        <label for="id_card" class="form-label text-white">Wprowadz numer karty</label>
        <input type="text" id="id_card" name="card" class="form-control">
        <span id="cardError" class="text-danger"></span>
    </div>
    <div class="row mb-4">
        <div class="col-md-6 mb-2">
            <label for="id_date" class="form-label text-white">Wprowadz datę ważności</label>
            <input type="text" id="id_date" name="date" class="form-control">
            <span id="dateError" class="text-danger"></span>
        </div>
        <div class="col-md-6 mb-2">
            <label for="id_cvv" class="form-label text-white">Wprowadz CVV</label>
            <input type="password" id="id_cvv" name="cvv" class="form-control">
            <span id="cvvError" class="text-danger"></span>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('orderForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var card = document.getElementById('id_card').value.trim();
            var date = document.getElementById('id_date').value.trim();
            var cvv = document.getElementById('id_cvv').value.trim();
            var cardError = document.getElementById('cardError');
            var dateError = document.getElementById('dateError');
            var cvvError = document.getElementById('cvvError');

            cardError.textContent = '';
            dateError.textContent = '';
            cvvError.textContent = '';
            
            var cardPattern = /^\d{16}$/;
            var datePattern = /^(0[1-9]|1[0-2])\/\d{2}$/;
            var cvvPattern = /^\d{3}$/;

            if( !cardPattern.test(card) || !datePattern.test(date) || !cvvPattern.test(cvv) ) {
                if (!cardPattern.test(card)) {
                    cardError.textContent = 'Numer karty musi zawierać dokładnie 16 cyfr.';
                }
                if (!datePattern.test(date)) {
                    dateError.textContent = 'Data w formacie MM/RR.';
                }
                if (!cvvPattern.test(cvv)) {
                    cvvError.textContent = 'CVV musi zawierać dokładnie 3 cyfry.';
                }
                return;
            }


            this.submit();
        });
    });
</script>