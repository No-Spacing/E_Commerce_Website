@extends('layouts.admin.admin')

@section('head')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
<link rel="stylesheet" href="{{ asset('css/admin/adminHome.css') }}" />
<?php

    // $date = date_create("2013-04-15");
    // $phpDate = date_format($date,"Y/m/d H:i:s");
    // $phpTimestamp = strtotime($phpDate);
    // $javaScriptTimestamp = $phpTimestamp * 1000;

    // $dataPoints = array(
    //     array("x" =>  $javaScriptTimestamp, "y" => 32),
    // );
    $dataArray = array();
    $dataPoints = array();
    $sum = 0;
    
    foreach($sales as $sale){ 
        $points = array("indexLabel" => $sale->product_name, "y" => $sale->item_price * $sale->total_sold );
        array_push($dataArray, $points);
        
        $pie = array("symbol" => $sale->product_name, "y" => (($sale->total_sold - $sale->returns) * (($sale->item_price - $sale->item_cost)) - ($sale->returns * $sale->shipping_cost)));
        array_push($dataPoints, $pie);
    }  
 
    $doughnutPoints = array( 
        array( "symbol" => "O","y"=>46.6),
        array( "symbol" => "Si","y"=>27.7),
        array( "symbol" => "Al","y"=>13.9),
        array( "symbol" => "Fe","y"=>5),
        array( "symbol" => "Ca","y"=>3.6),
        array( "symbol" => "Na","y"=>2.6),
        array( "symbol" => "Mg","y"=>2.1),
        array( "symbol" => "Others","y"=>1.5),
    
    )

?>
<script>
    window.onload = function () {
        
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            title:{
                text: "Income Per Item"
            },
            axisY: {
				title: "Number of Income Per Item"
			},
            data: [{
                type: "spline",
                markerSize: 5,
                yValueFormatString: "₱#,##0",
				dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        
        chart.render();

        var chart1 = new CanvasJS.Chart("doughnutContainer", {
            theme: "light2",
            animationEnabled: true,
            title: {
                text: "Revenue"
            },
            data: [{
                type: "doughnut",
                indexLabel: "{symbol} - {y}",
                yValueFormatString: "#,##0.0",
                dataPoints: <?php echo json_encode($dataArray, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart1.render();
        
    }
</script>

@stop

@section('content')
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <div class="container-fluid">
                <div class="d-sm-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-dark mb-0">Dashboard</h3>
                </div>
                <div class="row">
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-start-primary py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                        <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Earnings (monthly)</span></div>
                                        <div class="text-dark fw-bold h5 mb-0"><span>₱{{ $monthlySale }}</span></div>
                                    </div>
                                    <div class="col-auto"><i class="fa fa-solid fa-peso-sign fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-start-success py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                        <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Total Item Sold</span></div>
                                        <div class="text-dark fw-bold h5 mb-0"><span>{{ $totalSold }}</span></div>
                                    </div>
                                    <div class="col-auto"><i class="fa-solid fa-bag-shopping fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-start-info py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                        <div class="text-uppercase text-info fw-bold text-xs mb-1"><span>Total Orders</span></div>
                                        <div class="row g-0 align-items-center">
                                            <div class="col-auto">
                                                <div class="text-dark fw-bold h5 mb-0 me-3"><span>{{ $totalOrders }}</span></div>
                                            </div>
                                            <div class="col">
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-info" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"><span class="visually-hidden">50%</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-start-warning py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                        <div class="text-uppercase text-warning fw-bold text-xs mb-1"><span>Pending Orders</span></div>
                                        <div class="text-dark fw-bold h5 mb-0"><span>{{ $pendingOrder }}</span></div>
                                    </div>
                                    <div class="col-auto"><i class="fa-solid fa-list-check fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- Start: Chart -->
                <div class="row">
                    <div class="col-lg-7 col-xl-8 d-flex">
                        <div class="card shadow mb-4 w-100">
                            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-xl-4">
                        <div class="card shadow mb-4">
                            <div id="doughnutContainer" style="height: 370px; width: 100%;"></div>
                        </div>
                    </div>
                </div><!-- End: Chart -->
            
                </div>
            </div>
        </div>
        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © admin 2023</span></div>
            </div>
        </footer>
    </div>
@stop


@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
@stop