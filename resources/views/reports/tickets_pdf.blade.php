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
        @foreach ($tickets as $ticket)
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

<style>
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

    th,
    td {
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
</style>
