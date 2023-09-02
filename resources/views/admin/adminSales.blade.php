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
						<div class="card-header">Monthly Sales Report</div>
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
										<div class="pt-3">
											<table class="table">
												<thead>
												<tr>
													<th scope="col">#</th>
													<th scope="col">Product Name</th>
													<th scope="col">Item Price</th>
													<th scope="col">Profit Per Item</th>
													<th scope="col">Total Sold</th>
													<th scope="col">Total Revenue</th>
												</tr>
												</thead>
												<tbody>
												@foreach($sales as $key=>$sale)
													<tr>
														<th scope="row">{{ ++$key }}</th>
														<td>{{ $sale->product_name }}</td>
														<td>{{ $sale->item_price }}</td>
														<td>{{ ($sale->item_price - $sale->item_cost) }}</td>
														<td>{{ $sale->total_sold }}</td>
														<td>{{ number_format($sale->item_price * $sale->total_sold) }}</td>
													</tr>
												@endforeach
												</tbody>
											</table>
										</div>  
									</div>
								</div>	
							</div>
						</div>
					</div>
					<div class="card mb-3">
						<div class="card-header">Revenue Breakdown</div>
							<div class="card-body pt-4">
								<div class="row gx-3 mb-3">
									<div class="card mt-3">
										<div class="pt-3">
											<div id="chartContainer" style="height: 370px; width: 100%;"></div>
										</div>  
									</div>
									<div class="card mt-3">
										<div class="pt-3">
											<div id="chartContainer1" style="height: 370px; width: 100%;"></div>
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
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
		$dataPoints = array();
		$sum = 0;
		
		foreach($sales as $sale){ 
			$points = array("label" => $sale->product_name, "y" => $sale->item_price * $sale->total_sold );
			array_push($dataArray, $points);
			
			$pie = array("label" => $sale->product_name, "y" => (($sale->total_sold - $sale->returns) * (($sale->item_price - $sale->item_cost)) - ($sale->returns * $sale->shipping_cost)));
			array_push($dataPoints, $pie);
		}  
		
		
	?>
	<script>
		window.onload = function () {

		var chart = new CanvasJS.Chart("chartContainer", {
			animationEnabled: true,
			exportEnabled: true,
			theme: "light1", // "light1", "light2", "dark1", "dark2"
			title:{
				text: "Revenue Breakdown"
			},
			axisY: {
			includeZero: true
			},
			data: [{
				type: "column", //change type to bar, line, area, pie, etc
				//indexLabel: "{y}", //Shows y value on all Data Points
				indexLabelFontColor: "#5A5757",
				indexLabelFontSize: 16,
				indexLabelPlacement: "outside",
				yValueFormatString: "₱#,##0",
				dataPoints: <?php echo json_encode($dataArray,JSON_NUMERIC_CHECK); ?>,
			}]
		});
		chart.render();

		var chart1 = new CanvasJS.Chart("chartContainer1", {
			title: {
				text: "Total Income Per Item"
			},
			axisY: {
				title: "Number of Income Per Item"
			},
			data: [{
				type: "line",
				yValueFormatString: "₱#,##0",
				dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
			}]
		});
		chart1.render();

		}
	</script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>

@stop