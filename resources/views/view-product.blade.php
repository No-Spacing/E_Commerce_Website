
<!------ Include the above in your HEAD tag ---------->
@extends('layouts.master')

@section('head')
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/view-product.css') }}">
        <link rel="icon" type="image/x-icon" href="{{ asset('img/brigada-icon.png') }}">
		<link rel="stylesheet" href="https://allyoucan.cloud/cdn/icofont/1.0.1/icofont.css" integrity="sha384-jbCTJB16Q17718YM9U22iJkhuGbS0Gd2LjaWb4YJEZToOPmnKDjySVa323U+W7Fv" crossorigin="anonymous">
        <title>View Product</title>
    </head>
@stop

@section('content')
    <div class="container my-2">
		<div class="card">
			<div class="container-fluid">
				<div class="wrapper row">
					<div class="preview col-md-6">
						<div class="preview-pic tab-content product-img">
						  	<div class="tab-pane active" id="pic-1"><img style="height: 310px; width: 80%;" src="{{ asset($products->image) }}" /></div>
						</div>
					</div>
					<div class="details col-md-6">
						<h3 class="product-title">{{ $products->product }}</h3>
						<div class="rating">
							<div class="stars">
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
							</div>
							<span class="review-no">1 reviews</span>
						</div>
						<p class="product-description">{{ $products->description }}.</p>
						<h4 class="price">current price: <span>₱{{ $products->price }}.00</span></h4>
						<p class="vote"><strong>100%</strong> of buyers enjoyed this product! <strong>(1 votes)</strong></p>
						<div class="action">
							<!-- <button class="add-to-cart btn btn-default" type="button">add to cart</button> -->
                            <a href="{{ route('add.to.cart', ['id' => $products->id]) }}" class="add-to-cart btn btn-default">Add to Cart</a>
							<button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<div class="container mb-5">
<div class="col-md-12">
    <div class="offer-dedicated-body-left">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade active show" id="pills-reviews" role="tabpanel" aria-labelledby="pills-reviews-tab">
                <div class="bg-white rounded shadow-sm p-4 mb-4 clearfix graph-star-rating">
                    <h5 class="mb-0 mb-4">Ratings and Reviews</h5>
                    <div class="graph-star-rating-header">
                        <div class="star-rating">
                            <a href="#"><span class="fa fa-star checked"></span></a>
                            <a href="#"><span class="fa fa-star checked"></span></a>
                            <a href="#"><span class="fa fa-star checked"></span></a>
                            <a href="#"><span class="fa fa-star checked"></span></a>
                            <a href="#"><span class="fa fa-star checked"></span></a> <b class="text-black ml-2">1</b>
                        </div>
                        <p class="text-black mb-4 mt-2">Rated 5 out of 5</p>
                    </div>
                    <div class="graph-star-rating-body">
                        <div class="rating-list">
                            <div class="rating-list-left text-black">
                                5 Star
                            </div>
                            <div class="rating-list-center">
                                <div class="progress">
                                    <div style="width: 100%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="5" role="progressbar" class="progress-bar bg-primary">
                                        <span class="sr-only">100% Complete (danger)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="rating-list-right text-black">100%</div>
                        </div>
                        <div class="rating-list">
                            <div class="rating-list-left text-black">
                                4 Star
                            </div>
                            <div class="rating-list-center">
                                <div class="progress">
                                    <div style="width: 0%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="5" role="progressbar" class="progress-bar bg-primary">
                                        <span class="sr-only">100% Complete (danger)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="rating-list-right text-black">0%</div>
                        </div>
                        <div class="rating-list">
                            <div class="rating-list-left text-black">
                                3 Star
                            </div>
                            <div class="rating-list-center">
                                <div class="progress">
                                    <div style="width: 0%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="5" role="progressbar" class="progress-bar bg-primary">
                                        <span class="sr-only">0% Complete (danger)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="rating-list-right text-black">0%</div>
                        </div>
                        <div class="rating-list">
                            <div class="rating-list-left text-black">
                                2 Star
                            </div>
                            <div class="rating-list-center">
                                <div class="progress">
                                    <div style="width: 0%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="5" role="progressbar" class="progress-bar bg-primary">
                                        <span class="sr-only">0% Complete (danger)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="rating-list-right text-black">0%</div>
                        </div>
                    </div>
                    <div class="graph-star-rating-footer text-center mt-3 mb-3">
                        <button type="button" onclick="scrollToBottom()" class="btn btn-outline-primary btn-sm">Rate and Review</button>
                    </div>
                </div>
                <div class="bg-white rounded shadow-sm p-4 mb-4 restaurant-detailed-ratings-and-reviews">
                    <a href="#" class="btn btn-outline-primary btn-sm float-right">Top Rated</a>
                    <h5 class="mb-1">All Ratings and Reviews</h5>
                    <div class="reviews-members pt-4 pb-4">
                        <div class="media">
                            <a href="#"><img alt="Generic placeholder image" src="{{ asset('img/user-icon.png') }}" class="mr-3 rounded-pill"></a>
                            <div class="media-body">
                                <div class="reviews-members-header">
                                    <span class="star-rating float-right">
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star checked"></span>
									</span>
                                    <h6 class="mb-1"><a class="text-black" href="#">Juan Dela Cruz</a></h6>
                                    <p class="text-gray">Th, 24 Aug 2023</p>
                                </div>
                                <div class="reviews-members-body">
                                    <p>This product is great!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <a class="text-center w-100 d-block mt-4 font-weight-bold" href="#">See All Reviews</a>
                </div>
                <div class="bg-white rounded shadow-sm p-4 mb-5 rating-review-select-page">
                    <h5 class="mb-4">Leave Comment</h5>
                    <p class="mb-2">Rate the Product</p>
                    <div class="mb-4">
                        <span class="star-rating">
							<a href="#"><span class="fa fa-star checked"></span></i></a>
							<a href="#"><span class="fa fa-star checked"></span></i></a>
							<a href="#"><span class="fa fa-star checked"></span></i></a>
							<a href="#"><span class="fa fa-star checked"></span></i></a>
							<a href="#"><span class="fa fa-star checked"></span></i></a>
                        </span>
                    </div>
                    <form>
                        <div class="form-group">
                            <label>Your Comment</label>
                            <textarea class="form-control"></textarea>
                        </div>
                        <div class="form-group pt-3">
                            <button class="btn btn-primary btn-sm" type="button"> Submit </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
function scrollToBottom()
{
    var height = document.body.scrollHeight;
    window.scroll(0 , height);
}
</script>

@stop