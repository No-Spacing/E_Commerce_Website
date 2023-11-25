<html>
  <body>
  <h2><img src="img/brigada-cover.png"></h2>
  <p class="dateTab">{{ date('Y-m-d') }}</p>
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
            <td>{{ $sale->item_cost - $sale->item_price }}</td>
            <td>{{ $sale->total_sold }}</td>
        </tr>
      @endforeach
    </table>
  </body>
</html>