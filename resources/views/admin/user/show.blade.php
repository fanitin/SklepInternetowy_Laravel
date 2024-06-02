@extends('layouts.admin')

@section('upper_title')
    Użytkownik #{{ $user->id }}
@endsection

@section('main_content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">Informacje о użytkowniku</div>
                    <div class="card-body">
                        <p><strong>Username:</strong> {{ $user->name }}</p>
                        <p><strong>E-mail:</strong> {{ $user->email }}</p>
                        <p><strong>Profil założony:</strong> {{ $user->created_at }}</p>
                        <p><strong>Profil ostatnio zmieniony:</strong> {{ $user->updated_at }}</p>
                        <p><strong>Role:</strong> 
                            @foreach ($user->roles as $role)
                                {{ $role->name }}        
                            @endforeach
                        </p>
                    </div>
                </div>
                @if (!($user->hasRole(['admin'])) || ($user->id == $userMe->id && Auth::user()->hasRole(['admin'])))
                    <div class="card mt-3">
                        <div class="card-header bg-primary text-white">Edycja ról</div>
                        <div class="card-body">
                            <form action="{{ route('admin.user.edit', $user->id) }}" method="POST">
                                @csrf
                                @foreach ($roles as $role)
                                    @if ($role->name != 'admin' || !$user->hasRole(['admin']))
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox{{$role->id}}" value="{{$role->id}}" name="roles[]" {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineCheckbox{{$role->id}}">{{ $role->name }}</label>
                                        </div>
                                    @endif
                                @endforeach
                                <button type="submit" class="btn btn-primary mt-3">Edytuj</button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection