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
        @foreach ($customers as $customer)
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
