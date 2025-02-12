@extends('layouts.admin.admin')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/admin/adminProducts.css') }}" />
@stop

@section('content')
<form>
    <div class="container-xl px-4 mt-4">
        <div class="row">
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Product Image</div>
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                        <img class="mb-2 product-image" id="productImage" name="productImage" src="{{ asset('img/bag.jpg') }}" alt="">
                        <input type="file" onchange="loadFile(event)" accept="image/*" id="image" name="image" hidden/>
                        <button for="#image" class="btn btn-primary" type="button"><label for="image">Upload Image</label></button>                                     
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Product Details</div>
                    <div class="card-body">
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                        <label class="small mb-1" for="name">Product Name</label>
                                        <input class="form-control" id="name" name="name" type="text" placeholder="Enter your product name" value="{{ old('name') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="price">Price</label> 
                                        <input class="form-control" id="price" name="price" type="text" placeholder="Enter your product " value=" {{ old('price') }} ">
                                    </div>
                                </div>
                            <div class="row gx-3 mb-3">
                                
                                <div class="col-md-12">
                                    <label class="small mb-1" for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" type="textarea" rows="4" placeholder="Enter your product description"></textarea>
                                </div>
                                
                            </div>
                            <!-- <div class="row gx-3 mb-3">
                   
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputOrgName">Quantity</label>
                                    <input class="form-control" id="inputOrgName" type="text" placeholder="Enter your organization name" value="Start Bootstrap">
                                </div>
           
                            -->
                            <button type="submit" class="btn btn-primary" type="button">Save changes</button>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@stop

@section('scripts')
<script>
  var loadFile = function(event) {
    var output = document.getElementById('productImage');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>
@stop