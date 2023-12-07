@extends('layouts.admin.admin')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/admin/adminProductList.css') }}" />
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@stop

@section('content')
<style>
 .imagesize {
    height: 10%;
    width: 10%;
 }
 .btn:focus,.btn:active {
   outline: none !important;
   box-shadow: none;
}
</style>

<div class="card mb-4 mb-xl-0">
    <div class="card-header"><h4>Products</h4></div>
        <div class="card-body">
            <div class="pt-3">
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Remaining</th>
                            <th scope="col">Price</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $key=>$product)
                            <tr>
                                <th scope="row">{{ ++$key }}</th>
                                <td>{{ $product->product }}</td>
                                <td>{{ $product->remaining }}</td>
                                <td>{{ $product->price }}</td>
                                <td>
                                    <a class="btn btn-outline-primary mx-2" title="Edit" href="{{ route('admin.edit.product', [ 'id' => $product->id]) }}"><i class="fas fa-edit"></i></a>
                                    <a href="{{ route('admin.delete.product', ['id' => $product->id ]) }}" class="btn btn-danger btn-md"><i class="fas fa-trash"></i></a>              
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