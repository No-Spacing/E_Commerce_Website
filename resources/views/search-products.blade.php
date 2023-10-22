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
    <link rel="stylesheet" href="{{ asset('css/searchProduct.css') }}">
    <link rel="icon" type="image/x-icon" href="img/brigada-icon.png">
    <title>Items</title>
@stop

@section('content')
<div class="container products pt-4">
        <h3 class="h3">List of {{ $title }} products</h3>
        <div class="row">
            @foreach($items as $product)
                <div class="col-md-3 col-sm-6">
                    <div class="product-grid3">
                        <div class="product-image3">
                            <a href="{{ route('view.product' ,['productID' => $product->id]) }}">
                                <img class="pic-1" src="{{ asset($product->image) }}">
                                <img class="pic-2" src="{{ asset('img/bag.jpg') }}">
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
@stop
