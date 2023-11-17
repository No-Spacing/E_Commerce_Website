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
                        <p>You will be redirected to payment gateway.</p>
                    </div>
                    <div class="card-details">
                        <h3 class="title">Payment Options</h3>
                        <div class="row">
                            <div class="container py-2">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2">
                                            <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3 col">
                                                <li class="nav-item" value="Net Banking"> <a data-toggle="pill" href="#net-banking" class="nav-link active" selected> <i class="fas fa-mobile-alt mr-2"></i> Payment Gateway </a> </li>
                                            </ul>
                                        </div> <!-- End -->
                                        <!-- Credit card form content -->
                                        <div class=""> 
                                            <!-- bank transfer info -->
                                            <div class="pt-3">
                                                <div class="container-fluid pb-3">
                                                    <div class="form-group"> 
                                                        <label for="GCash" class="pt-2">
                                                            <h6>Payment Gateway</h6>
                                                        </label> 
                                                        <div class="d-flex justify-content-center pb-3">
                                                            <img src="{{ asset('img/paymongo.png') }}" style="height:auto; width:350px;" >
                                                        </div>
                                                        @if(session()->has('paid'))
                                                            <div class="alert alert-success d-flex justify-content-center">
                                                                {{ session()->get('paid') }}
                                                            </div>
                                                        @else
                                                            <p class="text-muted"> 
                                                                Note: Please select the right payment merchant to your payment gateway with exact remaining balance.
                                                            </p>
                                                            <span>Please refresh the page after your payment succeeded.</span>
                                                        @endif
                                                    </div>
                                                    @if(session('paid'))
                                                        <div class="form-group d-flex justify-content-center pt-2">
                                                            <a href="{{ route('payment.session.pull') }}">Return Home</a>
                                                        </div>
                                                    @else
                                                        <div class="form-group d-flex justify-content-center pt-2">
                                                            <a class="btn btn-primary w-50" href="{{ session('payment_link')->checkout_url }}" target="_blank">Redirect to Payment Link</a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div> 
                                            <div class="d-flex justify-content-center pt-3">
                                                <p>COPYRIGHT © {{ date('Y') }} Brigada Healthline Corp.</p>
                                            </div>
                                        </div>
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
</html>