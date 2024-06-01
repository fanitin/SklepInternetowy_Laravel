@extends('layouts.main')
@section('title')
    Home page
@endsection
@section('main_content')
<style>
    .hero-section {
        background: url('images/111.png') no-repeat center center;
        background-size: cover;
        color: #ffffff;
        height: 70vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }
    .hero-section h1 {
        font-size: 4rem;
    }
    .about-section, .menu-section {
        padding: 60px 20px;
    }
    .menu-item {
        margin-bottom: 30px;
    }
</style>
<!-- Hero Section -->
<section class="hero-section">
    <h1>Witamy w Restauracji "undefined"</h1>
    <p class="lead"><strong>Najlepsze miejsce na pyszne jedzenie i wspaniałą atmosferę</strong></p>
</section>

<!-- About Section -->
<section class="about-section bg-light text-center">
    <div class="container">
        <h2 class="mb-4">O nas</h2>
        <p class="lead">Restauracja "undefined" to miejsce, gdzie tradycja spotyka się z nowoczesnością. Nasz zespół przygotowuje dla Was wyśmienite potrawy, korzystając z najświeższych składników.</p>
    </div>
</section>
@endsection