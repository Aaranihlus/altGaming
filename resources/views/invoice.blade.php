<h4>Order # {{ $id }}</h4>
<h4>Paypal Transaction ID {{ $paypal_id }}</h4>
<h4>Order Date {{ $order_date }}</h4>

<hr>

<table style="width:100%; border-collapse: collapse;">
  <tr>
    <td style="padding: 6px;">
      <h2>Billing Address</h2>
      <p>{{ $user['address_line_1']}}</p>
      @if(!empty($user['address_line_2']))
        <p>{{ $user['address_line_2']}}</p>
      @endif
      <p>{{ $user['town']}}</p>
      <p>{{ $user['county']}}</p>
      <p>{{ $user['postcode']}}</p>
    </td>
    <td style="padding: 6px;">
      <h2>Seller Address</h2>
      <p>Moorfield Farm</p>
      <p>Waystone Lane</p>
      <p>Belbroughton</p>
      <p>DY9 0BG</p>
    </td>
  </tr>
</table>

<br>

<table style="width:100%; border-collapse: collapse;">
  <tr>
    <th>Item</th>
    <th>Quantity</th>
    <th>Unit Price</th>
  </tr>

  @foreach( $order_items as $item )
    <tr>
      <td>
        {{ $item['name'] }}<br>
        @foreach($item['options'] as $option)
          <span>{{ $option['group'] }}: {{ $option['name'] }}</span><br>
        @endforeach
      </td>
      <td>{{ $item['quantity'] }}</td>
      <td>£ {{ $item['price'] }}</td>
    </tr>
  @endforeach

</table>

<br>

<h2>Order Total: £{{ $order_total }}</h2>

<style>
table, th, td, tr {
  border: 1px solid;
  width: 100%;
}
</style>
