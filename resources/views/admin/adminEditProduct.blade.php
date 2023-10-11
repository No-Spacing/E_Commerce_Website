@extends('layouts.admin.admin')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/admin/adminEditProduct.css') }}" />
@stop

@section('content')
<div class="card mb-4 mb-xl-0">
    <div class="card-header"><h4>Add Product</h4></div>
        <form action="{{ route('submit.edit.product', ['id' => $product->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="container-xl px-4 mt-4">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card mb-xl-0">
                            <div class="card-header">Product Image</div>
                            <div class="card-body text-center">
                                <!-- Profile picture image-->
                                <img class="mb-2 product-image" id="productImage" name="productImage" src="{{ asset($product->image) }}" alt="">
                                <div class="mb-2">
                                    <span class="text-danger">@error('image'){{ $message }} @enderror</span>
                                    <input type="file" onchange="loadFile(event)" accept="image/*" value="{{ $product->image }}" id="image" name="image" hidden/>
                                </div>
                                <button for="#image" class="btn btn-primary" type="button"><label for="image">Upload Image</label></button>                                     
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="card mb-4">
                            <div class="card-header">Product Details</div>
                                <div class="card-body pt-4">
                                    @if(Session::get('success'))
                                        <div class="alert alert-success d-flex justify-content-center">
                                            {{ Session::get('success') }}
                                        </div>
                                    @endif
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                                <label class="small mb-1" for="product">Product Name</label>
                                                <span class="text-danger">@error('product'){{ $message }} @enderror</span>
                                                <input class="form-control" id="product" name="product" value="{{ $product->product }}" type="text" placeholder="Enter your product name">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="price">Price</label>
                                                <span class="text-danger">@error('price'){{ $message }} @enderror</span>
                                                <input class="form-control" id="price" name="price" value="{{ $product->price }}" type="text" placeholder="Enter your product price ">
                                            </div>
                                        </div>
                                    <div class="row gx-3 mb-3 d-flex align-items-center">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="quantity">Quantity</label>
                                            <span class="text-danger">@error('remaining'){{ $message }} @enderror</span>
                                            <input class="form-control" id="remaining" name="remaining" min="1" type="number" value="{{ $product->remaining }}" placeholder="Enter your remaining product">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="tag">Tags</label>
                                            <span class="text-danger">@error('tag'){{ $message }} @enderror</span>
                                            <select class="form-control" style="height:49px;" id="tag" name="tag" >
                                                <option value="{{ $product->tagName }}" selected>{{ $product->tagName }}</option>
                                                <option value="immunity">Immunity</option>
                                                <option value="multivitamins">Multivitamins</option>
                                                <option value="sexual health vitamins">Sexual Health Vitamins</option>
                                                <option value="nutritional foods & drinks">Nutritional Food & Drinks</option>
                                                <option value="pain relief & fever">Pain Relief & Fever</option>
                                                <option value="digestive care">Digestive Care</option>
                                                <option value="lemon & ginger tea">Lemon & Ginger Tea</option>
                                                <option value="brain & memory">Brain & Memory</option>
                                                <option value="heart & blood pressure">Heart & Blood Pressure</option>
                                            </select>
                                        </div>
                                        
                                     </div>
                                     <div class="row gx-3 mb-3">
                                        <div class="col-md-12">
                                            <label class="small mb-1" for="description">Description</label>
                                            <span class="text-danger">@error('description'){{ $message }} @enderror</span>
                                            <textarea class="form-control" id="description" name="description" type="textarea" rows="4" placeholder="Enter your product description">{{ $product->description }}</textarea>
                                        </div>
                                    </div>
                                    <!-- <div class="row gx-3 mb-3">
                        
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputOrgName">Quantity</label>
                                            <input class="form-control" id="inputOrgName" type="text" placeholder="Enter your organization name" value="Start Bootstrap">
                                        </div>
                
                                    -->
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary" type="button">Save Product</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
        </form>
    </div>
</div>

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