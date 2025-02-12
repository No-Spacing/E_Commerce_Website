<html>
  <link rel="stylesheet" href="css/admin/pdf.css"/>
  <body>
    <h2><img src="img/place-order-cover.png"></h2>
    <p class="dateTab">Date: {{ date('F-d-Y') }}</p>
    <table style="width:100%">
      <tr>
        <th>Name</th>
        <th>Item Cost</th>
        <th>Item Price</th>
        <th>Profit Per Item</th>
        <th>Total Sold</th>
      </tr>
      @foreach($sales as $sale)
        <tr>
          <td>{{ $sale->product_name }}</td>
          <td>{{ $sale->item_cost }}</td>
          <td>{{ $sale->item_price }}</td>
          <td>{{ $sale->item_price - $sale->item_cost }}</td>
          <td>{{ $sale->total_sold }}</td>
        </tr>
      @endforeach
    </table>
  </body>
</html>