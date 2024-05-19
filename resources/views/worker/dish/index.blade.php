@extends('layouts.worker')

@section('upper_title')
    Dania
@endsection

@section('main_content')
<form id="searchForm" method="POST" action="{{ route('worker.dish.search') }}">
    @csrf
    <input type="text" name="searchTerm" id="searchTerm" placeholder="Szukaj...">
    <select name="searchType" id="searchType">
        <option value="dishes.id">ID</option>
        <option value="dishes.name">Nazwa</option>
        <option value="dish_categories.name">Kategoria</option>
    </select>
    <button type="submit">Szukaj</button>
</form>

<form id="sortForm" method="POST" action="{{ route('worker.dish.sort') }}">
    @csrf
    <select name="sortColumn" id="sortColumn">
        <option value="dishes.id">ID</option>
        <option value="dishes.name">Nazwa</option>
        <option value="dishes.price">Cena</option>
        <option value="dishes.is_active">Dostepność</option>
        <option value="dish_categories.name">Kategoria</option>
        <option value="dishes.created_at">Data</option>
    </select>
    <select name="sortOrder" id="sortOrder">
        <option value="asc">Rosnąco</option>
        <option value="desc">Malejąco</option>
    </select>
    <button type="submit">Sortuj</button>
</form>

<a href="{{route('worker.dish.add')}}" class="btn btn-primary btn-as-link m-2">Dodaj nowe danie</a>
<table id="dishesTable" class="table table-dark border border-light">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nazwa</th>
            <th>Cena</th>
            <th>Is_active</th>
            <th>Categoria</th>
            <th>Data utworzenia</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dishes as $dish)
            <tr>
                <td>{{$dish->id}}</td>
                <td><a href="{{route('worker.dish.show', $dish->id)}}" class="btn btn-primary btn-as-link">{{$dish->name}}</a></td>
                <td>{{$dish->price}}</td>
                <td class="@if ($dish->is_active == 1)bg-success
                    @else bg-warning
                    @endif
                    ">{{$dish->is_active}}</td>
                <td>
                    @if ($dish->category != null)
                    {{$dish->category->name}}
                    @else NULL
                    @endif</td>
                <td>{{$dish->created_at}}</td>
                <td>
                    <form action="{{route('worker.dish.destroy', $dish->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger" value="Usuń">
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="text-white mt-3">

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#searchForm').on('submit', function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                success: function(response) {
                    $('#dishesTable tbody').empty();
                    response.forEach(function(dish) {
                        var rowClass = dish.is_active == 1 ? 'bg-success' : 'bg-warning';
                        let createdAt = new Date(dish.created_at).toLocaleString('pl-PL', {
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit',
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit'
                        });
                        $('#dishesTable tbody').append(`
                        <tr>
                            <td>${dish.id}</td>
                            <td><a href="/worker/dish/${dish.id}/show" class="btn btn-primary btn-as-link">${dish.name}</a></td>
                            <td>${dish.price}</td>
                            <td  class="${rowClass}">${dish.is_active}</td>
                            <td>${dish.category}</td>
                            <td>${createdAt}</td>
                            <td>
                                <form method="POST" action="/worker/dish/${dish.id}/delete">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                                    <button type="submit" class="btn btn-danger">Usuń</button>
                                </form>
                            </td>
                        </tr>
                        `);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        $('#sortForm').on('submit', function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                success: function(response) {
                    $('#dishesTable tbody').empty();
                    response.forEach(function(dish) {
                        var rowClass = dish.is_active == 1 ? 'bg-success' : 'bg-warning';
                        let createdAt = new Date(dish.created_at).toLocaleString('pl-PL', {
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit',
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit'
                        });
                        $('#dishesTable tbody').append(`
                        <tr>
                            <td>${dish.id}</td>
                            <td><a href="/worker/dish/${dish.id}/show" class="btn btn-primary btn-as-link">${dish.name}</a></td>
                            <td>${dish.price}</td>
                            <td  class="${rowClass}">${dish.is_active}</td>
                            <td>${dish.category}</td>
                            <td>${createdAt}</td>
                            <td>
                                <form method="POST" action="/worker/dish/${dish.id}/delete">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                                    <button type="submit" class="btn btn-danger">Usuń</button>
                                </form>
                            </td>
                        </tr>
                        `);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

@endsection