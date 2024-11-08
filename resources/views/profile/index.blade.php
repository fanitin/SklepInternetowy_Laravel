@extends('layouts.main')

@section('main_content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="bg-dark border-white text-white card">
                    <div class="card-header bs-secondary-bg text-white">Informacje o użytkowniku</div>
                    <div class="card-body">
                        <p><strong>Imię:</strong> {{ $user->name }}</p>
                        <p><strong>E-mail:</strong> {{ $user->email }}</p>
                        <p><strong>Profil założono:</strong> {{ $user->created_at }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-8 mb-3">
                <div class="bg-dark border-white text-white card">
                    <div class="card-header bs-secondary-bg text-white">Aktualne zamówienia</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-dark table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID Zamówienia</th>
                                        <th>Data Zamówienia</th>
                                        <th>Status</th>
                                        <th>Ostatnia zmiana</th>
                                        <th>Anuluj</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                    @if ($order->status_id === 1 || $order->status_id === 2 || $order->status_id === 3) 
                                        <tr>
                                            <td><a href="{{route('profile.order', $order->id)}}" class="btn btn-primary btn-as-link">{{ $order->id }}</a></td>
                                            <td>{{ $order->created_at }}</td>
                                            <td>{{ $order->status->name }}</td>
                                            <td>{{ $order->updated_at }}</td>
                                            @if ($order->status_id == 1)
                                                <td><a href="{{route('profile.cancelOrder', $order->id)}}" class="btn btn-danger btn-sm cancel-order-btn">Anuluj</a></td>
                                            @endif
                                        </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="bg-dark border-white text-white card">
                    <div class="card-header bs-secondary-bg text-white">Poprzednie zamówienia</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-dark table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID Zamówienia</th>
                                        <th>Data Zamówienia</th>
                                        <th>Status</th>
                                        <th>Ostatnia zmiana</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                    @if ($order->status_id === 4 || $order->status_id === 5) 
                                        <tr>
                                            <td><a href="{{route('profile.order', $order->id)}}" class="btn btn-primary btn-as-link">{{ $order->id }}</a></td>
                                            <td>{{ $order->created_at }}</td>
                                            <td>{{ $order->status->name }}</td>
                                            <td>{{ $order->updated_at }}</td>
                                        </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cancelButtons = document.querySelectorAll('.cancel-order-btn');
            cancelButtons.forEach(button => {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    const url = this.href;

                    Swal.fire({
                        title: 'Czy na pewno chcesz anulować zamówienie?',
                        text: "Tej operacji nie można cofnąć!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Tak, anuluj!',
                        cancelButtonText: 'Nie, zostaw'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = url;
                        }
                    });
                });
            });
        });
    </script>
@endsection