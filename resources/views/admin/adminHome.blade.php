@extends('layouts.admin.admin')

@section('head')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
<link rel="stylesheet" href="{{ asset('css/admin/adminHome.css') }}" />
<?php

    $dataArray = array();
    $dataPoints = array();
    $sum = 0;
    foreach($sales as $sale){ 
        $bar = array("label" => $sale->product_name, "y" => $sale->total_sold1);
        array_push($dataPoints, $bar);

        
    }  

    foreach($allSales as $allSale){
        $phpTimestamp = strtotime($allSale->created_at);
        $javaScriptTimestamp = $phpTimestamp * 1000;
        $line = array("label" => $allSale->product_name, "y" => $allSale->total_sold);
        array_push($dataArray, $line);
    }

?>
<script>
    window.onload = function() {
 
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title:{
            text: "Top 5 Items Sold"
        },
        axisY:{
            valueFormatString: "#"
        },
        data: [{
            type: "bar",
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
    });

    chart.render();

    var chart1 = new CanvasJS.Chart("barChart", {
        animationEnabled: true,
        theme: "light1", // "light1", "light2", "dark1", "dark2"
        title:{
            text: "Total Sold Items"
        },
        axisY:{
            includeZero: true,
            
        },
        axisX:{
            labelFontColor: "transparent",
        },
        data: [{
            type: "line", //change type to bar, line, area, pie, etc
            //indexLabel: "{y}", //Shows y value on all Data Points
            indexLabelFontColor: "#5A5757",
            indexLabelPlacement: "outside",   
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
                            <div id="barChart" style="height: 370px; width: 100%;"></div> 
                        </div>
                    </div>
                    <div class="col-lg-5 col-xl-4">
                        <div class="card shadow mb-4">
                            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
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