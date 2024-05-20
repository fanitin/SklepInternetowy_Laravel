@extends('layouts.worker')

@section('upper_title')
    Profil pracownika {{$worker->name}}
@endsection

@section('main_content')
    <p>Imię: {{$worker->name}}</p>
    <p>E-mail: {{$worker->email}}</p>
    <p>Profil założono: {{$worker->created_at}}</p>
    <p>Role: @foreach ($worker->roles as $role)
        {{$role->name}}        
    @endforeach</p>
@endsection