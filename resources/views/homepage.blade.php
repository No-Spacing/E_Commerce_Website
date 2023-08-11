@extends('layouts.master')

@section('content')

<div class="bg-light d-flex justify-content-center" data-aos="fade-up">
    <div id="carouselExampleIndicators" class="carousel slide w-75" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="7500">
                <img src="img/promo.jpeg" class="d-block w-100" alt="..." style="width:100%; height: 500px">
            </div>
            <div class="carousel-item" data-bs-interval="7500">
                <img src="img/products.jpeg" class="d-block w-100" alt="..." style="width:100%; height: 500px">
            </div>
            <div class="carousel-item" data-bs-interval="7500">
                <img src="img/healthproducts.jpeg" class="d-block w-100" alt="..." style="width:100%; height: 500px">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<div class="bg-secondary d-flex justify-content-center pt-5 mt-5" data-aos="fade-right">
    this is another content...
</div>
<div class="bg-secondary d-flex justify-content-center pt-5 mt-5" data-aos="fade-right">
    this is another content...
</div>
<div class="bg-secondary d-flex justify-content-center pt-5 mt-5" data-aos="fade-right">
    this is another content...
</div>
<div class="bg-secondary d-flex justify-content-center pt-5 mt-5" data-aos="fade-right">
    this is another content...
</div>
<div class="bg-secondary d-flex justify-content-center pt-5 mt-5" data-aos="fade-right">
    this is another content...
</div>
@stop
