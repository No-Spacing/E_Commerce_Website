<!DOCTYPE html>
<html>
<head>
  <title>Payment</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="css/payment.css">
</head>
<body>
  <main class="page payment-page">
    <section class="payment-form dark">
      <div class="container">
        <div class="block-heading">
          <h2>Payment</h2>
          <p>Please review your products before placing your order.</p>
        </div>
          <div class="products">
              <h3 class="title">Checkout</h3>
              @if(Session::get('noOrder'))
                <div class="alert alert-danger d-flex justify-content-center">
                    {{ Session::get('noOrder') }}
                </div>
              @else
                @foreach($products as $product)
                  <div class="item">
                    <img src="{{ $product->image }}" width="60">
                    <span class="price">₱{{ $product->total }}.00</span>
                    <p class="item-name">{{ $product->product }}</p>
                    <p class="item-description">Quantity: {{ $product->quantity }}</p>
                  </div>
                @endforeach 
              @endif 
              
              <div class="total">
                Shipping Fee:<span class="price">₱20.00</span>
                <br>
                <br>
                Total<span class="price">₱{{ $total + 20 }}.00</span>
              </div>
          </div>
          <div class="card-details">
            <h3 class="title">Payment Options</h3>
            <div class="row">
              <div class="container py-2">
                <div class="card">
                  <div class="card-header">
                    <div class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2">
                      <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3 col">
                        <!-- <li class="nav-item" value="Credit Card"> <a data-toggle="pill" href="#credit-card" class="nav-link active "> <i class="fas fa-credit-card mr-2"></i> Credit Card </a> </li> -->
                        <li class="nav-item" value="COD"> <a data-toggle="pill" href="#paypal" class="nav-link "> <i class="fa-solid fa-truck mr-2"></i> Cash On Delivery </a></li>
                        <li class="nav-item" value="Net Banking"> <a data-toggle="pill" href="#net-banking" class="nav-link "> <i class="fas fa-mobile-alt mr-2"></i> Payment Gateway </a> </li>
                      </ul>
                    </div> <!-- End -->
                    <!-- Credit card form content -->
                    <div class="tab-content">
                      <div id="paypal" class="tab-pane fade pt-3">
                        <form action="{{ route('place.order') }}" method="post">
                          @csrf
                          <div class="container-fluid pb-3">
                            <label>
                              <h6 class="py-2">CASH ON DELIVERY</h6>
                            </label>
                            <p class="text-muted"> 
                              Note: Please prepare exact amount when the delivery rider has come to your place.
                            </p>
                            <input type="text" id="paymentMethod" name="paymentMethod" class="form-control" value="Cash On Delivery" hidden/> 
                            @if(!$products->count() == NULL)
                              <div class="form-group d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary w-50">Place Your Order</button>
                              </div>
                            @endif 
                          </div>
                        </form>
                      </div> 
                      <div id="net-banking" class="tab-pane fade pt-3">
                      <form class="form-group" style="width:100%;" action="{{ route('place.order') }}" method="post">
                          @csrf
                          <div class="container-fluid pb-3">
                            <div class="form-group"> 
                              <label for="GCash" class="pt-2">
                                <h6>Payment Gateway</h6>
                              </label> 
                              <div class="d-flex justify-content-center pb-3">
                                <img src="{{ asset('img/paymongo.png') }}" style="height:auto; width:350px;" >
                              </div>
                              <p class="text-muted"> 
                                  Note: You will be paying via Payment Gateway make sure you choose the right payment account with exact amount for the order.
                              </p>
                              <input type="text" id="paymentMethod" name="paymentMethod" class="form-control" value="Payment Gateway" hidden/> 
                            </div>
                            @if(!$products->count() == NULL)
                              @if($total > 100)
                                <div class="form-group d-flex justify-content-center">
                                  <button type="submit" class="btn btn-primary w-50">Place Your Order</button>
                                </div>
                              @else
                                <div class="form-group d-flex justify-content-center">
                                  <div class="alert alert-danger d-flex justify-content-center">
                                    Purchase is below minimum.<br> Please purchase an amount at least PHP 100.00.
                                  </div>
                                </div>
                              @endif
                            @endif 
                          </div>
                        </form>
                      </div> 
                   
                  </div>
                </div>
              </div>
            </div>
      </div>
    </section>
  </main>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>