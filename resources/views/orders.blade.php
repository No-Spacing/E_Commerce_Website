@extends('layouts.master')

@section('head')
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/order.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <title>Orders</title>
@stop


@section('content')

<div class="order-table d-flex justify-content-center mt-4">
    <div class="card" style="width: 85rem;">
        <div class="card-header"><h4>Orders</h4>
        <p style="opacity:0.8;">Note: You have 24 hours to cancel your order or your order will proceed to be accepted.</p>
    </div>

        <div class="card-body container">
            <table class="table" id="table">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col">Date of Purchase</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
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
                            @if($order->status == "declined" || $order->status == "accepted" || $order->status == "cancelled" || $order->status == "refunded" || $order->status == "shipped")
                                <td class="d-flex justify-content-center"><a class="btn btn-disabled" title="You cannot cancel the order once the item is shipped" disabled><i class="fa-solid fa-circle-exclamation"></i> Cancel</a></button></td>
                            @elseif($order->status == "paid")
                                <td class="d-flex justify-content-center"><a class="btn btn-outline-warning" href="{{ route('refund.order', ['id' => $order->id]) }}" onclick="return confirm('Are you sure you want to refund this order?')"><i class="fa-solid fa-circle-exclamation"></i> Refund</a></button></td>
                            @else
                                <td class="d-flex justify-content-center"><a class="btn btn-outline-danger" href="{{ route('cancel.order', ['id' => $order->id]) }}" onclick="return confirm('Are you sure you want to cancel this order?')"><i class="fa-solid fa-circle-exclamation"></i> Cancel</a></td> 
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    new DataTable('#table');
</script>
@stop
