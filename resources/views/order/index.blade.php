<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-PL-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Zamówienie</title>
    <link rel="icon" href="images/basket3.svg">
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <style>
        .box {
            background-color: #46484c;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .product {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .product img {
            width: 80px; /* увеличиваем размер фото */
            height: 80px;
            margin-right: 20px; /* увеличиваем отступ */
            border-radius: 5px;
        }
        .product-details {
            flex-grow: 1; /* растягиваем контейнер с деталями на всю доступную ширину */
        }
        .product-details p {
            margin: 5px 0; /* добавляем небольшой отступ сверху и снизу */
        }
    </style>
</head>
<body class="bg-dark">
    <header class="d-flex flex-wrap align-items-center justify-content-between justify-content-md-between py-3 mb-4 border-bottom bg-dark">
        <ul class="nav col-12 col-md-auto mb-2 justify-content-start mb-md-0">
            <li> <a href="{{route('home.index')}}" class="nav-link px-2 link-secondary text-white">Strona główna</a></li>
        </ul>
    </header>

    <div class="container">
        <form action="{{ route('order.pay') }}" method="POST" id="orderForm">
            @csrf
            <div class="d-flex justify-content-between mb-3">
                <div class="col-md-8">
                    <div class="mb-3 box">
                        <label for="id_address" class="form-label text-white">Adres do wysyłki</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="id_address" name="address">
                            <span id="addressError" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="mb-3 box">
                        <label for="id_phone" class="form-label text-white">Numer telefonu</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="id_phone" name="phone">
                            <span id="phoneError" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="mb-3 box">
                        <label for="id_payment_service" class="form-label text-white">Metoda płatności</label>
                        <div class="col-md-6">
                            <select name="service" id="id_payment_service" class="form-control">
                                <option value="karta">Karta</option>
                                <option value="blik">BLIK</option>
                                <option value="paypal">PayPal</option>
                                <option value="przy_odbiorze">Przy odbiorze</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 box">
                        @foreach ($cart as $dish)
                            <div class="product">
                                <img src="{{ asset($dish->image) }}" alt="{{ $dish->name }}">
                                <div class="product-details">
                                    <p class="fw-bold text-white">{{ $dish->name }}</p>
                                    <p class="fw-bold text-white">{{ $dish->weight }} g</p>
                                    <p class="fw-bold text-white">{{ $dish->price }} zł</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
        
                <div class="col-md-3">
                    <div class="box">
                        <p class="fw-bold text-white">Całość</p>
                        <p class="fw-bold text-white">{{ $amount }} zł</p>
                        <input type="submit" class='btn btn-danger btn-as-link' value="Zapłać teraz" id="submitButton">
                    </div>
                </div>
            </div>
        </form>
    </div>

    @if ($errors->any())
    <div class="container alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('orderForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var address = document.getElementById('id_address').value.trim();
            var phone = document.getElementById('id_phone').value.trim();
            var addressError = document.getElementById('addressError');
            var phoneError = document.getElementById('phoneError');
            var submitButton = document.getElementById('submitButton');

            addressError.textContent = '';
            phoneError.textContent = '';
            var phonePattern = /^\+48\d{9}$/;

            if(address === '' || !phonePattern.test(phone)) {
                if (address === '') {
                    addressError.textContent = 'Adres nie może być pusty.';
                }

                if (!phonePattern.test(phone)) {
                    phoneError.textContent = 'Numer telefonu musi być w formacie +48XXXXXXXXX.';
                }
                return;
            }
            

            submitButton.disabled = true;
            this.submit();
        });
    });
</script>
</body>
</html>