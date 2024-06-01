@extends('layouts.main')

@section('title')
    Menu
@endsection

@section('main_content')
<style>
    .album {
        background-color: #343638;
    }
    .card {
        border: none;
        border-radius: 15px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }
    .card-img-top {
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        height: 200px;
        object-fit: cover;
    }
    .card-body {
        background-color: #ffffff;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
    }
    .card-text {
        color: #333333;
    }
</style>
    <section class="py-2 text-center container">
        <div class="row py-lg-2">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Menu</h1>
                <p class="lead">Odkryj nasze pyszne dania i znajdź swoje ulubione!</p>
            </div>
        </div>
    </section>

    <!-- Album Section -->
    <div class="album py-2 bg-body-dark">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach ($categories as $category)
                <div class="col">
                    <a href="{{ route('menu.category', $category) }}" class="text-decoration-none">
                        <div class="card shadow-sm">
                            <img src="{{ asset($category->dishes->first()->image) }}" class="card-img-top img-center" 
                            alt="{{$category->name}}">
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