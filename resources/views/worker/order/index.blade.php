@extends('layouts.worker')

@section('upper_title')
    Zamówienia
@endsection

@section('main_content')
<form id="searchForm" method="POST" action="{{ route('worker.order.search') }}">
    @csrf
    <input type="text" name="searchTerm" id="searchTerm" placeholder="Szukaj...">
    <select name="searchType" id="searchType">
        <option value="orders.id">ID</option>
        <option value="orders.address">Adres</option>
        <option value="orders.phone">Numer</option>
    </select>
    <button type="submit">Szukaj</button>
</form>

<form id="sortForm" method="POST" action="{{ route('worker.order.sort') }}">
    @csrf
    <select name="sortColumn" id="sortColumn">
        <option value="orders.status_id">Status</option>
        <option value="orders.id">ID</option>
        <option value="orders.address">Adres</option>
        <option value="payments.amount">Całość</option>
        <option value="orders.created_at">Data</option>
    </select>
    <select name="sortOrder" id="sortOrder">
        <option value="asc">Rosnąco</option>
        <option value="desc">Malejąco</option>
    </select>
    <button type="submit">Sortuj</button>
</form>

<table id="ordersTable" class="table table-dark border border-light">
    <thead>
        <tr>
            <th>ID</th>
            <th>Adres</th>
            <th>Numer</th>
            <th>Całość</th>
            <th>Data</th>
            <th>Płatność</th>
            <th>Status</th>
            <th>Ostatnio zmienił</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr>
                <td><a href="{{route('worker.order.show', $order->id)}}" class="btn btn-primary btn-as-link">{{$order->id}}</a></td>
                <th>{{$order->address}}</th>
                <th>{{$order->phone}}</th>
                <th>{{$order->payment->amount}} zł</th>
                <th>{{$order->created_at}}</th>
                <th>{{$order->payment_id}}</th>
                <th>
                    <form action="{{route('worker.order.changeStatus', $order->id)}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select name="status_id">
                            @foreach ($statuses as $status)
                                <option value="{{$status->id}}" {{($status->id == $order->status_id) ? 'selected' : ''}} >{{$status->name}}</option>
                            @endforeach
                        </select>
                        <input type="submit" value="Zmien status" class="btn btn-primary">
                    </form>
                </th>
                <th>ID: {{$order->processed_by_user_id}}</th>
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
                    $('#ordersTable tbody').empty();
                    response.forEach(function(order) {
                        let createdAt = new Date(order.created_at).toLocaleString('pl-PL', {
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit',
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit'
                        });
                        $('#ordersTable tbody').append(`
                        <tr>
                            <td><a href="worker/order/${order.id}/show" class="btn btn-primary btn-as-link">${order.id}</a></td>
                            <th>${order.address}</th>
                            <th>${order.phone}</th>
                            <th>${order.amount} zł</th>
                            <th>${createdAt}</th>
                            <th>${order.payment_id}</th>
                            <th>${order.status}</th>
                            <th>ID: ${order.processed_by_user_id}</th>
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
                    $('#ordersTable tbody').empty();
                    response.forEach(function(order) {
                        let createdAt = new Date(order.created_at).toLocaleString('pl-PL', {
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit',
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit'
                        });
                        $('#ordersTable tbody').append(`
                        <tr>
                            <td><a href="worker/order/${order.id}/show" class="btn btn-primary btn-as-link">${order.id}</a></td>
                            <th>${order.address}</th>
                            <th>${order.phone}</th>
                            <th>${order.amount} zł</th>
                            <th>${createdAt}</th>
                            <th>${order.payment_id}</th>
                            <th>${order.status}</th>
                            <th>ID: ${order.processed_by_user_id}</th>
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