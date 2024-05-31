@extends('layouts.main')

@section('title')
    Koszyk
@endsection

@section('main_content')
<div class="d-flex justify-content-between mb-3">
    <div>
        <button class="btn btn-danger btn-as-link" id="deleteAllButton">Wyczyść koszyk</button>
        <button class="btn btn-warning btn-as-link" id="deleteSelectedButton">Usuń zaznaczone</button>
    </div>
</div>

<table class="table table-striped  table-dark table-bordered">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Wybierz</th>
            <th scope="col">Zdjecie</th>
            <th scope="col">Nazwa</th>
            <th scope="col">Cena</th>
            <th scope="col">Składniki</th>
            <th scope="col">Usuń</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dishes as $key => $dish)
        <tr>
            <th scope="row">{{ $key + 1 }}</th>
            <td>
                <input type="checkbox" class="selectedItem" name="selectedItems[]" value="{{ $key }}">
            </td>
            <td><img src="{{ $dish->image }}" alt="{{ $dish->name }}" style="max-width: 70px"></td>
            <td>{{ $dish->name }}</td>
            <td>{{ $dish->price }} zł</td>
            <td>{{ $dish->dish_ingridients }}</td>
            <td>
                <form class="delete-dish-form" data-dish-name="{{ $dish->name }}" action="{{route('cart.deleteDish')}}" method="POST">
                    @csrf
                    <input type="hidden" name="cart_id" value="{{ $key }}">
                    <button type="submit" class="btn btn-danger">Usuń z koszyka</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-between mb-3">
    <div>
        <span class="fw-bold text-white" id="totalNumber">Iłość: {{ $number }}</span>
        <br>
        <span class="fw-bold text-white" id="totalAmount" data-amount="{{ $amount }}">Całość: {{ $amount }} zł</span>
    </div>
    <div>
        <a href="{{ route('order.index') }}" class="btn btn-primary btn-as-link" id="orderButton">Zamów</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-dish-form').forEach(function (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                
                var dishName = form.getAttribute('data-dish-name');
                var url = form.action;
                var formData = new FormData(form);

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': formData.get('_token')
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Succes!',
                            text: `Towar "${dishName}" został usunięty z koszyka!`,
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            form.closest('tr').remove();
                            updateTotalAmount(data.amount);
                            updateNumberAmount(data.number);
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Coś się stało.',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Coś się stało.',
                        showConfirmButton: false,
                        timer: 2000
                    });
                });
            });
        });

        document.getElementById('deleteAllButton').addEventListener('click', function () {
            var url = "{{ route('cart.deleteAll') }}";

            fetch(url, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukces!',
                        text: 'Koszyk został wyczyszczony!',
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        document.querySelectorAll('tbody tr').forEach(row => row.remove());
                        updateTotalAmount(data.amount);
                        updateNumberAmount(data.number);
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Problem!',
                        text: 'Coś się stało.',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Problem!',
                    text: 'Coś się stało.',
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        });

        document.getElementById('deleteSelectedButton').addEventListener('click', function () {
            var selectedItems = document.querySelectorAll('.selectedItem:checked');
            var selectedIds = Array.from(selectedItems).map(item => item.value);

            if (selectedIds.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Uwaga!',
                    text: 'Proszę zaznaczyć elementy do usunięcia.',
                    showConfirmButton: true
                });
                return;
            }

            var url = "{{ route('cart.deleteChosen') }}";
            var formData = new FormData();
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            formData.append('selectedIds', JSON.stringify(selectedIds));

            fetch(url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukces!',
                        text: 'Zaznaczone elementy zostały usunięte z koszyka!',
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        selectedItems.forEach(item => item.closest('tr').remove());
                        updateTotalAmount(data.amount);
                        updateNumberAmount(data.number);
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Problem!',
                        text: 'Coś się stało.',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Problem!',
                    text: 'Coś się stało.',
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        });


        function updateTotalAmount(amount) {
            document.getElementById('totalAmount').textContent = `Całość: ${amount} zł`;
        }

        function updateNumberAmount(number) {
            document.getElementById('totalNumber').textContent = `Ilość: ${number}`;
        }
    });
</script>
<script>
    document.getElementById('orderButton').addEventListener('click', function(event) {
        var amount = parseFloat(document.getElementById('totalAmount').getAttribute('data-amount'));
        if (amount <= 0) {
            event.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Koszyk jest pusty!',
                text: 'Dodaj przedmioty do koszyka przed składaniem zamówienia.',
                showConfirmButton: true
            });
        }
    });
</script>
@endsection