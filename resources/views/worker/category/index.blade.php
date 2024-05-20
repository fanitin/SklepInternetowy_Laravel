@extends('layouts.worker')

@section('upper_title')
    Kategorie
@endsection

@section('main_content')
<form id="searchForm" method="POST" action="{{ route('worker.category.search') }}">
    @csrf
    <input type="text" name="searchTerm" id="searchTerm" placeholder="Szukaj...">
    <select name="searchType" id="searchType">
        <option value="id">ID</option>
        <option value="name">Nazwa</option>
    </select>
    <button type="submit">Szukaj</button>
</form>

<form id="sortForm" method="POST" action="{{ route('worker.category.sort') }}">
    @csrf
    <select name="sortColumn" id="sortColumn">
        <option value="id">ID</option>
        <option value="name">Nazwa</option>
        <option value="created_at">Data</option>
    </select>
    <select name="sortOrder" id="sortOrder">
        <option value="asc">Rosnąco</option>
        <option value="desc">Malejąco</option>
    </select>
    <button type="submit">Sortuj</button>
</form>

<a href="{{route('worker.category.add')}}" class="btn btn-primary btn-as-link m-2">Dodaj nową kategorię</a>
<table id="categoriesTable" class="table table-striped  table-dark table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nazwa</th>
            <th>Data utworzenia</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <td>{{$category->created_at}}</td>
                <td><form action="{{route('worker.category.destroy', $category->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-danger" value="Usuń">
                </form></td>
                <td>
                    <button class="btn btn-warning"><a class="text-white" href="{{route('worker.category.send', $category->id)}}">Edytuj</a></button>
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
                    $('#categoriesTable tbody').empty();
                    response.forEach(function(category) {
                        let createdAt = new Date(category.created_at).toLocaleString('pl-PL', {
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit',
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit'
                        });
                        $('#categoriesTable tbody').append(`
                            <tr>
                                <td>${category.id}</td>
                                <td>${category.name}</td>
                                <td>${createdAt}</td>
                                <td>
                                    <form method="POST" action="/worker/category/${category.id}/delete">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                                        <button type="submit" class="btn btn-danger">Usuń</button>
                                    </form>
                                </td>
                                <td>
                                    <button class="btn btn-warning"><a class="text-white" href="worker/category/${category.id}/edit">Edytuj</a></button>
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
                    $('#categoriesTable tbody').empty();
                    response.forEach(function(category) {
                        let createdAt = new Date(category.created_at).toLocaleString('pl-PL', {
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit',
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit'
                        });
                        $('#categoriesTable tbody').append(`
                            <tr>
                                <td>${category.id}</td>
                                <td>${category.name}</td>
                                <td>${createdAt}</td>
                                <td>
                                    <form method="POST" action="/worker/category/${category.id}/delete">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                                        <button type="submit" class="btn btn-danger">Usuń</button>
                                    </form>
                                </td>
                                <td>
                                    <button class="btn btn-warning"><a class="text-white" href="worker/category/${category.id}/edit">Edytuj</a></button>
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