@extends('layouts.master')

@section('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/order.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/brigada-icon.png') }}">
    <title>Orders</title>
@stop


@section('content')
<div class="order-table d-flex justify-content-center mt-4">
    <div class="card" style="width: 85rem;">
        <div class="card-header"><h4>Orders</h4></div>
        <div class="card-body container">
            <table class="table">
            <thead class="table-primary">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                    <th scope="col">Date of Purchase</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($checkouts as $key=>$order)
                <tr>
                    <th scope="row">{{ ++$key }}</th>
                    <td>{{ $order->product }}</td>
                    <td>{{ $order->quantity }} Items</td>
                    <td>₱{{ $order->total }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>{{ $order->status }}</td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
</div>
@stop