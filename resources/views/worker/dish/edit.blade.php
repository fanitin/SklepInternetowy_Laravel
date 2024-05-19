@extends('layouts.worker')

@section('upper_title')
    Zmiana dania #{{$dish->id}}
@endsection

@section('main_content')
<div class="container mt-5">
    <form action="{{ route('worker.dish.edit', $dish->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="id_name" class="form-label">Nazwa</label>
                <input type="text" class="form-control" id="id_name" name="name" value="{{$dish->name}}">
            </div>
            <div class="col-md-4">
                <label for="id_price" class="form-label">Price</label>
                <input type="text" class="form-control" id="id_price" name="price" value="{{$dish->price}}">
            </div>
            <div class="col-md-4">
                <label for="id_weight" class="form-label">Weight</label>
                <input type="text" class="form-control" id="id_weight" name="weight" value="{{$dish->weight}}">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="id_is_active" class="form-label">Dostępność</label>
                <select name="is_active" id="id_is_active" class="form-select">
                    <option value="1" {{($dish->is_active == 1) ? 'selected' : '' }}>Tak</option>
                    <option value="0" {{($dish->is_active == 0) ? 'selected' : '' }}>Nie</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="formFile" class="form-label">Zdjęcie</label>
                <input class="form-control" type="file" id="formFile" name="image">
            </div>
            <div class="col-md-4">
                <label for="id_dish_category" class="form-label">Kategoria</label>
                <select name="dish_category_id" id="id_dish_category" class="form-select">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{($dish->dish_category_id == $category->id) ? 'selected' : '' }}>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <label for="id_ingridients" class="form-label">Składniki</label>
                <input type="text" class="form-control" id="id_ingridients" name="dish_ingridients" value="{{ $dish->ingridients }}">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-light" onclick="window.location.href='{{ url()->previous() }}'">Anuluj</button>
            </div>
        </div>
    </form>
</div>
@endsection