@extends('layouts.main')

@section('title')
    Koszyk
@endsection

@section('main_content')
<div class="d-flex justify-content-between mb-3">
    <div>
        <button class="btn btn-danger" onclick="clearCart()">Wyczyść koszyk</button>
        <button class="btn btn-warning" onclick="removeSelectedItems()">Usuń zaznaczone</button>
    </div>
</div>

<table class="table table-striped  table-dark table-bordered">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Wybierz</th>
            <th scope="col">Zdjecie</th>
            <th scope="col">Nazwa</th>
            <th scope="col">Cena</th>
            <th scope="col">Składniki</th>
            <th scope="col">Usuń</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dishes as $key => $dish)
        <tr>
            <th scope="row">{{ $key + 1 }}</th>
            <td>
                <input type="checkbox" name="selectedItems[]" value="{{ $dish->id }}">
            </td>
            <td><img src="{{ $dish->image }}" alt="{{ $dish->name }}" style="max-width: 70px"></td>
            <td>{{ $dish->name }}</td>
            <td>{{ $dish->price }}</td>
            <td>{{ $dish->dish_ingridients }}</td>
            <td>
                <form action="/" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-between mb-3">
    <span class="fw-bold text-white">Całość: {{ $amount }} zł</span>
    <div>
        <button class="btn btn-primary" onclick="addToCart()">Zamów</button>
    </div>
</div>
@endsection