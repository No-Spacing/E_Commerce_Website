@extends('layouts.admin.admin')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/admin/adminCustomers.css') }}" />
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@stop

@section('content')
    <div class="card mb-4 mb-xl-0">
        <div class="card-header"><h4>Orders</h4></div>
            <div class="card-body">
                <div class="pt-3">
                <table class="table" id="table">
                    <thead>
                    <tr>
                        <th scope="col">Order #</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Mobile No.</th>
                        <th scope="col">Address</th>
                        <th scope="col">Payment Method</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action/Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orderStatus as $key=>$order)
                        <tr>
                            <th scope="row">{{ $order->id }}</th>
                            <td>{{ $order->product }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->number }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->payment }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td> 
                                @if($order->status == 'pending')
                                    <a class="btn btn-outline-success" href="{{ route('accept.order', ['id' => $order->id]) }}" title="Accept"><i class="far fa-check-circle"></i></a>
                                    <a class="btn btn-outline-danger" href="{{ route('decline.order', [$order->customerID, $order->id]) }}" title="Decline"><i class="far fa-times-circle"></i></a>
                                @elseif($order->status == 'accepted' || $order->status == 'paid') 
                                    <a class="btn btn-outline-primary" href="{{ route('ship.order', ['id' => $order->id]) }}" title="Ship Order"><i class="fa-solid fa-truck-fast fa-lg"></i></a>
                                @elseif($order->status == 'declined') 
                                    <p>Order Declined</p>
                                @elseif($order->status == 'cancelled')
                                    <p>Order Cancelled by User</p>
                                @elseif($order->status == 'refunded')
                                    <p>Order Refunded by User</p>
                                @elseif($order->status == 'shipped')
                                    <p>Order Shipped</p>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>                                         
            </div>
        </div>
    </div>
@stop

@section('scripts')
  <script>
      new DataTable('#table');
  </script>
@stop