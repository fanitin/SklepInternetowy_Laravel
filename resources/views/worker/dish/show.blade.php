@extends('layouts.worker')

@section('upper_title')
    Danie #{{$dish->id}}
@endsection

@section('main_content')
    <div class="col mx-auto" style="max-width: 360px; max-height: 360px;">
        <div class="card shadow-sm">
            <div class="card-header text-center">{{$dish->name}}</div>
            <img src="{{ asset($dish->image) }}" class="card-img-top img-center" alt="{{$dish->name}}" style="max-width: 360px; max-height: 360px;">
            <div class="card-body">
                <p class="card-text text-center">{{$dish->dish_ingridients}}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <form action="{{route("worker.dish.send", $dish->id)}}">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-secondary">Edit</button>
                        </form>
                        <form action="{{ route('worker.dish.destroy', $dish->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-secondary">Delete</button>
                        </form>
                        <p class="text-body-footer">ID: {{$dish->id}}</p>
                    </div>
                    <div>
                        <div>
                            <small class="text-body-secondary">Cena: {{$dish->price}} zł</small>
                        </div>
                        @if ($dish->weight != null)
                            <div>
                                <small class="text-body-secondary">Waga: {{$dish->weight}} g</small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
  </div>
@endsection