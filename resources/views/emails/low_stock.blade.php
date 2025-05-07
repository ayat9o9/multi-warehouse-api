<h2>Low Stock Report</h2>

@if(count($report) > 0)
<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Product</th>
            <th>Warehouse</th>
            <th>Available</th>
            <th>Required</th>
        </tr>
    </thead>
    <tbody>
        @foreach($report as $item)
        <tr>
            <td>{{ $item['product'] }}</td>
            <td>{{ $item['warehouse'] }}</td>
            <td>{{ $item['quantity'] }}</td>
            <td>{{ $item['required'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>No low stock items today.</p>
@endif