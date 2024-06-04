@extends('layouts.worker')

@section('upper_title')
    Zamówienie #{{$order->id}}
@endsection

@section('main_content')
<div>
    <form action="{{route('worker.order.changeStatus', $order->id)}}" method="POST">
        @csrf
        @method('PATCH')
        <label for="id_status" class="form-label">Status</label>
        <br>
        <select name="status_id" id="id_status">
            @foreach ($statuses as $status)
                <option value="{{$status->id}}" {{($status->id == $order->status_id) ? 'selected' : ''}} >{{$status->name}}</option>
            @endforeach
        </select>
        <input type="submit" value="Zmien status" class="btn btn-primary">
    </form>
    <p class="mt-3">Liczba dań w zamówieniu: {{$order->dishes->count()}}</p>
</div>

<table id="dishesTable" class="table table-striped  table-dark table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Zdjęcie</th>
            <th>Nazwa</th>
            <th>Cena</th>
            <th>Is_active</th>
            <th>Categoria</th>
            <th>Data utworzenia</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dishes as $dish)
            <tr>
                <td>{{$dish->id}}</td>
                <td><img src="{{ asset($dish->image) }}" alt="{{ $dish->name }}" style="max-width: 70px"></td>
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
            </tr>
        @endforeach
    </tbody>
</table>
@endsection