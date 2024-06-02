@extends('layouts.admin')

@section('upper_title')
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="text-white">Profil admina <strong>{{ $admin->name }}</strong></h2>
            </div>
        </div>
    </div>
@endsection

@section('main_content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">Informacje o pracowniku</div>
                    <div class="card-body">
                        <p><strong>Imię:</strong> {{ $admin->name }}</p>
                        <p><strong>E-mail:</strong> {{ $admin->email }}</p>
                        <p><strong>Profil założono:</strong> {{ $admin->created_at }}</p>
                        <p><strong>Role:</strong> 
                            @foreach ($admin->roles as $role)
                                {{ $role->name }}        
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
