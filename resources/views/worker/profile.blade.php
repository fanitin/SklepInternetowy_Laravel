@extends('layouts.worker')

@section('upper_title')
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="text-white">Profil pracownika {{ $worker->name }}</h2>
            </div>
        </div>
    </div>
@endsection

@section('main_content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">Informacje о pracowniku</div>
                    <div class="card-body">
                        <p><strong>Imię:</strong> {{ $worker->name }}</p>
                        <p><strong>E-mail:</strong> {{ $worker->email }}</p>
                        <p><strong>Profil założono:</strong> {{ $worker->created_at }}</p>
                        <p><strong>Role:</strong> 
                            @foreach ($worker->roles as $role)
                                {{ $role->name }}        
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
