<div class="col-md-4 box">
    <label for="id_blik" class="form-label text-white">Wprowadz kod Blik</label>
    <input type="text" id="id_blik" name="blik" class="form-control">
    <span id="blikError" class="text-danger"></span>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('orderForm').addEventListener('submit', function(event) {
        event.preventDefault();
        var blik = document.getElementById('id_blik').value.trim();
        var blikError = document.getElementById('blikError');

        blikError.textContent = '';
        
        var blikPattern = /^\d{6}$/;
        if (!blikPattern.test(blik)) {
            blikError.textContent = 'Kod Blik musi zawierać dokładnie 6 cyfr.';
            return;
        }

        this.submit();
    });
});
</script>