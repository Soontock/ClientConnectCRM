<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        @page {
            margin: 1cm;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>

    <h1>Customer Report</h1>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>ID Number</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->id_number }}</td>
                    <td>{{ $customer->phoneNum }}</td>
                    <td>{{ $customer->address }}</td>
                    <td>{{ $customer->notes }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
