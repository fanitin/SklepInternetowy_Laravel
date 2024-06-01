@extends('layouts.main')

@section('title')
    Kontakt
@endsection

@section('main_content')
<style>
    .contact-section {
        background-color: #3a3a3a;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        padding: 20px;
        max-width: 500px;
        margin: auto;
        color: #ffffff;
    }
    .contact-section h2, .contact-section h4 {
        color: #ffd700; /* Золотой цвет */
    }
    .contact-section a {
        color: #ffd700;
        text-decoration: none;
    }
    .contact-section a:hover {
        text-decoration: underline;
    }
</style>
<div class="bg-dark d-flex align-items-center justify-content-center">
    <div class="contact-section text-center text-white">
        <h2 class="mb-4">Kontakt</h2>
        <h4 class="mb-3">Restauracja "undefined"</h4>
        <p>Poniedziałek-piątek: 08:00 - 20:00</p>
        <p class="mb-4">Sobota-niedziela: 10:00 - 23:00</p>
        <p>Adres:</p>
        <p>Katowice, ul. Domyślna 4</p>
        <p>tel: +48 000 000 000 lub  +48 111 111 111</p>
        <p>e-mail: <a href="mailto:contact@undefined.pl">contact@undefined.pl</a></p>
    </div>
</div>
@endsection