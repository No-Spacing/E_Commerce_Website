@extends('layouts.admin.admin')



@section('content')
    <div class="container-fluid d-flex justify-content-center mt-5 " >
        <div id="chartContainer" style="height: 450px; width: 120%;"></div>  
    </div>
@stop

@section('scripts')
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
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
		text: "Total Sales in the Month of September"
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
@stop