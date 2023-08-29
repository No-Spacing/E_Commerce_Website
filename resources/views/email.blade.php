@component('mail::message')
# Reciept

We received your #BHC12345 on {{ date('Y-m-d H:i:s') }}  and you’ll be paying for this via Cash On Delivery. 
We’re getting your order ready and will let you know once it’s on the way. 
We wish you enjoy shopping with us and hope to see you again real soon!

# Delivery Details:
@component('mail::panel')
    Name:	{{ $customer->name }} <br>
    Address:	{{ $customer->address }} <br>
    Phone:	{{ $customer->number }} <br>
    Email:	{{ $customer->email }} <br>
@endcomponent

# Products:
@component('mail::table')
    | Product                 | Price                | Quantity             | Total                 |
    | ----------------------- | :------------------: | :------------------: | ---------------------:|
    @foreach($content as $product)
    | {{ $product->product }} | ₱{{ $product->price}}.00 | {{ $product->quantity }} | ₱{{ $product->total }}.00 |
    @endforeach
@endcomponent

<h2 style="text-align: right;">
    Total: ₱{{ $total }}.00
</h2> 


Thank you for shopping

Brigada Healthline Corp.
@endcomponent