<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Low Stock Notification</title>
</head>
<body>
<h1>Low Stock Notification</h1>
<p>The following products have reached or fallen below the stock threshold of {{ $threshold }} units.</p>

<table cellpadding="6" cellspacing="0" border="1">
    <thead>
    <tr>
        <th align="left">Product</th>
        <th align="right">Units Remaining</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td align="right">{{ $product->stock_quantity }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
