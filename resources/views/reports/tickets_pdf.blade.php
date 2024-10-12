<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets Report</title>
    <style>
        /* General styling */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        /* Table styling */
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

        /* Optional: Add page-break for multi-page PDF reports */
        @page {
            margin: 1cm;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>

    <h1>Tickets Report</h1>

    <table>
        <thead>
            <tr>
                <th>Customer</th>
                <th>Title</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Created Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->customer->name }}</td>
                    <td>{{ $ticket->title }}</td>
                    <td>{{ $ticket->status }}</td>
                    <td>{{ $ticket->priority }}</td>
                    <td>{{ $ticket->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
