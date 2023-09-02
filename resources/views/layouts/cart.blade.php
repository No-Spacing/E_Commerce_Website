<div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="exampleModalLabel">
          Your Shopping Cart
        </h5>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
      <div class="modal-body">
            @if(Session::get('successCart'))
                <div class="alert alert-success d-flex justify-content-center">
                    {{ Session::get('successCart') }}
                </div>
            @endif
            @if(Session::get('failOrder'))
						<div class="alert alert-danger d-flex justify-content-center">
							{{ Session::get('failOrder') }}
						</div>
					@endif
        <table class="table table-image">
          <thead>
            <tr>
              <th hidden></th>
              <th>Image</th>
              <th scope="col">Product</th>
              <th scope="col">Price</th>
              <th scope="col">Qty</th>
              <th scope="col">Total</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
          <form  id="updateQuantityForm" action="{{ route('update.cart') }}" method="post">
            @csrf
             
              @foreach($cart as $id => $details)
                <tr id="{{ $id }}" data-group="{{ $id }}">
                  <td hidden><input class="input quantity" type="text" id="id[]" name="id[]" value="{{ $details->productID }}"/></td>
                  <td class="w-25">
                    <img src="{{ asset($details->image) }}" class="img-fluid img-thumbnail cart-image" alt="products">
                  </td>
                  <td>{{ $details->product }}</td>
                  <td>₱{{ $details->price }}.00</td>
                  <td class="qty">
                    <span class="text-danger">@error('quantity'){{ $message }} @enderror</span>
                    <input class="input" data-group="{{ $id }}" type="number" min="0" id="quantity" name="quantity[]" style="width: 50%;" value="{{ $details->quantity }}"/>
                  </td>
                  <td>₱{{ $details->total }}.00</td>
                  <td>
                    <a href="{{ route('delete.product', ['id' => $details->productID]) }}" class="btn btn-danger btn-sm">
                      <i class="fa fa-times"></i>
                    </a>
                  </td>
                </tr>
              @endforeach
            </form>
          </tbody>
        </table> 
          @if($cart->isEmpty())
            <div class="d-flex justify-content-center py-5">
              <h3>No Item</h3>
            </div>
          @endif
          <div class="d-flex justify-content-end">
            @if(session()->has('Customer'))
              <h5>Total: <span class="price text-success">₱{{ $totalPrice }}.00</span></h5>
            @else
              <h5>Total: <span class="price text-success">₱00.00</span></h5>
            @endif
          </div>
      </div>
     
      <div class="modal-footer border-top-0">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <p class="text-start">Note: Click update when you apply changes to your cart</p>
        @if(session()->has('Customer'))
          @if(!$cart->isEmpty())
            
            <button type="submit" class="updateButton btn btn-success" form="updateQuantityForm">Update</button>  
            <a class="checkoutButton btn btn-success" href="{{ route('checkout') }}">Checkout</a>  
          @endif
        @endif
      </div>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("[data-group]").each(function() {
            let group = $(this).data('group')
            $("[data-group="+group+"]:not([data-group-limit])").keyup(function(e) {
            });
            // $("[data-group="+group+"]:not([data-group-limit])").click(function(e) { 
            //     if ($("[data-group="+group+"]:checked").length > limit) { 
            //         //console.log("Limit exceed for group " + group) 
            //         e.preventDefault() 
            //     }
            // })
        })
    })
</script>
