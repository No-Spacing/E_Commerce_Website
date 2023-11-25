<html>
  <body>
  <h2><img src="img/brigada.jpg"></h2>
  <p class="dateTab">{{ date('Y-m-d') }}</p>
    <table style="width:100%">
      <tr>
        <th>Name</th>
        <th>Position</th>
        <th>Total Sold</th>
      </tr>
      @foreach($sales as $sale)
        <tr>
            <td>{{ $sale->product }}</td>
            <td>{{ $sale->Position }}</td>
            <td>{{ $sale->quantity }} Item(s)</td>
        </tr>
      @endforeach
    </table>
  </body>
</html>