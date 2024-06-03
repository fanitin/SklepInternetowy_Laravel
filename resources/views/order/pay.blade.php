<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-PL-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Płatność</title>
    <link rel="icon" href="images/basket3.svg">
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <style>
        .box {
            background-color: #46484c;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body class="bg-dark">
    <header class="d-flex flex-wrap align-items-center justify-content-between justify-content-md-between py-3 mb-4 border-bottom bg-dark">
    <ul class="nav col-12 col-md-auto mb-2 justify-content-start mb-md-0">
        <li> <a href="{{route('home.index')}}" class="nav-link px-2 link-secondary text-white">Strona główna</a></li>
    </ul>
</header>


    <div class="container">
        <form action="{{ route('order.make') }}" method="POST" id="orderForm">
            @csrf
            @include('includes.payment.' . $service)
            <input type="submit" value="Wprowadź" class="btn btn-primary">
        </form>
    </div>

    @if ($errors->any())
    <div class="container alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


</body>
</html>