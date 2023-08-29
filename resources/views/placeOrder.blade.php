<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/placeOrder.css">
        <link rel="icon" type="image/x-icon" href="img/brigada-icon.png">
        <title>Place Order</title>
    </head>
    <body>
        
            <div class="container mt-5 mb-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="text-center logo p-2 px-5">
                                <a href="home"><img src="img/brigada-cover.png" width="450"></a>
                            </div>
                            <div class="invoice p-5">
                                <h5>Your order Confirmed!</h5>
                                <span class="font-weight-bold d-block mt-4">Hello, {{ $customer['name'] }}</span>
                                <span>You order has been confirmed and will be shipped in next two days!</span>
                                <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="py-2">
                                                        <span class="d-block text-muted">Order Date</span>
                                                    <span>{{ date('Y-m-d') }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="py-2">
                                                        <span class="d-block text-muted">Order No</span>
                                                    <span>BHC12345</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="py-2">
                                                        <span class="d-block text-muted">Payment</span>
                                                    <span>Cash on Delivery</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="py-2">
                                                        <span class="d-block text-muted">Shiping Address</span>
                                                    <span>{{ $customer['address'] }}</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                    <div class="product border-bottom table-responsive">
                                        <table class="table table-borderless">
                                            <tbody> 
                                                @foreach(Session::get('products') as $product)
                                                    <tr>
                                                        <td width="20%">
                                                            <img src="{{ $product->image }}" width="70">
                                                        </td>
                                                        <td width="60%">
                                                            <span class="font-weight-bold">{{ $product->product }}</span>
                                                            <div class="product-qty">
                                                                <span class="d-block">{{ $product->quantity }}</span>
                                                                <!-- <span>Color:Dark</span> -->
                                                            </div>
                                                        </td>
                                                        <td width="20%">
                                                            <div class="text-right">
                                                                <span class="font-weight-bold">₱{{ $product->total }}.00</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach                       
                                            </tbody> 
                                        </table> 
                                    </div>
                                    <div class="row d-flex justify-content-end">
                                        <div class="col-md-5">
                                            <table class="table table-borderless">
                                                <tbody class="totals">
                                                    <!-- <tr>
                                                        <td>
                                                            <div class="text-left">
                                                                <span class="text-muted">Subtotal</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="text-right">
                                                                <span>$168.50</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="text-left">
                                                                <span class="text-muted">Shipping Fee</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="text-right">
                                                                <span>₱50</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="text-left">
                                                                <span class="text-muted">Tax Fee</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="text-right">
                                                                <span>$7.65</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="text-left">
                                                                <span class="text-muted">Discount</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="text-right">
                                                                <span class="text-success">$168.50</span>
                                                            </div>
                                                        </td>
                                                    </tr> -->

                                                    <tr class="border-top border-bottom">
                                                        <td>
                                                            <div class="text-left">
                                                                <span class="font-weight-bold">Total</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="text-right">
                                                                <span class="font-weight-bold">₱{{ $total }}.00</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <p>We will be sending shipping confirmation email when the item shipped successfully!</p>
                                    <p class="font-weight-bold mb-0">Thanks for shopping with us!</p>
                                    <span>Brigada Healthline Corp.</span> 
                            </div>
                            <!-- <div class="d-flex justify-content-between footer p-3">
                                <span>Need Help? visit our <a href="#"> help center</a></span>
                                <span>12 June, 2020</span>
                            </div> -->
                        </div>    
                    </div>  
                </div>   
            </div>
    
            
     

    </body>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</html>

