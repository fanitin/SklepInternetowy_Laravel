@extends('layouts.worker')

@section('upper_title')
    Płatności
@endsection

@section('main_content')
<form id="searchForm" method="POST" action="{{ route('worker.payment.search') }}">
    @csrf
    <input type="text" name="searchTerm" id="searchTerm" placeholder="Szukaj...">
    <select name="searchType" id="searchType">
        <option value="id">ID</option>
        <option value="service">Nazwa serwisu</option>
    </select>
    <button type="submit">Szukaj</button>
</form>

<form id="sortForm" method="POST" action="{{ route('worker.payment.sort') }}">
    @csrf
    <select name="sortColumn" id="sortColumn">
        <option value="id">ID</option>
        <option value="service">Service</option>
        <option value="created_at">Data</option>
        <option value="amount">Całość</option>
    </select>
    <select name="sortOrder" id="sortOrder">
        <option value="asc">Rosnąco</option>
        <option value="desc">Malejąco</option>
    </select>
    <button type="submit">Sortuj</button>
</form>

<table id="paymentsTable" class="table table-striped  table-dark table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nazwa serwisu</th>
            <th>Data płatności</th>
            <th>Całość</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($payments as $payment)
            <tr>
                <td><a href="{{route('worker.order.show', $payment->order->id)}}" class="btn btn-primary btn-as-link">{{$payment->id}}</a></td>
                <td>{{$payment->service}}</td>
                <td>{{$payment->created_at}}</td>
                <td>{{$payment->amount}} zł</td>
            </tr>
        @endforeach
    </tbody>
    
</table>
<div class="text-white mt-3">

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#searchForm').on('submit', function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                success: function(response) {
                    $('#paymentsTable tbody').empty();
                    response.forEach(function(payment) {
                        let createdAt = new Date(payment.created_at).toLocaleString('pl-PL', {
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit',
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit'
                        });
                        $('#paymentsTable tbody').append(`
                        <tr>
                            <td><a href="/worker/order/${payment.order_id}/show" class="btn btn-primary btn-as-link">${payment.id}</a></td>
                            <td>${payment.service}</td>
                            <td>${createdAt}</td>
                            <td>${payment.amount}  zł</td>
                        </tr>
                        `);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        $('#sortForm').on('submit', function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                success: function(response) {
                    $('#paymentsTable tbody').empty();
                    response.forEach(function(payment) {
                        let createdAt = new Date(payment.created_at).toLocaleString('pl-PL', {
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit',
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit'
                        });
                        $('#paymentsTable tbody').append(`
                        <tr>
                            <td><a href="/worker/order/${payment.order_id}/show" class="btn btn-primary btn-as-link">${payment.id}</a></td>
                            <td>${payment.service}</td>
                            <td>${createdAt}</td>
                            <td>${payment.amount}  zł</td>
                        </tr>
                        `);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

@endsection