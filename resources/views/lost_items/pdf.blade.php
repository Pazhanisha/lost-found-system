
<!DOCTYPE html>
<html>
<head>
    <title>Lost Items Report</title>
    <style>
        body { font-family: Arial; }
        table {
            width:100%;
            border-collapse:collapse;
        }
        th,td{
            border:1px solid black;
            padding:8px;
            text-align:center;
        }
    </style>
</head>
<body>

<h2>Lost & Found Report</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Item</th>
        <th>Status</th>
        <th>Location</th>
    </tr>

    @foreach($items as $item)
    <tr>
        <td>{{ $item->id }}</td>
        <td>{{ $item->item_name }}</td>
        <td>{{ $item->status }}</td>
        <td>{{ $item->location }}</td>
    </tr>
    @endforeach

</table>

</body>
</html>
