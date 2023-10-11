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
    <div class="card-header"><h4>Customers</h4></div>
      <div class="card-body">
        <div class="pt-3">
          <table class="table" id="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Mobile No.</th>
                <th scope="col">Created At.</th>
              </tr>
            </thead>
            <tbody>
              @foreach($customers as $key=>$customer)
                <tr>
                  <th scope="row">{{ ++$key }}</th>
                  <td>{{ $customer->name }}</td>
                  <td>{{ $customer->email }}</td>
                  <td>{{ $customer->number }}</td>
                  <td>{{ $customer->created_at }}</td>
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