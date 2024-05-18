@extends('layouts.worker')

@section('main_content')
<div class="container mt-5">
    <form action="{{ route('worker.dish.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="id_name" class="form-label">Nazwa</label>
                <input type="text" class="form-control" id="id_name" name="name" value="{{ old('name') }}">
            </div>
            <div class="col-md-4">
                <label for="id_price" class="form-label">Price</label>
                <input type="text" class="form-control" id="id_price" name="price" value="{{ old('price') }}">
            </div>
            <div class="col-md-4">
                <label for="id_weight" class="form-label">Weight</label>
                <input type="text" class="form-control" id="id_weight" name="weight" value="{{ old('weight') }}">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="id_is_active" class="form-label">Dostępność</label>
                <select name="is_active" id="id_is_active" class="form-select">
                    <option value="1">Tak</option>
                    <option value="0">Nie</option>
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
                        <option value="{{ $category->id }}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <label for="id_ingridients" class="form-label">Składniki</label>
                <input type="text" class="form-control" id="id_ingridients" name="dish_ingridients" value="{{ old('dish_ingridients') }}">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection