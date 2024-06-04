@extends('layouts.main')

@section('main_content')
    <div class="container mt-4">
        <div class="row mb-3">
            <div class="col">
                <div class="card bg-dark text-white">
                    <div class="card-header">
                        <h4>Szczegóły Zamówienia</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>ID Zamówienia:</strong> {{ $order->id }}</p>
                        <p><strong>Data Zamówienia:</strong> {{ $order->created_at }}</p>
                        <p><strong>Status Zamówienia:</strong> {{ $order->status->name }}</p>
                        <p><strong>Adres Wysyłki:</strong> {{ $order->address }}</p>
                        <p><strong>Numer Telefonu:</strong> {{ $order->phone }}</p>
                        <p><strong>Metoda Płatności:</strong> {{ $order->payment ? $order->payment->service : 'Nieznana' }}</p>
                        <p><strong>Przetworzone przez:</strong> {{ $order->processed_by_user_id ? $order->processedByUser->name.', ID pracownika: '. $order->processed_by_user_id : 'Nie przetworzone' }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card bg-dark text-white">
                    <div class="card-header">
                        <h4>Produkty w Zamówieniu</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-dark table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Zdjęcie</th>
                                        <th>Nazwa</th>
                                        <th>Cena</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->dishes as $dish)
                                        <tr>
                                            <td>{{ $dish->id }}</td>
                                            <td><img src="{{ asset($dish->image) }}" alt="{{ $dish->name }}" style="max-width: 70px"></td>
                                            <td>{{ $dish->name }}</td>
                                            <td>{{ $dish->price }} zł</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection