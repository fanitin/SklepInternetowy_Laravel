@extends('layouts.main')

@section('title')
    Menu
@endsection

@section('main_content')
    <section class="py-2 text-center container">
        <div class="row py-lg-2">
        <div class="col-lg-6 col-md-8 mx-auto text-white">
            <h1 class="fw-light">Menu</h1>
            <p class="lead text-white">Odkryj nasze pyszne dania i znajdź swoje ulubione!</p>
        </div>
        </div>
    </section>
    <div class="album py-2 bg-body-dark">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach ($categories as $category)
                <div class="col">
                    <a href="{{ route('menu.category', $category) }}" class="text-decoration-none">
                        <div class="card shadow-sm">
                            <img src="{{ asset($category->dishes->first()->image) }}" class="card-img-top img-center" 
                            alt="{{$category->name}}" style="object-fit: cover; width: 100%; height: 100%;">
                            <div class="card-body">
                                <p class="card-text text-center fs-2">{{$category->name}}</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection