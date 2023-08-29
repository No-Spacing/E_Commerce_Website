@extends('layouts.admin.admin')

@section('head')
	<link rel="stylesheet" href="{{ asset('css/admin/adminSales.css') }}" />
@stop

@section('content')
	<div class="card mb-4 mb-xl-0">
		<div class="card-header"><h4>Sales</h4></div>
			<div class="card-body">
				<div class="pt-2">
					<div class="card mb-3">
						<div class="card-header">Setup Date</div>
							<div class="card-body pt-4">
								@if(Session::get('success'))
									<div class="alert alert-success d-flex justify-content-center">
										{{ Session::get('success') }}
									</div>
								@endif
								<div class="row gx-3 mb-3">
									<form action="{{ route('update.time') }}" method="get">
										<div class="row col-md-5 pb-1">
											<label class="small mb-1" for="product">Date</label>
											<span class="text-danger">@error('datepicker'){{ $message }} @enderror</span>
											<input type="text" class="form-control col ms-2" name="datepicker" id="datepicker" required/>
											<div class="col">
												<button type="submit" class="btn btn-primary" type="button">Update</button>
											</div>
										</div>
									</form>
									<div class="card mt-3">
										<div class="card-body d-flex justify-content-center mt-2" >
											<div id="chartContainer" style="height: 450px; width: 120%;"></div>  
										</div>	
									</div>
								</div>	
							</div>
						</div>
					</div>
				</div>                                         
			</div>
		</div>
	</div>
@stop

@section('scripts')
	<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
	<script>
		$(function(){
			$("#datepicker").datepicker( {
				format: "mm-yyyy",
				viewMode: "months", 
				minViewMode: "months"
			});
		});
	</script>
	<?php
		$dataArray = array();
		foreach($totalsale as $encodeData){ 
			$points = array("label" => $encodeData->product, "y" => $encodeData->totalsale);
			array_push($dataArray, $points);
		}   
	?>
	<script>
		window.onload = function () {

		var chart = new CanvasJS.Chart("chartContainer", {
			theme: "light1", // "light2", "dark1", "dark2"
			animationEnabled: false, // change to true		
			title:{
				text: <?php echo json_encode("Total Sales in the Month of ".$month); ?>
			},
			data: [
			{
				// Change type to "bar", "area", "spline", "pie",etc.
				type: "column",
				dataPoints: <?php echo json_encode($dataArray,JSON_NUMERIC_CHECK); ?>
			}
			]
		});
		chart.render();   
		}
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>


	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>

@stop