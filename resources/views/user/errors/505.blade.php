@extends('frontend.frontend_master')

<style>
    h1 {
        color: #333;
        font-size: 3em;
        margin-bottom: 20px;
    }

    p {
        color: #555;
        font-size: 1.2em;
        margin-top: 20px;
    }

    .buttons {
        margin-top: 30px;
    }

    .buttons a {
        display: inline-block;
        padding: 10px 20px;
        margin: 0 10px;
        text-decoration: none;
        color: #fff;
        background-color: #3498db;
        border-radius: 5px;
        font-size: 1.2em;
        transition: background-color 0.3s ease;
    }

    .buttons a:hover {
        background-color: #2980b9;
    }
</style>

@section('frontend_content')


<div class="py-5 text-center">
    <h1 class="animate__animated animate__fadeInDown">505 - Not Found</h1>
    <p class="animate__animated animate__fadeInUp">The page you are looking for might be under construction or does not
        exist.</p>

    <div class="buttons animate__animated animate__fadeIn">
        <a href="{{ url('/') }}" class="animate__animated animate__pulse">Home</a>
        <a href="{{ route('contact.page') }}" class="animate__animated animate__pulse">Contact</a>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.js"></script>
@endsection
