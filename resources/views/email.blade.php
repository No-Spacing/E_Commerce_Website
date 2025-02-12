@component('mail::message')
# Reciept

{{ $message }}

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
    | {{ $product->product }} | ₱{{ $product->price }}.00 | {{ $product->quantity }} | ₱{{ $product->total }}.00 |
    @endforeach
@endcomponent
<h4 style="text-align: right;">
    Shipping Fee: ₱20.00
</h4>
<h2 style="text-align: right;">
    Total: ₱{{ $total + 20 }}.00
</h2> 


Thank you for shopping

Your E-Commerce Website Name Here.
@endcomponent