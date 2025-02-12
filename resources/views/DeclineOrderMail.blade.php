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
    | {{ $content->product }} | ₱{{ $content->total }}.00 | {{ $content->quantity }} | ₱{{ $content->total }}.00 |
@endcomponent

<h2 style="text-align: right;">
    Total: ₱{{ $total }}.00
</h2> 


Thank you for shopping

Your E-Commerce Website Name Here.
@endcomponent