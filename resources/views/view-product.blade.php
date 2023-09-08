
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
						  	<div class="tab-pane active" id="pic-1"><img style="height: 310px; width: 80%;" src="{{ asset($details->image) }}" /></div>
						</div>
					</div>
					<div class="details col-md-6">
						<h3 class="product-title">{{ $details->product }}</h3>
						<div class="rating">
							<div class="stars">
                            @for($i = 0; $i < $rating->avg_rating; $i++)
								<span class="fa fa-star checked"></span>
                            @endfor
                                <span class="mx-2">{{ number_format($rating->avg_rating, 2, '.', '') }} Ratings</span>
							</div>
							<span class="review-no">{{ $reviews->count() }} Review(s)</span>
						</div>
						<p class="product-description">{{ $details->description }}.</p>
						<h4 class="price">current price: <span>₱{{ $details->price }}.00</span></h4>
						<div class="action">
							<!-- <button class="add-to-cart btn btn-default" type="button">add to cart</button> -->
                            @if($details->remaining > 0)
                                <a href="{{ route('add.to.cart', ['id' => $details->id]) }}" class="add-to-cart btn btn-default">Add to Cart</a>
                            @endif
                            @if(Session::has('Customer'))
							    <button class="like btn btn-default" onclick="scrollToBottom()" type="button"><span class="fa fa-star"></span></button>
                            @endif
                            <div class="mt-2">
                                <span class="opacity-75">{{ $details->remaining }} product remaining.</span>
                            </div>
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
                <div class="bg-white rounded shadow-sm p-4 mb-4 restaurant-detailed-ratings-and-reviews">
                    <h5 class="mb-1">All Ratings and Reviews</h5>
                    <div class="reviews-members pt-4 pb-4">
                        @foreach($reviews as $review)
                        <div class="media">
                            <a><img alt="Generic placeholder image" src="{{ asset('img/user-icon.png') }}" class="mr-3 rounded-pill"></a>
                            <div class="media-body">
                                <div class="reviews-members-header">
                                    <span class="star-rating float-right">
                                        @for($star = 0; $star < $review->rating; $star++)
										    <span class="fa fa-star checked"></span>
                                        @endfor
									</span>
                                    <h6 class="my-1"><a class="text-black">{{ $review->name }}</a></h6>
                                    <p class="text-gray">{{ date('M-d-Y', strtotime($review->created_at) ) }}</p>
                                </div>
                                <div class="reviews-members-body">
                                    <p>{{ $review->comment }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <hr>
                    <!-- <a class="text-center w-100 d-block mt-4 font-weight-bold" href="#">See All Reviews</a> -->
                    <div class="col text-center">
                        @if(Session::has('Customer'))
                            <button type="button" onclick="scrollToBottom()" class="mt-4 font-weight-bold btn btn-outline-primary btn-sm">Rate and Review</button>
                        @endif
                    </div>
                    
                </div>
                @if(Session::has('Customer'))
                    <div class="bg-white rounded shadow-sm p-4 mb-5 rating-review-select-page">
                        <form action="{{ route('submit.review') }}" method="post">
                            @csrf
                            <h5 class="mb-4">Leave a Comment</h5>
                            <p class="mb-2">Rate the Product &nbsp;<span class="text-danger">@error('rating'){{ $message }} @enderror</span></p>
                            <div class="mb-4">
                                <select name="rating" id="rating" style="width:70px;">
                                    <option disabled selected>Stars</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Your Comment</label>&nbsp;<span class="text-danger">@error('comment'){{ $message }} @enderror</span>
                                <input id="productID" name="productID" value="{{ $details->id }}" hidden/>
                                <textarea class="form-control" id="comment" name="comment"></textarea>
                            </div>
                            <div class="form-group pt-3">
                                <button class="btn btn-primary btn-sm" type="submit"> Submit </button>
                            </div>
                        </form>
                    </div>                  
                @endif
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