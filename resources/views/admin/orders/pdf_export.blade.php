<!DOCTYPE html>
<html>
<head>
    <title>Orders Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            color: #333;
        }
        .date {
            text-align: right;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Orders Report</h1>
    </div>
    
    <div class="date">
        Generated on: {{ date('d-m-Y H:i') }}
    </div>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Customer</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Status</th>
                <th>Order Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->product_name }}</td>
                <td>{{ $value->user_name }}</td>
                <td>{{ \Carbon\Carbon::parse($value->check_in)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($value->check_out)->format('d-m-Y') }}</td>
                <td>{{ $value->booking_status }}</td>
                <td>{{ \Carbon\Carbon::parse($value->created_at)->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
