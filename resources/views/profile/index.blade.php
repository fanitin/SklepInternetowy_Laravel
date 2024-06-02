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
                        <p><strong>Role:</strong> 
                            @foreach ($user->roles as $role)
                                {{ $role->name }}        
                            @endforeach
                        </p>
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
                                        <th>Anuluj</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                    @if ($order->status_id === 1 || $order->status_id === 2 || $order->status_id === 3) 
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->created_at }}</td>
                                            <td>{{ $order->status->name }}</td>
                                            <td><a href="{{route('profile.cancelOrder', $order->id)}}" class="btn btn-danger btn-sm">Anuluj</a></td>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                    @if ($order->status_id === 4 || $order->status_id === 5) 
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->created_at }}</td>
                                            <td>{{ $order->status->name }}</td>
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
@endsection