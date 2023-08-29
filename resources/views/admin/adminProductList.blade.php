@extends('layouts.admin.admin')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/admin/adminProductList.css') }}" />
@stop

@section('content')
<style>
 .imagesize {
    height: 10%;
    width: 10%;
 }
</style>

<div class="card mb-4 mb-xl-0">
    <div class="card-header"><h4>Products</h4></div>
        <div class="card-body">
            <div class="pt-3">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $key=>$product)
                            <tr>
                                <th scope="row">{{ ++$key }}</th>
                                <td>{{ $product->product }}</td>
                                <td>{{ $product->price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>                                         
        </div>
    </div>
</div>
@stop