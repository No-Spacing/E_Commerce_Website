@extends('layouts.master')

@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.rawgit.com/michalsnik/aos/2.0.1/dist/aos.css" />
    <script src="https://cdn.rawgit.com/michalsnik/aos/2.0.1/dist/aos.js"></script>
    <link rel="stylesheet" href="css/homepage.css">
    <link rel="icon" type="image/x-icon" href="img/brigada-icon.png">
    <title>Home</title>
@stop

@section('content')
<div class="d-flex flex-column bg-light justify-content-center container-fluid mb-5 advertisment">
    @if(!Session::has('items'))
        <div id="carouselExampleIndicators" class="carousel slide container" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/health-products.jpg" class="d-block w-100" alt="...">
                </div>
                 <div class="carousel-item">
                    <img src="img/lazada-brigada.jpg" class="d-block w-100" style="height: 540px" alt="...">
                </div>
                <!--
                <div class="carousel-item">
                    <img src="" class="d-block w-100" alt="...">
                </div> 
                -->
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
       
        <div class="container">
            <hr>
            <h3 class="h3">Tags</h3>
            <div class="scrollmenu d-flex flex-row justify-content-between flex-row container">
                <a class="d-flex flex-column justify-content-center" href="{{ route('tags', ['tag' => 'Immunity']) }}"><img src="products/guard-c.png" class="align-self-center" alt="..." style="width:100px; height: 100px"><span>Immunity</span></a>
                <a class="d-flex flex-column justify-content-center" href="{{ route('tags', ['tag' => 'Multivitamins']) }}"><img src="products/yummyvit.jfif" class="align-self-center" alt="..." style="width:100px; height: 100px"><span>Multivitamins</span></a>
                <a class="d-flex flex-column justify-content-center" href="{{ route('tags', ['tag' => 'Sexual Health Vitamins']) }}"><img src="products/drivemax.png" class="align-self-center" alt="..." style="width:100px; height: 100px"><span>Sexual Health Vitamins</span></a>
                <a class="d-flex flex-column justify-content-center" href="{{ route('tags', ['tag' => 'Nutritional Foods & Drinks']) }}"><img src="products/maxan.jpg" class="align-self-center" alt="..." style="width:130px; height: 100px"><span>Nutritional Foods & Drinks</span></a>
                <a class="d-flex flex-column justify-content-center" href="{{ route('tags', ['tag' => 'Pain Relief & Fever']) }}"><img src="products/paracetamol-painrelief.jpeg" class="align-self-center" alt="..." style="width:100px; height: 100px"><span>Pain Relief & Fever</span></a>
                <a class="d-flex flex-column justify-content-center" href="{{ route('tags', ['tag' => 'Digestive Care']) }}"><img src="products/nutri-cleanse.jfif" class="align-self-center" alt="..." style="width:100px; height: 100px"><span>Digestive Care</span></a>
                <a class="d-flex flex-column justify-content-center" href="{{ route('tags', ['tag' => 'Lemon & Ginger Tea']) }}"><img src="products/powercell-herbal.jpg" class="align-self-center" alt="..." style="width:100px; height: 100px"><span>Lemon & Ginger Tea</span></a>
                <a class="d-flex flex-column justify-content-center" href="{{ route('tags', ['tag' => 'Brain & Memory']) }}"><img src="products/curamed.jpg" class="align-self-center" alt="..." style="width:100px; height: 100px"><span>Brain & Memory</span></a>
                <a class="d-flex flex-column justify-content-center" href="{{ route('tags', ['tag' => 'Heart & Blood Pressure']) }}"><img src="products/powercell.jfif" class="align-self-center" alt="..." style="width:100px; height: 100px"><span>Heart & Blood Pressure</span></a>
            </div>
            <hr>
        </div>
    @endif
   
    <div class="container mt-3 products">
        <h3 class="h3">List of Products</h3>
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-3 col-sm-6 my-4">
                    <div class="product-grid3">
                        <div class="product-image3">
                            <a href="{{ route('view.product', ['productID' => $product->id]) }}">
                                <img class="pic-1" src="{{ $product->image }}">
                                <img class="pic-2" src="img/bag.jpg">
                            </a>
                            <ul class="social">
                                <li><a href="{{ route('add.to.cart', ['id' => $product->id]) }}"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                            <span class="product-new-label"></span>
                        </div>
                        <div class="product-content">
                            <h3 class="title"><a href="{{ route('view.product', ['productID' => $product->id]) }}">{{ $product->product }}</a></h3>
                            <div class="price">
                                ₱{{ $product->price }}.00
                            </div>
                            <ul class="rating">
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@stop

