@extends('layouts.main')

@section('title')
    {{ $category->name }}
@endsection

@section('main_content')
    <section class="py-2 text-center container">
        <div class="row py-lg-2">
            <div class="col-lg-6 col-md-8 mx-auto text-white">
                <h1 class="fw-light">{{$category->name}}</h1>
                <p>
                    <button type="button" class="btn btn-primary" onclick="window.location.href='{{route('menu.index')}}'">Powrót</button>
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='{{route('home.index')}}'">Na główną stronę</button>
                </p>
            </div>
        </div>
    </section>
    <div class="album py-2 bg-body-dark">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach ($dishes as $dish)
                    <div class="col">
                        <div class="card shadow-sm h-100">
                            <img src="{{ asset($dish->image) }}" class="card-img-top img-center" 
                            alt="{{$dish->name}}" style="object-fit: cover; width: 100%; height: 100%;">
                            <div class="card-body">
                                <p class="card-text text-center">{{$dish->dish_ingridients}}</p>
                                <div class="d-flex justify-content-between align-items-center">
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
                                    <div class="btn-group">
                                        <button type="button" onclick="addToCart({{ $dish->id }})" class="btn btn-sm btn-secondary">Dodaj do koszyka</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        function addToCart(dishId) {
            $.ajax({
                url: '/cart/add',
                type: 'POST',
                data: { 
                    dish_id: dishId,
                    _token: csrfToken
                },
                success: function(response) {
                    $('#cartCount').text(response.cartCount);
                    alert('Dodano do koszyka');
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Wystąpił błąd.');
                }
            });
        }
    </script>
@endsection