@extends('layouts.worker')

@section('upper_title')
    Zmiana kategorii #{{$dish_category->id}}
@endsection

@section('main_content')
<div class="container mt-5">
    <form action="{{ route('worker.category.edit', $dish_category->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="row mb-3">
            <div class="col-9">
                <label for="id_name" class="form-label">Nazwa</label>
                <input type="text" class="form-control" id="id_name" name="name" value="{{ $dish_category->name }}">
            </div>
            <div class="col-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>

<table class="table table-striped  table-dark table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nazwa</th>
            <th>Cena</th>
            <th>Data utworzenia</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dishes as $dish)
            <tr>
                <td>{{$dish->id}}</td>
                <td><a href="{{route('worker.dish.show', $dish->id)}}" class="btn btn-primary btn-as-link">{{$dish->name}}</a></td>
                <td>{{$dish->price}}</td>
                <td>{{$dish->created_at}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection