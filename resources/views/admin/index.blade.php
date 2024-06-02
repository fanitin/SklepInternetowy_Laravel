@extends('layouts.admin')

@section('upper_title')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h2 class="text-primary">Panel administratora</h2>
            </div>
        </div>
    </div>
@endsection

@section('main_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <p class="lead">Witaj, Administratorze!</p>
                        <p class="text-muted">Tutaj możesz zarządzać wszystkimi ustawieniami i danymi witryny.</p>
                        <p>Rozpocznij od nawigacji po lewej stronie, aby uzyskać dostęp do poszczególnych sekcji.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
