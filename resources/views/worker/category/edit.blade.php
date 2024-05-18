@extends('layouts.worker')

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
@endsection